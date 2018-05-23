<?php

namespace AppBundle\Controller;

use AppBundle\Mapper\PatientMapper;
use AppBundle\Reader\FileReader;
use function explode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $pathDir = $this->get('kernel')->getRootDir().'/../web/files';
        $datas = $this->get('app.file_reader')->readDir($pathDir);
        $result = [];

        foreach ($datas as $data) {
            $content = $this->get('app.patient_mapper')->map($data);
            if(!empty($content)){
                $result[] = $content;
            }
        }
        dump($result);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @param $data
     */
    protected function patientMapper($data)
    {

        $map = [
            self::SEGMENT_PATIENT => [
                'name'       => [5, 1],
                'firstName'  => [5, 2],
                'birthDate'  => [7, 0],
                'gender'     => [8, 0],
                'streetName' => [11, 1],
                'city'       => [11, 3],
                'zipCode'    => [11, 5],
            ],
            self::SEGMENT_DOCTOR  => [
                'name'      => [4, 2],
                'firstName' => [4, 3],
                'rpps'      => [4, 1],
            ],
        ];

            $segment = array_keys($data)[0];

            if($segment !== self::SEGMENT_PATIENT && $segment !== self::SEGMENT_DOCTOR){
                return null;
            }
            $result = [];
            switch ($segment) {
                case self::SEGMENT_PATIENT:
                    foreach ($map[self::SEGMENT_PATIENT] as $attr => $position){
                        $result[][$attr] = explode('^', $data[self::SEGMENT_PATIENT][$position[0][$position[1]]]);
                    }
                    return $result;

                case self::SEGMENT_DOCTOR:
                    foreach ($map[self::SEGMENT_DOCTOR] as $attr => $position){
                        $result[][$attr] = explode('^', $data[self::SEGMENT_DOCTOR][$position[0][$position[1]]]);
                    }
                    return $result;
            }
        return $result;

    }


}

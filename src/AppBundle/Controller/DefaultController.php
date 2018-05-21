<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $directoryFiles = $this->get('kernel')->getRootDir().'/../web/files';

        $arrayFiles = $this->FileReader($directoryFiles);



        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @param $directoryFiles
     */
    protected function FileReader($directoryFiles)
    {
        $finder = new Finder();

        $contentFiles = array();

        foreach ($finder->files()->in($directoryFiles) as $file) {
            $content = $file->getContents();
            $arrayFile = explode("\n", $content);
            $contentFiles[] = $arrayFile;
        }
    }
}

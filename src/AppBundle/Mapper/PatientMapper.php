<?php
/**
 * Created by PhpStorm.
 * User: jmartoux
 * Date: 23/05/18
 * Time: 02:41
 */

namespace AppBundle\Mapper;


use function array_key_exists;

class PatientMapper
{
    const SEGMENT_PATIENT = 'PID';
    const SEGMENT_DOCTOR = 'ROL';

    /**
     * @param array $data
     * @return array
     */
    public function map($data)
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

        $arraySegment = [self::SEGMENT_PATIENT, self::SEGMENT_DOCTOR];

        foreach ($arraySegment as $k => $segment) {
            foreach ($map[$segment] as $attr => $position){
                if (array_key_exists($segment, $data)) {
                    $content = explode('^', $data[$segment][$position[0]]);
                    $key = $position[1] <= 0 ? $position[1] : $position[1]-1;
                    $result[$attr] = $content[$key];
                }
            }
        }
        return $result;

    }
}
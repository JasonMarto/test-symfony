<?php
/**
 * Created by PhpStorm.
 * User: jmartoux
 * Date: 23/05/18
 * Time: 02:22
 */

namespace AppBundle\Reader;

use Symfony\Component\Finder\Finder;

class FileReader
{
    /**
     * @param string $dirPath
     *
     * @return array
     */
    public function readDir($dirPath) :array
    {
        $finder = new Finder();
        $data = [];

        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder->files()->in($dirPath) as $file) {
            $content = $file->openFile();
            while(!$content->eof()) {
                $line = explode('|', $content->fgets());
                if(!empty($line[0])) {
                    $data[][$line[0]] = $line;
                }
            }
            $content = null;
        }
        return $data;
    }
}
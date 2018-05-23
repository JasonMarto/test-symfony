<?php
/**
 * Created by PhpStorm.
 * User: jmartoux
 * Date: 23/05/18
 * Time: 00:11
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="doctor")
 */
class Doctor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $rpss;
}
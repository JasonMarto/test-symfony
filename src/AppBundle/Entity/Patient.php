<?php
/**
 * Created by PhpStorm.
 * User: jmartoux
 * Date: 22/05/18
 * Time: 23:51
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="patient")
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $birthDate;

    /**
     * @ORM\Column(type="string")
     */
    protected $gender;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Doctor", cascade={"all"})
     */
    protected $doctor;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address", cascade={"all"})
     */
    protected $address;
}
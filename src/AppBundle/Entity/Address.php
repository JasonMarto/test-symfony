<?php
/**
 * Created by PhpStorm.
 * User: jmartoux
 * Date: 20/05/18
 * Time: 00:16
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
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
    protected $streetName;
    /**
     * @ORM\Column(type="string")
     */
    protected $zipCode;
    /**
     * @ORM\Column(type="string")
     */
    protected $city;
}
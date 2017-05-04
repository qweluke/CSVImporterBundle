<?php

namespace Qweluke\CSVImporterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Import
 *
 * @author Łukasz Malicki
 * @package Qweluke\CSVImporterBundle\Model
 *
 */
abstract class BaseImport implements BaseImportInterface
{

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var mixed
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $number;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $gender;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $nameSet;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $givenName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $middleInitial;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $surname;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $streetAddress;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $state;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $zipCode;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $emailAddress;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $browserUserAgent;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * {@inheritdoc}
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getNameSet()
    {
        return $this->nameSet;
    }

    /**
     * {@inheritdoc}
     */
    public function setNameSet($nameSet)
    {
        $this->nameSet = $nameSet;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * {@inheritdoc}
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMiddleInitial()
    {
        return $this->middleInitial;
    }

    /**
     * {@inheritdoc}
     */
    public function setMiddleInitial($middleInitial)
    {
        $this->middleInitial = $middleInitial;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * {@inheritdoc}
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * {@inheritdoc}
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowserUserAgent()
    {
        return $this->browserUserAgent;
    }

    /**
     * {@inheritdoc}
     */
    public function setBrowserUserAgent($browserUserAgent)
    {
        $this->browserUserAgent = $browserUserAgent;
        return $this;
    }


}
<?php

namespace Qweluke\CSVImporterBundle\Entity;


/**
 * Interface ImportInterface
 * @package Qweluke\CSVImporterBundle\Model
 */
interface AbstractImportInterface
{

    /**
     * Returns the import unique id.
     *
     * @return mixed
     */
    public function getId();

    /**
     * @return integer
     */
    public function getNumber();

    /**
     * Set the number
     * @param integer $number
     * @return self
     */
    public function setNumber($number);

    /**
     * Return user gender
     *
     * @return string
     */
    public function getGender();

    /**
     * Sets user gender
     *
     * @param string $gender
     * @return self
     */
    public function setGender($gender);

    /**
     * Returns nameSet
     * @return string
     */
    public function getNameSet();

    /**
     * Sets the nameSet
     *
     * @param string $nameSet
     * @return self
     */
    public function setNameSet($nameSet);

    /**
     * Gets title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets the title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * Gets the givenName
     *
     * @return string
     */
    public function getGivenName();

    /**
     * Sets the givenName
     *
     * @param string $givenName
     * @return self
     */
    public function setGivenName($givenName);

    /**
     * Gets the MiddleInitial
     *
     * @return string
     */
    public function getMiddleInitial();

    /**
     * Sets the middleInitial
     *
     * @param string $middleInitial
     * @return self
     */
    public function setMiddleInitial($middleInitial);

    /**
     * Gets surname
     *
     * @return string
     */
    public function getSurname();

    /**
     * Sets the surname
     *
     * @param string $surname
     * @return self
     */
    public function setSurname($surname);

    /**
     * Gets street address
     *
     * @return string
     */
    public function getStreetAddress();

    /**
     * Sets the street address
     *
     * @param string $streetAddress
     * @return self
     */
    public function setStreetAddress($streetAddress);

    /**
     * Gets the city
     *
     * @return string
     */
    public function getCity();

    /**
     * Sets the city
     *
     * @param string $city
     * @return self
     */
    public function setCity($city);

    /**
     * Gets state
     *
     * @return string
     */
    public function getState();

    /**
     * Sets the state
     * @param string $state
     * @return self
     */
    public function setState($state);

    /**
     * Gets zip code
     * @return string
     */
    public function getZipCode();

    /**
     * Sets the zip code
     * @param string $zipCode
     * @return self
     */
    public function setZipCode($zipCode);

    /**
     * Gets country
     *
     * @return string
     */
    public function getCountry();

    /**
     * Sets the country
     *
     * @param string $country
     * @return self
     */
    public function setCountry($country);

    /**
     * Gets email
     * @return string
     */
    public function getEmailAddress();

    /**
     * Sets the email
     * @param string $emailAddress
     * @return mixed
     */
    public function setEmailAddress($emailAddress);

    /**
     * Gets username
     * @return string
     */
    public function getUsername();

    /**
     * Sets the username
     * @param string $username
     * @return self
     */
    public function setUsername($username);

    /**
     * Gets password
     * @return string
     */
    public function getPassword();

    /**
     * Sets the password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password);

    /**
     * Gets browser user agent
     * @return string
     */
    public function getBrowserUserAgent();

    /**
     * Sets the browser user agent
     * @param string $browserUserAgent
     * @return self
     */
    public function setBrowserUserAgent($browserUserAgent);
}
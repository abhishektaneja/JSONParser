<?php
/**
 * Created by PhpStorm.
 * User: Abhishek
 * Date: 21-12-2014
 * Time: 03:53 PM
 */
class Employee
{

    /**
     * @JsonProperty("firstName")
     */
    private $name;

    /**
     * @var
     */
    private $lastName;

    /**
     * @var
     * @JsonProperty("contact")
     */
    private $contactInformation;

    /**
     * @return mixed
     */
    public function getContactInformation()
    {
        return $this->contactInformation;
    }

    /**
     * @param mixed $contactInformation
     */
    public function setContactInformation($contactInformation)
    {
        $this->contactInformation = $contactInformation;
    }



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

}
?>
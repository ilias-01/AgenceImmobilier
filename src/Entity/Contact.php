<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min = 5, max=100)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min = 5, max=100)
     */
    private $lastname;

    /**
     * @var int
     * @Assert\Type(type="integer")
     * @Assert\NotBlank
     *
     */
    private $phone;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min = 10)
     */
    private $message;
    /**
     * @var Property
     */
    private $property;

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function getProperty()
    {
        return $this->property;
    }
    public function setProperty(Property $property):Contact
    {
        $this->property=$property;
        return $this;
    }
    public function setFirstname(string $firstname):Contact
    {
        $this->firstname=$firstname;
        return $this;
    }
    public function setLastname(string $lastname):Contact
    {
        $this->lastname=$lastname;
        return $this;
    }
    public function setPhone(int $phone):Contact
    {
        $this->phone=$phone;
        return $this;
    }
    public function setEmail(string $email):Contact
    {
        $this->email=$email;
        return $this;
    }
    public function setMessage(string $message):Contact
    {
        $this->message=$message;
        return $this;
    }
}
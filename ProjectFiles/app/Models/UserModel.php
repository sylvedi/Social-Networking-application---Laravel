<?php
namespace App\Models;

class UserModel implements \JsonSerializable
{
    
    private $id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $email;
    private $city;
    private $state;
    private $suspended;
    private $birthday;
    private $tagline;
    private $photo;
    
    public function __construct($id, $username, $password, $firstname, $lastname, $email, $city, $state, $suspended, $birthday, $tagline, $photo){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->city = $city;
        $this->state = $state;
        $this->suspended = $suspended;
        $this->birthday = $birthday;
        $this->tagline = $tagline;
        $this->photo = $photo;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    
    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    
    /**
     * @return mixed
     */
    public function getSuspended()
    {
        return $this->suspended;
    }
    
    /**
     * @param mixed $suspended
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    }
    
    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
    
    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
    
    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }
    
    /**
     * @param mixed $tagline
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
    }
    
    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    
    
}
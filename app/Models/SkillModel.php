<?php
namespace App\Models;

class SkillModel
{
    
    private $id;
    private $description;
    private $years;
    
    function __construct($id, $description, $years)
    {
        $this->id = $id;
        $this->description = $description;
        $this->years = $years;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param mixed $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }

    
}
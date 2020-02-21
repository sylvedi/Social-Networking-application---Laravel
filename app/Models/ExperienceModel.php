<?php
namespace App\Models;

class ExperienceModel
{

    private $id;

    private $company;

    private $jobtitle;

    private $description;

    function __construct($id, $company, $jobtitle, $description)
    {
        $this->id = $id;
        $this->company = $company;
        $this->jobtitle = $jobtitle;
        $this->description = $description;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    /**
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     *
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     *
     * @return mixed
     */
    public function getJobtitle()
    {
        return $this->jobtitle;
    }

    /**
     *
     * @param mixed $jobtitle
     */
    public function setJobtitle($jobtitle)
    {
        $this->jobtitle = $jobtitle;
    }

    /**
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}


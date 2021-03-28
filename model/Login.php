<?php

namespace model;

class Login {

    private $id;
    private $userId;
    private $type;
    private $time;

    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
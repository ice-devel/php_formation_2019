<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 24/09/2019
 * Time: 16:45
 */

class Product
{
    private $id;
    private $createdAt;
    private $name;
    private $price;
    private $description;
    private $isOnline;

    public function __construct($id="", $name="", $price="", $description="", $isOnline="")
    {
        $this->setId($id);
        $this->setCreatedAt(new DateTime());
        $this->setName($name);
        $this->setPrice($price);
        $this->setDescription($description);
        $this->setIsOnline($isOnline);
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
    public function getisOnline()
    {
        return $this->isOnline;
    }

    /**
     * @param mixed $isOnline
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
    }


}
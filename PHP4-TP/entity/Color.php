<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 27/09/2019
 * Time: 10:01
 */

class Color
{
    private $id;
    private $name;

    /**
     * Color constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->setId($id);
        $this->setName($name);
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


}
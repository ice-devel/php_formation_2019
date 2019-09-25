<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/09/2019
 * Time: 11:39
 */

class Test
{
    private $name;

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
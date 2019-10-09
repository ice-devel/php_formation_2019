<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 09/10/2019
 * Time: 16:24
 */

abstract class AbstractClass
{
    private $username;

    public function getUsername() {
        return $this->username;
    }

    abstract function getPassword();
}

class Utilisateur extends AbstractClass {
    public function getPassword() {
        $password = uniqid();
        return $password;
    }
}


// une class abstraite ne peut pas être instanciée
// $abstractClass = new AbstractClass();

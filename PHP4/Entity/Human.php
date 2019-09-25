<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/09/2019
 * Time: 15:32
 */

class Human extends Being
{
    public function localize() {
        echo $this->coordinates;
    }
}
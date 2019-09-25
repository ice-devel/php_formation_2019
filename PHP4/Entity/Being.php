<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/09/2019
 * Time: 15:23
 */

class Being
{
    private $size;
    private $isDead;

    // protected permet d'accéder/modifier la propriété directement dans les classes en plus de cette classe
    protected $coordinates;

    public function __construct()
    {
        $this->setIsDead(false);
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getisDead()
    {
        return $this->isDead;
    }

    /**
     * @param mixed $isDead
     */
    public function setIsDead($isDead)
    {
        $this->isDead = $isDead;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param mixed $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function gravity() {
        $newSize = $this->getSize() * 0.98;
        $this->setSize($newSize);
    }

    public function perish() {
        $this->setIsDead(true);
        echo "Euuuaaahppppr";
    }
}
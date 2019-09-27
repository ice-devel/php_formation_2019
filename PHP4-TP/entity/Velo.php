<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 27/09/2019
 * Time: 10:01
 */

class Velo
{
    private $id;
    private $createdAt;
    private $name;
    private $size;
    private $price;
    private $frame;
    const FRAME_MAN = 0;
    const FRAME_WOMAN = 1;
    const FRAME_MIXED = 2;
    private $suspension;
    private $color;

    /**
     * Velo constructor.
     * @param $id
     * @param $createdAt
     * @param $name
     * @param $size
     * @param $price
     * @param $frame
     * @param $suspension
     */
    public function __construct($id="", $createdAt="", $name="", $size="", $price="", $frame="", $suspension="", $color=null)
    {
        if ($createdAt == "") {
            $createdAt = new DateTime();
        }

        $this->setId($id);
        $this->setCreatedAt($createdAt);
        $this->setName($name);
        $this->setSize($size);
        $this->setPrice($price);
        $this->setFrame($frame);
        $this->setSuspension($suspension);
        $this->setColor($color);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        if (! $createdAt instanceof DateTime) {
            $createdAt = new DateTime($createdAt);
        }
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * @param string $frame
     */
    public function setFrame($frame)
    {
        $this->frame = $frame;
    }

    /**
     * @return string
     */
    public function getSuspension()
    {
        return $this->suspension;
    }

    /**
     * @param string $suspension
     */
    public function setSuspension($suspension)
    {
        if ($suspension == 0 || $suspension === null) {
            $suspension = false;
        }
        else {
            $suspension = true;
        }
        $this->suspension = $suspension;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }


}
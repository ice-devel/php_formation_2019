<?php
/**
 * Model / Entity : les données métiers
 * Ici cette classe modélise le concept "Utilisateur" :
 * les propriétés que peut avoir un utilisateur, et les fonctions (comportements)
 * que peut avoir un utilisateur
 */

class User
{
    /*
     * Propriétés
     * Des propriétés privées ne peuvent être obtenues/modifiées quand dans la classe-même
     */
    private $id;
    private $createdAt;
    private $name;
    private $birthday;
    private $points;
    private $zipcode;

    /*
     * Constante de classe
     */
    const TYPE_FREE = 0;
    const TYPE_PREMIUM = 1;

    /*
     * Constructeur : sert notamment à donner des valeurs par défaut à l'objet
     * lors de son instanciation
     * Le constructeur automatiquement lors de l'instanciation
     */
    public function __construct($name="")
    {
        // certes le constructeur a le droit d'accéder aux propriétés directement
        // mais préférons respecter le principe d'encapsulation et passer par les getter/setter
        // ce qui pourrait à l'avenir éviter certains problèmes si des traitements/formatages
        // se trouvent dans ces getter/setter
        //$this->name = $name;
        
        $this->setName($name);
        $this->setCreatedAt(new DateTime());
    }

    /*
     * getter/setter
     * accesseur/mutateur
     * on encapsule tous les accès et modifications de propriétés pour avoir un
     * seul endroit où on centralise les régles définies pour ces propriétés
     */
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $name = strtoupper($name);
        $this->name = $name;
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
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }


    /*
     * Méthodes
     * Membre (propriété/méthode) public : permet de pouvoir utiliser la fonction également
     * en dehors de la classe
     */
    public function sayHello() {
        $this->traitementPrive();
        echo "Hello I'm ".$this->name;
    }

    private function traitementPrive() {
        // ici on met un traitement qui ne peut être appelé
        // que depuis cette classe : fonction privée
    }
}
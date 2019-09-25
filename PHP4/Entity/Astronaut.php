<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 25/09/2019
 * Time: 15:32
 */

class Astronaut extends Human
{
    // couche écologique : de 0 à 100 suivant l'état de la couche (100 étant bien dégueu)
    private $ecoDiaper;

    // redéfinition du constructeur
    public function __construct()
    {
        // $this->setIsDead(false);

        // refaire les initialisations déjà dans le parent pour éviter de les réécrire ici
        // attention l'appel au parent va chercher d'abord dans le plus proche
        // et remonte dans les parents jusqu'à trouver une fonction du même nom
        parent::__construct();

        $this->setEcoDiaper(0);
    }

    /**
     * @return int
     */
    public function getEcoDiaper()
    {
        return $this->ecoDiaper;
    }

    /**
     * @param mixed $diaper
     */
    public function setEcoDiaper($ecoDiaper)
    {
        $this->ecoDiaper = $ecoDiaper;
    }

    // surcharge / override :: c'est la redéfinition dune méthode existant déjà dans une des classes mères
    // on peut modifier la visibilité d'une méthode, seulement si c'est pour la rendre plus restrictive
    // exemple classe mère : public - classe fille : private  OK
    // exemple classe mère : private - classe fille : public  KO
    public function gravity()
    {
        // l'astronaute subit moins la gravité
        $newSize = $this->getSize() * 0.99;
        $this->setSize($newSize);
    }

    public function setCoordinates($coordinates)
    {
       $this->coordinates = "5.55;6.56";
    }
}
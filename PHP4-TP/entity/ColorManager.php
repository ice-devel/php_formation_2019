<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 27/09/2019
 * Time: 10:01
 */

class ColorManager
{
    private $db;

    /**
     * VeloManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find($id) {
        $sql = "SELECT * FROM color WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $result = $statement->execute([':id' => $id]);
        $colorTabAssociative = $statement->fetch(PDO::FETCH_ASSOC);

        $color = false;
        if ($colorTabAssociative !== false) {
            $color = new Color($colorTabAssociative['id'], $colorTabAssociative['name']);
        }

        return $color;
    }

    public function findAll() {
        $sql = "SELECT * FROM color";
        $statement = $this->db->prepare($sql);
        $result = $statement->execute();
        $colorsTabAssociative = $statement->fetchAll(PDO::FETCH_ASSOC);

        $colors = [];
        foreach ($colorsTabAssociative as $c) {
            $color = new Color($c['id'], $c['name']);

            $colors[] = $color;
        }

        return $colors;
    }
}
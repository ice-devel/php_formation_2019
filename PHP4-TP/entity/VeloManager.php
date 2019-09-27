<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 27/09/2019
 * Time: 10:01
 */

class VeloManager
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

    public function findAll() {
        // on préfixe le nom des champs et on leur donne des nouveaux noms de colonne
        // si on utilise le tableau associatif en résultat de requête
        // sinon les colonnes qui ont le même nom dans différentes tables vont s'écraser
        $sql = "SELECT V.id AS v_id, V.name AS v_name, V.created_at, V.size, V.price, V.frame, V.suspension,
                      C.id AS c_id, C.name AS c_name
                FROM velo V LEFT JOIN color C ON V.color_id = C.id";
        $statement = $this->db->prepare($sql);
        $result = $statement->execute();
        $velosTabAssociative = $statement->fetchAll(PDO::FETCH_ASSOC);

        $velos = [];
        foreach ($velosTabAssociative as $v) {
            $velo = new Velo();
            $velo->setId($v['v_id']);
            $velo->setCreatedAt($v['created_at']);
            $velo->setName($v['v_name']);
            $velo->setPrice($v['price']);
            $velo->setFrame($v['frame']);
            $velo->setSuspension($v['suspension']);
            $velo->setSize($v['size']);

            // la propriété color du vélo est elle-même un objet color
            if ($v['c_id'] != null) {
                $color = new Color($v['c_id'], $v['c_name']);
                $velo->setColor($color);
            }


            $velos[] = $velo;
        }

        return $velos;
    }

    public function insert(Velo $velo) {
        $params = [
            ':created_at' => $velo->getCreatedAt()->format('Y-m-d H:i:s'),
            ':name' => $velo->getName(),
            ':price' => $velo->getPrice(),
            ':size' => $velo->getSize(),
            ':suspension' => $velo->getSuspension() ? "1" : "0",
            ':frame' => $velo->getFrame(),
        ];

        $sql = "INSERT INTO velo(created_at, name, price, size, suspension, frame)
                VALUES (:created_at, :name, :price, :size, :suspension, :frame)";
        $statement = $this->db->prepare($sql);
        return $statement->execute($params);
    }

    public function find($id) {
        $sql = "SELECT V.id AS v_id, V.name AS v_name, V.created_at, V.size, V.price, V.frame, V.suspension,
                      C.id AS c_id, C.name AS c_name
                FROM velo V LEFT JOIN color C ON V.color_id = C.id WHERE V.id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute([':id' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $velo = false;
        if ($result !== false) {
            $velo = new Velo();
            $velo->setId($result['v_id']);
            $velo->setCreatedAt($result['created_at']);
            $velo->setName($result['v_name']);
            $velo->setPrice($result['price']);
            $velo->setSize($result['size']);
            $velo->setFrame($result['frame']);
            $velo->setSuspension($result['suspension']);

            // la propriété color du vélo est elle-même un objet color
            if ($result['c_id'] != null) {
                $color = new Color($result['c_id'], $result['c_name']);
                $velo->setColor($color);
            }
        }

        return $velo;
    }

    public function delete(Velo $velo) {
        $sql = "DELETE FROM velo WHERE id=:id";
        $statement = $this->db->prepare($sql);
        return $statement->execute([':id' => $velo->getId()]);
    }

    public function update(Velo $velo) {
        $params = [
            ':name' => $velo->getName(),
            ':price' => $velo->getPrice(),
            ':size' => $velo->getSize(),
            ':suspension' => $velo->getSuspension() ? "1" : "0",
            ':frame' => $velo->getFrame(),
            ':id' => $velo->getId(),
            ':color_id' => $velo->getColor() != null ? $velo->getColor()->getId() : null,
        ];

        $sql = "UPDATE velo SET name=:name, price=:price, size=:size,
                                suspension=:suspension, frame=:frame, color_id=:color_id
                WHERE id=:id";
        $statement = $this->db->prepare($sql);
        return $statement->execute($params);
    }
}
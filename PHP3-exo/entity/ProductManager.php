<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 24/09/2019
 * Time: 16:45
 */

class ProductManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find($id) {
        $sql = "SELECT * FROM product WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute([':id' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $product = false;
        if ($result !== false) {
            $product = new Product();
            $product->setId($result['id']);
            $product->setCreatedAt($result['created_at']);
            $product->setIsOnline($result['is_online']);
            $product->setDescription($result['description']);
            $product->setPrice($result['price']);
            $product->setName($result['name']);
        }

        return $product;
    }

    public function findAll() {
        $sql = "SELECT * FROM product";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($result as $p) {
            $product = new Product();
            $product->setId($p['id']);
            $product->setName($p['name']);
            $product->setPrice($p['price']);
            $product->setDescription($p['description']);
            $product->setIsOnline($p['is_online']);
            $product->setCreatedAt($p['created_at']);
            $products[] = $product;
        }

        return $products;
    }

    public function create(Product $product) {
        $params = [
            ':created_at' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':description' => $product->getDescription(),
            ':is_online' => $product->getisOnline() ? 1 : 0,
        ];

        $sql = "INSERT INTO product(created_at, name, price, description, is_online)
                VALUES (:created_at, :name, :price, :description, :is_online)";
        $statement = $this->db->prepare($sql);
        return $statement->execute($params);
    }

    public function delete(Product $product) {
        $sql = "DELETE FROM product WHERE id=:id";
        $statement = $this->db->prepare($sql);
        return $statement->execute([':id' => $product->getId()]);
    }
}
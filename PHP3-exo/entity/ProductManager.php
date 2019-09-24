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


    public function findAll() {
        $products = [];
        return $products;
    }

    public function create(Product $product) {
        $params = [
            ':create_at' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':description' => $product->getDescription(),
            ':is_online' => $product->getisOnline(),
        ];

        $sql = "INSERT INTO product(created_at, name, price, description, is_online)
                VALUES (:created_at, :name, :price, :description, :is_online)";
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
    }

    public function delete(Product $product) {

    }
}
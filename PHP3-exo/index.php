<?php
include "entity/Product.php";
include "entity/ProductManager.php";

$db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
$productManager = new ProductManager($db);
$products = $productManager->findAll();

include "templates/product_list.php";

?>
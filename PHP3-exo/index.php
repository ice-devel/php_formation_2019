<?php
include "entity/ProductManager.php";

$db = "quelquechose";
$productManager = new ProductManager($db);
$products = $productManager->findAll();
// controller
include "templates/product_list.html";

?>
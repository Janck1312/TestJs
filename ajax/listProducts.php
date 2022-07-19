<?php
require '../controllers/ProductController.php';

$products = new ProductController();
$response = $products->getProducts();

die(json_encode($response));
?>

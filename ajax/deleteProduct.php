<?php
require '../controllers/ProductController.php';
$data = json_decode(file_get_contents('php://input'), true);

$product = new ProductController();

die(json_encode($product->delete($data['id'])));

?>

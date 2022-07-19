<?php
require '../controllers/ProductController.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$product = new ProductController();
$response = $product->findProduct($id);
die(json_encode($response));

?>

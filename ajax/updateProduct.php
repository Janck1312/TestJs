<?php
require '../controllers/ProductController.php';
$data = json_decode(file_get_contents('php://input'), true);
$update = new ProductController();

die(json_encode($update->update($data)));

?>

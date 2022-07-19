<?php
require '../controllers/ProductController.php';
$data = json_decode(file_get_contents('php://input'), true);
//$data['name'];

foreach ($data as $key => $value) {
  if($data[$key] != ''){
    //procedemos con la insercion de datos en la base de datos
    $newProduct = new ProductController();
    $response = $newProduct->store($data);
    die(json_encode($response));

  }else{
    $errores = array(
      $key => 'El campo '.$key.' no puede estar vacio',
    );
    die(json_encode($errores));
  }
}
die(json_encode($data));
?>

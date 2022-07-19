<?php
class Model{
  public function conexion(){
    $conexion = new mysqli('localhost', 'root', '123456', 'prueba');
    return $conexion;
  }
}
?>

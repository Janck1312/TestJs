<?php
require '../models/Product.php';

class ProductController extends Product{

  public function delete($id){
    $sql = "DELETE FROM products WHERE id = '$id'";

    $delete = self::conexion()->query($sql);

    if($delete == true){
      $response = array(
        'success' => true,
        'message' => 'Producto eliminado correctamente'
      );

    }else{
      $response = array(
        'success' => false,
        'message' => 'Ocurrio un problema al eliminar el producto'
      );

    }

    return $response;
  }

  public function update($data){
    $sql ="UPDATE products SET name = '$data[name]', description = '$data[description]', stock = '$data[stock]', code = '$data[code]', price = '$data[price]', price_purchase = '$data[price_purchase]' WHERE id = '$data[id]'";
    $update = self::conexion()->query($sql);
    if($update === true){
      $response = array(
        'success' => true,
        'message' => 'Producto actualizado correctamente'
      );
    }else{
      $response = array(
        'success' => false,
        'message' => 'Algo salio mal al actualizar el producto'
      );
    }
    return $response;
  }

  public function findProduct($id){
    $sql = "SELECT * FROM products WHERE id = '$id'";

    $producto = self::conexion()->query($sql);

    if(is_object($producto)){
      $response = array();
      $i = 0;
      while($data = mysqli_fetch_array($producto)){
        $response[$i]['id'] = $data['id'];
        $response[$i]['name'] = $data['name'];
        $response[$i]['description'] = $data['description'];
        $response[$i]['stock'] = $data['stock'];
        $response[$i]['code'] = $data['code'];
        $response[$i]['price'] = $data['price'];
        $response[$i]['price_purchase'] = $data['price_purchase'];
        $response[$i]['created'] =  date_format(date_create($data['created_at']), 'd-m-Y H:i');

        $i++;
      }

    }else{
      $response = array(
        'success' => false,
        'message' => 'No se encontró el producto'
      );
    }
    return ['data' => $response];

  }

  public function getProducts(){

    $sql = "SELECT * FROM products";
    $query = self::conexion()->query($sql);

    if(is_object($query)){
      $response = array();
      $i = 0;
      while($data = mysqli_fetch_array($query)){
        $response[$i]['id'] = $data['id'];
        $response[$i]['name'] = $data['name'];
        $response[$i]['description'] = $data['description'];
        $response[$i]['stock'] = $data['stock'];
        $response[$i]['code'] = $data['code'];
        $response[$i]['price'] = $data['price'];
        $response[$i]['price_purchase'] = $data['price_purchase'];
        $response[$i]['created'] =  date_format(date_create($data['created_at']), 'd-m-Y H:i');

        $i++;
      }
    }else{
      $response = array(
        'message' => 'No hay datos para mostrar'
      );
    }

    return ['data' => $response];
  }

  public function store($data){

    $query = self::conexion()->query("INSERT INTO products(name, description, stock, code, price, price_purchase)
                                      VALUES('$data[name]', '$data[description]', '$data[stock]', '$data[code]',
                                             '$data[price]', '$data[price_purchase]')");
    if($query == true){
      $response = array(
        'success' => true,
        'message' => 'El producto fue agregado correctamente'
      );
    }else{
      $response = array(
        'success' => false,
        'message' => 'Algo salio mal al agregar el nuevo producto, intente nuevamente mas tarde'
      );
    }
    return $response;
  }

}
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba Js</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="container">
        <header class="section-header">
          <h3 class="page-title mt-4 mb-4">Prueba Js Puro</h3>
        </header>
        <div class="section-body">
          <form id="formPrd">
            <div class="row">
              <div class="col-md-3 mt-2 mb-2">
                <input type="text" id="name" placeholder="Nombre:" class="form-control">
              </div>
              <div class="col-md-3 mt-2 mb-2">
                <input type="text" id="description" class="form-control" placeholder="Descripción:">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mt-2 mb-2">
                <input type="number" id="stock" placeholder="Cantidad:" class="form-control">
              </div>
              <div class="col-md-3 mt-2 mb-2">
                <input type="text" id="code" placeholder="Codigo" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mt-2 mb-2">
                <input type="number" id="price" placeholder="Precio:" class="form-control">
              </div>
              <div class="col-md-3 mt-2 mb-2">
                <input type="number" id="price_purchase" placeholder="Precio de compra:" class="form-control">
              </div>
            </div>
            <span class="alert" role="alert" id="error"></span>
            <div class="row col-md-3 mt-2 mb-2 form-inline">
              <button class="btn btn-sm btn-success" type="submit">Guardar</button>
              <button class="btn btn-sm btn-danger" type="reset">Limpiar campos</button>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-info col-md-6">
              <thead class="text-center">
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Código</th>
                <th>Precio</th>
                <th>Precio de Compra</th>
                <th>Creado</th>
                <th></th>
              </thead>
              <tbody id="listProducts" class="text-center">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal" id="addProduct" tabindex="1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <img src="" class="modal_img">
                <h2 class="modal-title">Editando producto</h2>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="font-w-600">Nombre</label>
                        <input type="text" class="form-control rounded" id="nameUp" placeholder="Ingrese un nombre" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="font-w-600">Descripción</label>
                        <input type="text" class="form-control rounded" id="descriptionUp" placeholder="Ingrese una description" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock" class="font-w-600">Stock</label>
                        <input type="number" class="form-control rounded" id="stockUp" placeholder="Ingrese un stock" autocomplete="none">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="code" class="font-w-600">Codigo</label>
                      <input type="number" class="form-control rounded" id="codeUp" placeholder="Ingrese un codigo unico de producto" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="price" class="font-w-600">Precio</label>
                        <input type="number" class="form-control rounded" id="priceUp" placeholder="Ingrese un precio" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="price_purchaseUp">Precio de compra</label>
                    <input type="number" id="price_purchaseUp" class="form-control-rounded" placeholder="Ingrese un precio de compra">
                  </div>
                  <div class="col-md-6">
                    <input type="number" id="unico" hidden>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-warning" onclick="saveEdit()">Guardar</button>
              <button class="btn btn-sm btn-danger"  onclick="closeModal()">Cancelar</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script type="text/javascript">
    getProducts();

    function getProducts(){
      const listProducts = document.getElementById('listProducts');
      listProducts.innerHTML = '';

      fetch('http://pruebajspuro.test/ajax/listProducts.php', {
        method:'GET',
        headers:{
          'Accept': 'application/json',
          'Content-type': 'application/json',
        },
        mode:'cors',
      }).then(response => response.json())
      .then(res => {

      var products = res.data;

        for(let i = 0; i< products.length; i++){
          var data = '';
          data = '<tr>'+
                    '<td>'+products[i].id+'</td>'+
                    '<td>'+products[i].name+'</td>'+
                    '<td>'+products[i].description+'</td>'+
                    '<td>'+products[i].stock+'</td>'+
                    '<td>'+products[i].code+'</td>'+
                    '<td>'+products[i].price+'$</td>'+
                    '<td>'+products[i].price_purchase+'$</td>'+
                    '<td>'+products[i].created+'</td>'+
                    '<td>'+
                      '<button class="btn btn-sm btn-warning" onclick="editar('+products[i].id+')">Editar</button>'+
                      '<button class="btn btn-sm btn-danger" onclick="eliminar('+products[i].id+')">Eliminar</button>'+
                    '</td>'+
                 '</tr>';

                 listProducts.innerHTML += data;
        }

      }).catch(error => {

        console.log(error);

      });
    }

    const formPrd = document.getElementById('formPrd');
    const error = document.getElementById('error');

      formPrd.addEventListener("submit", function(event){
        event.preventDefault();
        const name = document.getElementById('name');
        const description = document.getElementById('description');
        const stock = document.getElementById('stock');
        const code = document.getElementById('code');
        const price = document.getElementById('price');
        const price_purchase = document.getElementById('price_purchase');

        var data = {
                name:name.value,
                description:description.value,
                stock:stock.value,
                code:code.value,
                price:price.value,
                price_purchase:price_purchase.value
              };

          fetch('http://pruebajspuro.test/ajax/saveProduct.php',{
            method:'POST',
            body: JSON.stringify(data),
            headers:{
              'Accept': 'application/json',
              'Content-type': 'application/json',
            },
            mode:'cors',
            //response.text() -- me salvo la patria UWU
          }).then(response => response.json())
          .then(res => {

            console.log(res);
            if(res.success === false){
              alert(res.message);
            }else{
              alert(res.message);
              getProducts();
            }

          }).catch(error => console.error(error));

      }, true);

      function editar(id){

        var data = {id:id};
        const modal = document.getElementById('addProduct');
        modal.classList.add('modal--show');

        fetch('http://pruebajspuro.test/ajax/findProduct.php',{
          method:'POST',
          body: JSON.stringify(data),
          headers:{
            'Accept': 'application/json',
            'Content-type': 'application/json',
          },
          mode:'cors',
        }).then(response => response.json())
        .then(res => {
          var producto = res.data[0];

          const unico = document.getElementById('unico');
          const nameUp = document.getElementById('nameUp');
          const descriptionUp = document.getElementById('descriptionUp');
          const stockUp = document.getElementById('stockUp');
          const codeUp = document.getElementById('codeUp');
          const priceUp =    document.getElementById('priceUp');
          const price_purchaseUp = document.getElementById('price_purchaseUp');
          unico.value = producto.id;
          nameUp.value = producto.name;
          descriptionUp.value = producto.description;
          stockUp.value = producto.stock;
          codeUp.value = producto.code;
          priceUp.value = producto.price;
          price_purchaseUp.value = producto.price_purchase;


        })
        .catch(error => console.error(error));

      }

      function saveEdit(){

        var productoUp = {
          id:unico.value,
          name:nameUp.value,
          description:descriptionUp.value,
          stock:stockUp.value,
          code:codeUp.value,
          price:priceUp.value,
          price_purchase:price_purchaseUp.value
        };

        fetch('http://pruebajspuro.test/ajax/updateProduct.php',{
          method:'PUT',
          body: JSON.stringify(productoUp),
          headers:{
            'Accept': 'application/json',
            'Content-type': 'application/json',
          },
          mode:'cors',
        }).then(response => response.json())

        .then(res => {
          console.log(res);
          if(res.success === true){
            closeModal();
            getProducts();
            alert(res.message);
          }else{
            alert(res.message);
          }
        }).catch(error => console.error(error));
      }

      function closeModal(){
        const modal = document.getElementById('addProduct');
        modal.classList.remove('modal--show');

      }

      function eliminar(id){
        var data = {id:id};
        if(confirm('realmente desea eliminar el elemento '+id+'?')){
            fetch('http://pruebajspuro.test/ajax/deleteProduct.php', {
              method:'DELETE',
              body: JSON.stringify(data),
              headers:{
                'Accept': 'application/json',
                'Content-type': 'application/json',
              },
              mode:'cors',

            }).then(response => response.json())
            .then(res => {
              console.log(res);
              if(res.success === true){
                alert(res.message);
                getProducts();

              }else{
                alert(res.message);
              }
            }).catch(error => console.error(error));
        }

      }
    </script>
  </body>
</html>

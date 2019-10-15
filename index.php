<!DOCTYPE html>
<html>
    <head>
        <title>Eduardo Cortez Job Application</title>

        <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.css">
        <link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script>
        function load_edit_info(id) {
            var row = jQuery(this).closest('tr');
            console.log(row);
        }
        function editProduct(id) {
            $.ajax({
                url: 'Class/Product.php',
                type: 'PUT',
                data: {editId:id},
                success: function(data){
                    alert(data);
                }
            });
        }
        $( document ).ready(function() {
            $("#product_form").submit( function (e) {    
                e.preventDefault();
                var name = $("#txtName").val();
                var qty = $("#txtQty").val();
                var price = $("#txtPrice").val();
                $.ajax({
                    url: 'Class/Product.php',
                    type: 'POST',
                    data: {txtName:name, txtQty:qty, txtPrice:price},
                    success: function( data){
                        $('#tblData tbody').html(data);
                    }
                });
            });
        });
        </script>

    </head>
    <body> 
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="" class="navbar-brand">Eduardo Cortez Job Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
          </ul>
        </div>
      </div>
    </div>


    <div class="container">

    <form method="POST" id="product_form">
    <table>
        <tr>
        <td>Product name </td><td><input type="text" id="txtName"></td>
        </tr>
        <tr>
        <td>Quantity in Stock </td> <td><input type="text" id="txtQty"></td>
        </tr>
        <tr>
        <td>Price Item (USD)</td><td><input type="text" id="txtPrice"></td>
        </tr>
        <tr><td colspan="2" style="text-align:center;">
        <br>
        <input type="submit" value="Submit" id="btnSubmit" class="btn btn-success"></td>
        </tr>
    </table>
    </form> 
    <br>
    <br>
     <table>
    <table class="table table-hover" id="tblData">
    <thead>
        <tr class="table-primary">
            <th>Id</th>
            <th>Product Name</th>
            <th>Quantity in Stock</th>
            <th>Price Per Item</th>
            <th>DateTime Submited</th>
            <th>Total Value Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
    </div>

  </body>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" id="product_form_edit">
      <input type="hidden" id="txtIdEdit">
      <table>
          <tr>
          <td>Product name </td><td><input type="text" id="txtIdEdit"></td>
          </tr>
          <tr>
          <td>Quantity in Stock </td><td><input type="text" id="txtQtyEdit"></td>
          </tr>
          <tr>
          <td>Price Item (USD)</td><td><input type="text" id="txtPriceEdit"></td>
          </tr>
      </table>
      </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editProduct()">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>
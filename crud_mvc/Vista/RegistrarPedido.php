<?php 
require_once("../Controlador/ControladorPedidos.php");
$Controlador = new ControladorPedidos();
$ListaClientes=$Controlador->ListarClientes();
$ListaProductos=$Controlador->ListarProductos();
//$ListaDetallesPedido=$Controlador->ListarDetallePedido();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
    <div class="container mt-4 col-lg-4">
        <h2>Registrar Pedido</h2>
    </div>
    <div class="card-bordy">
        <form name="frmPedido" id="frmPedido" method="POST" 
        action="../Controlador/ControladorPedidos.php">
        <label>Pedido:</label>
        <input type="text" name="idPedido" id="idPedido" class="form-control" readonly/>
        <input type="hidden" name="RegistrarPedido" />
        <label>Cliente:</label>
            <select name="cliente" id="cliente" class="form-control">
                <option value="">Seleccione</option>
                <?php
                foreach($ListaClientes as $C){
                    ?>
                    <option value="<?php echo $C->getNumeroDocumento() ?>">
                    <?php echo $C->getNombres(); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <label>Producto:</label>
            <select name="producto" id="producto" class="form-control" onchange="mostrarPrecio(this.value)">
                <option value="">Seleccione</option>
                <?php
                foreach($ListaProductos as $P){
                    ?>
                    <option value="<?php echo $P->getId() ?>" >
                    <?php echo $P->getNombre(); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <label>Precio:</label>
            <input type="text" name="precio" id="precio" class="form-control" readonly/>
            <label>Cantidad:</label>
            <input type="text" name="cantidad" id="cantidad" class="form-control" value=0
            onkeypress="calcularValorDetalle()" onkeyup="calcularValorDetalle()"
            onkeydown="calcularValorDetalle()"/>
            <label>Valor Detalle:</label>
            <input type="text" name="valorDetalle" id="valorDetalle" class="form-control" />

 <!--           <label>Nombres:</label>
            <input type="text" name="Nombres" id="Nombres" class="form-control" />
            <label>Apellidos:</label>
            <input type="text" name="Apellidos" id="Apellidos" class="form-control" />
            <label>Correo Electrónico:</label>
            <input type="text" name="CorreoElectronico" id="CorreoElectronico" class="form-control" />
 -->        <button type="submit" name="RegistrarPedido" class="btn btn-primary">Agregar</button>
        </form>

        <div class="card-bordy" id="ListadoDetallePedido">
            
        </div>

    </div>
    <div id="MensajeTransaccion">
    </div>
</body>
<script>

function mostrarPrecio(id)
    {
        let idProduct = 0;
        <?php
        foreach($ListaProductos as $P)
        { 
        ?>
            idProducto = <?php echo $P->getId();?>;
            if(id==idProducto)
            {
                document.getElementById('precio').value = <?php echo $P->getPrecio(); ?>;
            }
       <?php
        }
        ?>
    }

function calcularValorDetalle()
{
    let cantidad = document.getElementById('cantidad').value;
    let precio = document.getElementById('precio').value;
    document.getElementById('valorDetalle').value = cantidad*precio
}


$(document).ready(function(){
    $( "#frmPedido" ).submit(function( event ) { //Cuando se active el evento sumit del formulario
    event.preventDefault(); //Evitar el envío al servidor de la petición
   //$('#idPedido').val(idPedido);
    if($("#producto").val().length==0){
        alert("Todos los campos son obligatorios");
    }
    else{
        
        
        let url = "../Controlador/ControladorPedidos.php";
        $.ajax({                        
            type: "POST",                 
            url: url,                     
            data: $("#frmPedido").serialize(), 
            success: function(data)             
            {
              $('#MensajeTransaccion').html(data); 
              if(data!="")
              {
                $('#idPedido').val(data);
              }
              listarDetallesPedido();             
            }
        });
    }

    });
});

function listarDetallesPedido()
{
    var formData = new FormData();
    formData.append('ListarDetallePedido','ListarDetallePedido');
    formData.append('idPedido',$("#idPedido").val());
    $.ajax({
        url: '../Controlador/ControladorPedidos.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != 0) {
                $("#ListadoDetallePedido").html(response);
            } else {
                alert('Formato de imagen incorrecto.');
            }
        }
    });
}

</script>
</html>
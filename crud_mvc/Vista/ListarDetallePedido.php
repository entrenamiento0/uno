<?php
require_once("../Controlador/ControladorPedidos.php");
$Controlador = new ControladorPedidos();
$ListaClientes=$Controlador->ListarClientes();
$ListaProductos=$Controlador->ListarProductos();
$ListaDetallesPedido=$Controlador->ListarDetallePedido($_POST["idPedido"]);
?>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id Detalle</th>
                        <th>Id Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Valor Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ListaDetallesPedido as $O){ ?>
                        <tr>
                            <td><?php echo $O->getIdDetalle() ?></td>
                            <td><?php echo $O->getId() ?></td>
                            <td><input type="number" id="cantidad<?php echo $O->getIdDetalle() ?>" 
                            name="cantidad<?php echo $O->getIdDetalle() ?>" 
                            value="<?php echo $O->getCantidad() ?>"
                            onchange="actualizarDetallePedido(<?php echo $O->getIdDetalle(); ?>,this.value)"
                            /></td>
                            <td><?php echo $O->getPrecio() ?></td>
                            <td><?php echo $O->getPrecio()*$O->getCantidad()  ?></td>
                            <td>
                            <a onclick="eliminarDetallePedido(<?php echo $O->getIdDetalle(); ?>)" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<script>
    function eliminarDetallePedido(idDetallePedido)
    {       
         Swal.fire({
            title: '¿Está usted Seguro?',
            text: "Usted no podrá revertir el cambio",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar éste!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
               // window.location =$(this).attr('href');
                var formData = new FormData();
                formData.append('EliminarDetallePedido','EliminarDetallePedido');
                formData.append('idDetallePedido',idDetallePedido);
                $.ajax({
                    url: '../Controlador/ControladorPedidos.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response != 0) {
                            $("#ListadoDetallePedido").html(response);
                            listarDetallesPedido();
                        } else {
                            alert('Formato de imagen incorrecto.');
                        }
                    }
                });
            }
        });
    }

    function actualizarDetallePedido(idDetallePedido,cantidad)
    {   
        var formData = new FormData();
        formData.append('ActualizarDetallePedido','ActualizarDetallePedido');
        formData.append('idDetallePedido',idDetallePedido);
        formData.append('cantidad',cantidad);
        $.ajax({
            url: '../Controlador/ControladorPedidos.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                    $("#ListadoDetallePedido").html(response);
                    listarDetallesPedido();
                } else {
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
    }
</script>
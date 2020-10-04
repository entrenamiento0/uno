<?php


require_once("../Modelo/Conexion.php");
require_once("../Modelo/Cliente.php");
require_once("../Modelo/CRUDCliente.php");
require_once("../Modelo/Pedido.php");
require_once("../Modelo/CRUDPedido.php");

$CRUDCliente = new CRUDCliente();
$ListaClientes = $CRUDCliente->ListarClientes();
$CRUDPedido = new CRUDPedido();
$ListaPedidos = $CRUDPedido->ListarPedidos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <!-- <script src=" https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
-->
<script src="../Librerias/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-4">
    <h1 align="center">Gestionar Pedidos</h1>
        <div class="card border-info">
            <div class="card-header bg-info text-white">
                <a href="../Controlador/ControladorPedidos.php?RegistrarPedido" class="btn btn-primary">Agregar</a>
                <a href="../Librerias/TCPDF-main/examples/pdfUsuarios.php" class="btn btn-success">Imprimir Reporte</a>
            </div>
        </div>
        <div class="card-bordy">
            <table class="table table-striped table-bordered" id="ListadoUsuarios">
                <thead>
                    <tr>
                        <th>IdPedido</th>
                        <th>Cliente</th>
                        <th>Fecha Pedido</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ListaPedidos as $O){ ?>
                        <tr>
                            <td><?php echo $O->getIdPedido() ?></td>
                            <td><?php echo $O->getIdCliente() ?></td>
                            <td><?php echo $O->getFechaRegistro() ?></td>
                            <td><?php echo $O->getIdEstado() ?></td>
                            <td><a href="../Controlador/ControladorPedidos.php?EditarPedido&Id=<?php echo $O->getIdPedido(); ?>" class="btn btn-warning">Editar</a>
                            <a href="../Controlador/ControladorPedidos.php?EliminarUsuario&Id=<?php echo $O->getIdUsuario(); ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
    $('#ListadoUsuarios').DataTable();
} );
</script>

<script>
    $(document).ready(function () {
        $('.btn-danger').on('click', function(e){
            e.preventDefault();

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
                window.location =$(this).attr('href');
                //$(".btn-danger").trigger('click',{}); //Disparar un click
                /*
                Swal.fire(
                'Eliminado!',
                'Su Archivo ha sido eliminado.',
                'success'
                )
                */
            }
            });

        });
    });
</script>
</html>
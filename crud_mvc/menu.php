<?php
session_start();
if(!isset($_SESSION["nombres"]))
{
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 align="center">Bievenido(a) <?php echo $_SESSION["nombres"]; ?></h3>
    <a href="Controlador/Controlador.php?ListarUsuarios">Gestionar Productos</a>
    <a href="Controlador/ControladorPedidos.php?GestionarPedidos">Ventas</a>
    <a href="Vista/CerrarSesion.php">Cerrar Sesión</a>

</body>
</html>
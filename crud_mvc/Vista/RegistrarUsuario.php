<?php 
require_once("../Controlador/Controlador.php");
$Controlador = new Controlador();
$ListaRoles=$Controlador->ListarRol();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4 col-lg-4">
        <h2>Registrar Usuario</h2>
    </div>
    <div class="card-bordy">
        <form name="frmUsuario" method="POST" 
        action="../Controlador/Controlador.php">
            <label>Tipo Documento:</label>
            <select name="TipoDocumento" id="TipoDocumento" class="form-control">
                <option value="">Seleccione</option>
                <option value="CC">Cédula</option>
                <option value="TI">Tarjeta Identidad</option>
            </select>
            <label>Documento:</label>
            <input type="text" name="Documento" id="Documento" class="form-control" />
            <label>Nombres:</label>
            <input type="text" name="Nombres" id="Nombres" class="form-control" />
            <label>Apellidos:</label>
            <input type="text" name="Apellidos" id="Apellidos" class="form-control" />
            <label>Correo Electrónico:</label>
            <input type="text" name="CorreoElectronico" id="CorreoElectronico" class="form-control" />
            <label>Estado:</label>
            <select name="Estado" id="Estado" class="form-control">
                <option value="">Seleccione</option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
            <label>Rol:</label>
            <select name="Rol" id="Rol" class="form-control">
                <option value="">Seleccione</option>
                <?php
                foreach($ListaRoles as $Rol){
                    ?>
                    <option value="<?php echo $Rol->getIdRol() ?>">
                    <?php echo $Rol->getNombreRol(); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <button type="submit" name="RegistrarUsuario" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
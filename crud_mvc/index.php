<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 align="center">Login</h2>
    <form action="Controlador/Controlador.php" align="center" method="POST">
        <label>Usuario:</label>
        <input type="text" name="nombreUsuario" id="nombreUsuario">
        <br/>
        <label>Contraseña:</label>
        <input type="password" name="contrasenaUsuario" id="contrasenaUsuario">
        <br/>
        <button type="submit" name="Acceder">Acceder</button>
    </form>
</body>
</html>
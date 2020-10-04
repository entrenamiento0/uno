<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<?php
require_once("../Modelo/Conexion.php"); //Incluir la conexión
require_once("../Modelo/Usuario.php");
require_once("../Modelo/CRUDUsuario.php");
require_once("../Modelo/Cliente.php");
require_once("../Modelo/CRUDCliente.php");
require_once("../Modelo/Producto.php");
require_once("../Modelo/CRUDProducto.php");
require_once("../Modelo/Rol.php");
require_once("../Modelo/CRUDRol.php");
require_once("../Modelo/Pedido.php");
require_once("../Modelo/CRUDPedido.php");
require_once("../Modelo/DetallePedido.php");
require_once("../Modelo/CRUDDetallePedido.php");


class Controlador{
    public function __construct(){}

    public function RegistrarUsuario(){
        $Usuario = new Usuario();
        $CRUDUsuario = new CRUDUsuario();
        $Usuario->setTipoDocumento($_POST["TipoDocumento"]);
        $Usuario->setNumeroDocumento($_POST["Documento"]);
        $Usuario->setNombres($_POST["Nombres"]);
        $Usuario->setApellidos($_POST["Apellidos"]);
        $Usuario->setCorreoElectronico($_POST["CorreoElectronico"]);
        $Usuario->setIdEstado($_POST["Estado"]);
        $Usuario->setIdRol($_POST["Rol"]);
        $CRUDUsuario->RegistrarUsuario($Usuario); 
    }

    public function EditarUsuario(){
        $Usuario = new Usuario();
        $CRUDUsuario = new CRUDUsuario();
        $Usuario->setIdUsuario($_POST["IdUsuario"]);
        $Usuario->setTipoDocumento($_POST["TipoDocumento"]);
        $Usuario->setNumeroDocumento($_POST["Documento"]);
        $Usuario->setNombres($_POST["Nombres"]);
        $Usuario->setApellidos($_POST["Apellidos"]);
        $Usuario->setCorreoElectronico($_POST["CorreoElectronico"]);
        $Usuario->setIdEstado($_POST["Estado"]);
        $Usuario->setIdRol($_POST["Rol"]);
        $CRUDUsuario->EditarUsuario($Usuario); 
    }

    public function BuscarUsuario($IdUsuario){
        $Usuario = new Usuario();
        $CRUDUsuario = new CRUDUsuario();
        return $CRUDUsuario->BuscarUsuario($IdUsuario);
    }

    public function EliminarUsuario($IdUsuario){
        $Usuario = new Usuario();
        $CRUDUsuario = new CRUDUsuario();
        return $CRUDUsuario->EliminarUsuario($IdUsuario);
    }

    public function ListarRol()
    {
        $CRUDRol = new CRUDRol();
        $ListaRoles = $CRUDRol->ListarRoles();
        return $ListaRoles;
    }

    public function ListarClientes()
    {
        $CRUDCliente = new CRUDCliente();
        $ListaClientes = $CRUDCliente->ListarClientes();
        return $ListaClientes;
    }

    public function ListarProductos()
    {
        $CRUDProducto = new CRUDProducto();
        $ListaProductos = $CRUDProducto->ListarProductos();
        return $ListaProductos;
    }

    
    public function ListarDetallePedido()
    {
        $CRUDDetallePedido = new CRUDDetallePedido();
        $Lista = $CRUDDetallePedido->ListarDetallePedido();
        return $Lista;
    }

    public function RegistrarPedido(){
        $Pedido = new Pedido();
        $CRUDPedido = new CRUDPedido();
        $Pedido->setIdCliente($_POST["cliente"]);
        return $CRUDPedido->RegistrarPedido($Pedido); 
    }

    public function RegistrarDetallePedido(){
        $DetallePedido = new DetallePedido();
        $CRUDDetallePedido = new CRUDDetallePedido();
        $DetallePedido->setIdPedido(1);
        $DetallePedido->setId($_POST["producto"]);
        $DetallePedido->setPrecio($_POST["precio"]);
        $DetallePedido->setCantidad($_POST["cantidad"]);
        $CRUDDetallePedido->RegistrarDetallePedido($DetallePedido); 
    }


    public function DesplegarVista($ruta){
        require_once($ruta);
    }

    public function VerificarLogin($nombreUsuario,$contrasenaUsuario)
    {
        $Usuario = new Usuario();
        $CRUDUsuario = new CRUDUsuario();
        $Usuario->setCorreoElectronico($nombreUsuario);
        $Usuario->setContrasena($contrasenaUsuario);
        $Usuario = $CRUDUsuario->VerificarLogin($Usuario);
        if($Usuario->getExiste() == 1)
        {
            //Variables de sesión
            session_start();
            //Definir variables de sesion
            $_SESSION["idUsuario"] = $Usuario->getIdUsuario();
            $_SESSION["nombres"] = $Usuario->getNombres()." ".$Usuario->getApellidos();
            header("Location:../menu.php");
        }
        else
        {
            header("Location:../index.php");
        }
    }
}

//isset: Función que determina si una variable existe
$Controlador = new Controlador();
if(isset($_GET["RegistrarUsuario"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/RegistrarUsuario.php");
}
elseif(isset($_POST["RegistrarUsuario"])){
    $Controlador->RegistrarUsuario();
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
    Swal.fire({ 
      position: 'top-end',
      icon: 'success',
      title: 'El registro ha sido eliminado',
      showConfirmButton: false,
      timer: 500
      }).then(function() {
        // Redirect the user
        window.location.href = "../Vista/ListarUsuarios.php";
        })});
    </script>
    <?php
    //$Controlador->DesplegarVista("../Vista/ListarUsuarios.php");
}
elseif(isset($_GET["EditarUsuario"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/EditarUsuario.php");
}
elseif(isset($_POST["EditarUsuario"])){
    $Controlador->EditarUsuario();
    $Controlador->DesplegarVista("../Vista/ListarUsuarios.php");
}
elseif(isset($_GET["EliminarUsuario"])){
    
    if($Controlador->EliminarUsuario($_GET["IdUsuario"])==1)
    {
        ?>
        <script type="text/javascript">
    $(document).ready(function() {
    Swal.fire({ 
      position: 'top-center',
      icon: 'success',
      title: 'El registro ha sido eliminado',
      showConfirmButton: false,
      timer: 500
      }).then(function() {
        // Redirect the user
        window.location.href = "../Vista/ListarUsuarios.php";
        })});
        </script>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
    $(document).ready(function() {
    Swal.fire({ 
      position: 'top-end',
      icon: 'success',
      title: 'El registro ha sido eliminado',
      showConfirmButton: false,
      timer: 500
      }).then(function() {
        // Redirect the user
        window.location.href = "../Vista/ListarUsuarios.php";
        })});
    </script>
    <?php
    }
    $Controlador->DesplegarVista("../Vista/ListarUsuarios.php");
}
elseif(isset($_GET["ListarUsuarios"])){
    $Controlador->DesplegarVista("../Vista/ListarUsuarios.php");
}
elseif(isset($_POST["Acceder"])){
    $Controlador->VerificarLogin($_POST["nombreUsuario"],$_POST["contrasenaUsuario"]);
}
elseif(isset($_GET["GestionarVentas"])){
    $Controlador->DesplegarVista("../Vista/ListarVentas.php");
}
if(isset($_GET["RegistrarVenta"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/RegistrarVenta.php");
}
if(isset($_POST["RegistrarVenta"])){
    //Redireccionar hacia una página(Vista)
    //$Controlador->DesplegarVista("../Vista/RegistrarVenta.php");
    //echo "ddddddd";
   // echo $Controlador->RegistrarPedido();
    //$Controlador->RegistrarDetallePedido();
    echo 1;
}
if(isset($_POST["ListarDetallePedido"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/ListarDetallePedido.php");
    //echo "ddddddd";
    //$Controlador->ListarDetallePedido();
}


?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
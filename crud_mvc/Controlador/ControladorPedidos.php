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


class ControladorPedidos{
    public function __construct(){}

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

    
    public function ListarDetallePedido($idPedido)
    {
        $CRUDDetallePedido = new CRUDDetallePedido();
        $Lista = $CRUDDetallePedido->ListarDetallePedido($idPedido);
        return $Lista;
    }

    public function EliminarDetallePedido($idDetallePedido)
    {
        $CRUDDetallePedido = new CRUDDetallePedido();
        return $CRUDDetallePedido->EliminarDetallePedido($idDetallePedido);
    }

    public function ActualizarDetallePedido($idDetallePedido,$cantidad)
    {
        $CRUDDetallePedido = new CRUDDetallePedido();
        return $CRUDDetallePedido->ActualizarDetallePedido($idDetallePedido,$cantidad);
    }

    public function BuscarPedido($IdPedido){
        $Pedido = new Pedido();
        $CRUDPedido = new CRUDPedido();
        return $CRUDPedido->BuscarPedido($IdPedido);
    }


    public function RegistrarPedido(){
        $Pedido = new Pedido();
        $CRUDPedido = new CRUDPedido();
        $Pedido->setIdCliente($_POST["cliente"]);
        return $CRUDPedido->RegistrarPedido($Pedido); 
    }

    public function RegistrarDetallePedido($idPedido){
        $DetallePedido = new DetallePedido();
        $CRUDDetallePedido = new CRUDDetallePedido();
        $DetallePedido->setIdPedido($idPedido);
        $DetallePedido->setId($_POST["producto"]);
        $DetallePedido->setPrecio($_POST["precio"]);
        $DetallePedido->setCantidad($_POST["cantidad"]);
        $CRUDDetallePedido->RegistrarDetallePedido($DetallePedido); 
    }


    public function DesplegarVista($ruta){
        require_once($ruta);
    }

 }

 $Controlador = new ControladorPedidos();
if(isset($_GET["GestionarPedidos"])){
    $Controlador->DesplegarVista("../Vista/ListarPedidos.php");
}
if(isset($_GET["RegistrarPedido"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/RegistrarPedido.php");
}
if(isset($_POST["RegistrarPedido"])){
    $idPedido = $_POST["idPedido"];
    if($_POST["idPedido"]=="")
    {
        $idPedido = $_POST["idPedido"]=$Controlador->RegistrarPedido();
        echo $idPedido;
    }
    $Controlador->RegistrarDetallePedido($idPedido);
}
if(isset($_POST["ListarDetallePedido"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/ListarDetallePedido.php");
}
if(isset($_POST["EliminarDetallePedido"])){
    //Redireccionar hacia una página(Vista)
   echo $Controlador->EliminarDetallePedido($_POST["idDetallePedido"]);
}
if(isset($_POST["ActualizarDetallePedido"])){
    //Redireccionar hacia una página(Vista)
   echo $Controlador->ActualizarDetallePedido($_POST["idDetallePedido"],$_POST["cantidad"]);
}
if(isset($_GET["EditarPedido"])){
    //Redireccionar hacia una página(Vista)
    $Controlador->DesplegarVista("../Vista/EditarPedido.php");
}



?>
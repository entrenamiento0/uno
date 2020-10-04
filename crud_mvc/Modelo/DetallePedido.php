<?php
require_once("Producto.php");
class DetallePedido extends Producto
{
    private $IdPedido;
    private $IdDetalle;
    private $Cantidad;

    public function __construct()
    {

    }

    public function setIdPedido($IdPedido){
        $this->IdPedido = $IdPedido;
    }

    public function getIdPedido(){
        return $this->IdPedido;
    }

    public function setIdDetalle($IdDetalle){
        $this->IdDetalle = $IdDetalle;
    }

    public function getIdDetalle(){
        return $this->IdDetalle;
    }

    public function setCantidad($Cantidad){
        $this->Cantidad = $Cantidad;
    }

    public function getCantidad(){
        return $this->Cantidad;
    }
}
?>
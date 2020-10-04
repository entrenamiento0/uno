<?php
    class Pedido{
        private $IdPedido;
        private $IdCliente;
        private $FechaRegistro;
        private $IdEstado;

        public function __construct(){}

        public function setIdPedido($IdPedido){
            $this->IdPedido = $IdPedido;
        }

        public function getIdPedido(){
            return $this->IdPedido;
        }

        public function setIdCliente($IdCliente){
            $this->IdCliente = $IdCliente;
        }

        public function getIdCliente(){
            return $this->IdCliente;
        }

        public function setFechaRegistro($FechaRegistro){
            $this->FechaRegistro = $FechaRegistro;
        }

        public function getFechaRegistro(){
            return $this->FechaRegistro;
        }

        public function setIdEstado($IdEstado){
            $this->IdEstado = $IdEstado;
        }
    
        public function getIdEstado(){
            return $this->IdEstado;
        }
    }
?>
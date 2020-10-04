<?php
    class Producto{
        private $Id;
        private $Nombre;
        private $Precio;
        private $IdEstado;

        public function __construct(){}

        public function setId($Id){
            $this->Id = $Id;
        }

        public function getId(){
            return $this->Id;
        }

        public function setNombre($Nombre){
            $this->Nombre = $Nombre;
        }

        public function getNombre(){
            return $this->Nombre;
        }

        
        public function setPrecio($Precio){
            $this->Precio = $Precio;
        }

        public function getPrecio(){
            return $this->Precio;
        }

        public function getIdEstado(){
            return $this->IdEstado;
        }
    
        public function setExiste($Existe){
            $this->Existe = $Existe;
        }
    }
?>
<?php
    class Rol{
        private $IdRol;
        private $NombreRol;

        public function __construct(){}

        public function setIdRol($IdRol){
            $this->IdRol = $IdRol;
        }

        public function getIdRol(){
            return $this->IdRol;
        }

        public function setNombreRol($NombreRol){
            $this->NombreRol = $NombreRol;
        }

        public function getNombreRol(){
            return $this->NombreRol;
        }
    }
?>
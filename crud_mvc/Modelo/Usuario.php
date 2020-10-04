<?php
require_once("Persona.php");
class Usuario extends Persona{
    //Definición de atributos
    private $Contrasena;
    private $IdEstado;
    private $IdRol;
    private $Existe;
    
    public function __construct(){
    }

       public function setContrasena($Contrasena){
        $this->Contrasena = $Contrasena;
    }

    public function getContrasena(){
        return $this->Contrasena;
    }

    public function setIdRol($IdRol){
        $this->IdRol = $IdRol;
    }

    public function getIdRol(){
        return $this->IdRol;
    }

    public function setIdEstado($IdEstado){
        $this->IdEstado = $IdEstado;
    }

    public function getIdEstado(){
        return $this->IdEstado;
    }

    public function setExiste($Existe){
        $this->Existe = $Existe;
    }

    public function getExiste(){
        return $this->Existe;
    }
}
?>
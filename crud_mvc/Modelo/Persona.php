<?php
class Persona{
    //Definición de atributos
    private $IdUsuario;
    private $TipoDocumento;	
    private $NumeroDocumento;	
    private $Nombres;
    private $Apellidos;
    private $CorreoElectronico;
    
    public function __construct(){
    }

    public function setIdUsuario($IdUsuario){
        $this->IdUsuario = $IdUsuario;
    }

    public function getIdUsuario(){
        return $this->IdUsuario;
    }

    public function setTipoDocumento($TipoDocumento){
        $this->TipoDocumento = $TipoDocumento;
    }

    public function getTipoDocumento(){
        return $this->TipoDocumento;
    }

    public function setNumeroDocumento($NumeroDocumento){
        $this->NumeroDocumento = $NumeroDocumento;
    }

    public function getNumeroDocumento(){
        return $this->NumeroDocumento;
    }

    public function setNombres($Nombres){
        $this->Nombres = $Nombres;
    }

    public function getNombres(){
        return $this->Nombres;
    }

    public function setApellidos($Apellidos){
        $this->Apellidos = $Apellidos;
    }

    public function getApellidos(){
        return $this->Apellidos;
    }

    public function setCorreoElectronico($CorreoElectronico){
        $this->CorreoElectronico = $CorreoElectronico;
    }

    public function getCorreoElectronico(){
        return $this->CorreoElectronico;
    }
}
?>
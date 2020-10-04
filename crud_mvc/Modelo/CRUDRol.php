<?php
class CRUDRol{
    public function __construct(){}

    public function ListarRoles(){
        //Conectar a la DB
        $Db = Db::Conectar();
        $ListaRoles = [];
        //Define la consulta
        /*$Sql = $Db->prepare('SELECT * FROM roles WHERE IdRol:IdRol');
        $Sql->bindValue('IdRol',$IdRol);
        */
        $Sql = $Db->prepare('SELECT * FROM roles');
         //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Rol){
            $R = new Rol(); //Crear un objeto de tipo usuario
            $R->setIdRol($Rol['IdRol']);
            $R->setNombreRol($Rol['NombreRol']);
            $ListaRoles[] = $R; //Asisgar a la lista el objeto.
       }
       Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
       return $ListaRoles; //Retornar el array de objetos.
   }
}
?>
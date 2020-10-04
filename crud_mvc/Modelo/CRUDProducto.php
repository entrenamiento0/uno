<?php
class CRUDProducto{
    public function __construct(){}

    public function ListarProductos(){
        //Conectar a la DB
        $Db = Db::Conectar();
        $Lista = [];
        //Define la consulta
        /*$Sql = $Db->prepare('SELECT * FROM roles WHERE IdRol:IdRol');
        $Sql->bindValue('IdRol',$IdRol);
        */
        $Sql = $Db->prepare('SELECT * FROM productos');
         //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Producto){
            $P = new Producto(); //Crear un objeto de tipo usuario
            $P->setId($Producto['IdProducto']);
            $P->setNombre($Producto['NombreProducto']);
            $P->setPrecio($Producto['PrecioProducto']);
            $Lista[] = $P; //Asisgar a la lista el objeto.
       }
       Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
       return $Lista; //Retornar el array de objetos.
   }
}
?>
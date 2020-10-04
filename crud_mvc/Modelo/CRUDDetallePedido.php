<?php
class CRUDDetallePedido{
    public function __construct(){}

    public function ListarDetallePedido($idPedido){
        //Conectar a la DB
        $Db = Db::Conectar();
        $Lista = [];
        //Define la consulta
        $Sql = $Db->query("SELECT * FROM detallepedidos WHERE idPedido=$idPedido");
        //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Registro){
            $O = new DetallePedido(); //Crear uel objeto
            $O->setIdDetalle($Registro['IdDetallePedido']);
            $O->setId($Registro['IdPedido']);
            $O->setCantidad($Registro['Cantidad']);
            $O->setPrecio($Registro['Precio']);
            $Lista[] = $O; //Asisgar a la lista el objeto.
        }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
        return $Lista; //Retornar el array de objetos.
    }

    public function EliminarDetallePedido($IdDetallePedido){
        //Conectar a la DB
        $mensaje = "";
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM detallepedidos 
        WHERE IdDetallePedido=:IdDetallePedido');
        $Sql->bindValue('IdDetallePedido',$IdDetallePedido);
        //Ejecuta la consulta
        try{
            $Sql->execute();
            $mensaje=1;
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
        }
    Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
    return $mensaje;
}

public function ActualizarDetallePedido($IdDetallePedido,$cantidad){
    //Conectar a la DB
    $Db = Db::Conectar();
    //Definir el SQL
    $Sql = $Db->prepare('UPDATE detallepedidos SET
        Cantidad=:Cantidad
        WHERE IdDetallePedido=:IdDetallePedido');
        $Sql->bindValue('Cantidad',$cantidad);
        $Sql->bindValue('IdDetallePedido',$IdDetallePedido);
        try{
            $Sql->execute();
            $mensaje = 1;
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();
        }
    Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
    return $mensaje;
}

    public function RegistrarDetallePedido($DetallePedido){
        //Conectar a la DB
        $Db = Db::Conectar();
        //Definir el SQL
        $Sql = $Db->prepare('INSERT INTO detallepedidos(
            IdPedido,IdProducto,Cantidad,Precio)
            VALUES(:IdPedido,:IdProducto,:Cantidad,
            :Precio)');
            $Sql->bindValue('IdPedido',$DetallePedido->getIdPedido());
            $Sql->bindValue('IdProducto',$DetallePedido->getId());
            $Sql->bindValue('Cantidad',$DetallePedido->getCantidad());
            $Sql->bindValue('Precio',$DetallePedido->getPrecio());
            try{
                $Sql->execute();
            }
            catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
    }

     public function EditarUsuario($Usuario){
        //Conectar a la DB
        $Db = Db::Conectar();
        //Definir el SQL
        $Sql = $Db->prepare('UPDATE usuarios1 SET
            TipoDocumento=:TipoDocumento,
            NumeroDocumento=:NumeroDocumento,
            Nombres=:Nombres,
            Apellidos=:Apellidos,
            CorreoElectronico=:CorreoElectronico,
            IdEstado=:IdEstado,
            IdRol=:IdRol
            WHERE IdUsuario=:IdUsuario');
            $Sql->bindValue('TipoDocumento',$Usuario->getTipoDocumento());
            $Sql->bindValue('NumeroDocumento',$Usuario->getNumeroDocumento());
            $Sql->bindValue('Nombres',$Usuario->getNombres());
            $Sql->bindValue('Apellidos',$Usuario->getApellidos());
            $Sql->bindValue('CorreoElectronico',$Usuario->getCorreoElectronico());
            $Sql->bindValue('IdEstado',$Usuario->getIdEstado());
            $Sql->bindValue('IdRol',$Usuario->getIdRol());
            $Sql->bindValue('IdUsuario',$Usuario->getIdUsuario());
        var_dump($Sql);
            try{
                $Sql->execute();
                echo "Actualización Exitosa";
            }
            catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
    }

    public function BuscarUsuario($IdUsuario){
        //Conectar a la DB
        $Db = Db::Conectar();
        //$ListaUsuarios = [];
        //Define la consulta
       // $Sql = $Db->query("SELECT * FROM usuarios1 WHERE IdUsuario=$IdUsuario");
        $Sql = $Db->prepare('SELECT * FROM usuarios1 WHERE IdUsuario=:IdUsuario');
        $Sql->bindValue('IdUsuario',$IdUsuario);
        //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Usuario){
            $U = new Usuario(); //Crear un objeto de tipo usuario
            $U->setIdUsuario($Usuario['IdUsuario']);
            $U->setTipoDocumento($Usuario['TipoDocumento']);
            $U->setNumeroDocumento($Usuario['NumeroDocumento']);
            $U->setNombres($Usuario['Nombres']);
            $U->setApellidos($Usuario['Apellidos']);
            $U->setCorreoElectronico($Usuario['CorreoElectronico']);
            $U->setIdEstado($Usuario['IdEstado']);
            $U->setIdRol($Usuario['IdRol']);
            //$ListaUsuarios[] = $U; //Asisgar a la lista el objeto.
        }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
        return $U; //Retornar el array de objetos.
    }

    public function EliminarUsuario($IdUsuario){
        //Conectar a la DB
        $mensaje = "";
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM usuarios1 WHERE IdUsuario=:IdUsuario');
        $Sql->bindValue('IdUsuario',$IdUsuario);
        //Ejecuta la consulta
        try{
            $Sql->execute();
            $mensaje=1;
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
        }
    Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
    return $mensaje;
}


}

?>
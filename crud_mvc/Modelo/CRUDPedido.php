<?php
class CRUDPedido{
    public function __construct(){}

    public function ListarPedidos(){
        //Conectar a la DB
        $Db = Db::Conectar();
        $Lista = [];
        //Define la consulta
        $Sql = $Db->query('SELECT * FROM pedidos');
        //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Registro){
            $O = new Pedido(); //Crear uel objeto
            $O->setIdPedido($Registro['IdPedido']);
            $O->setIdCliente($Registro['IdCliente']);
            $O->setFechaRegistro($Registro['Fecha']);
            $O->setIdEstado($Registro['IdEstado']);
            $Lista[] = $O; //Asisgar a la lista el objeto.
        }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
        return $Lista; //Retornar el array de objetos.
    }

    public function RegistrarPedido($Pedido){
        //Conectar a la DB
        $Db = Db::Conectar();
        //Definir el SQL
        $id = -1;
        $Sql = $Db->prepare('INSERT INTO pedidos(
            IdCliente,Fecha,IdEstado)
            VALUES(:IdCliente,NOW(),:IdEstado)');
            $Sql->bindValue('IdCliente',$Pedido->getIdCliente());
            $Sql->bindValue('IdEstado',1);
            try{
                $Sql->execute();
                $id = $Db->lastInsertId();
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
        return $id;
    }

    public function BuscarPedido($IdPedido){
        //Conectar a la DB
        $Db = Db::Conectar();
        //$ListaUsuarios = [];
        //Define la consulta
       // $Sql = $Db->query("SELECT * FROM usuarios1 WHERE IdUsuario=$IdUsuario");
        $Sql = $Db->prepare('SELECT * FROM pedidos WHERE IdPedido=:IdPedido');
        $Sql->bindValue('IdPedido',$IdPedido);
        //Ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Registro){
            $O = new Pedido(); //Crear un objeto de tipo usuario
            $O->setIdPedido($Registro['IdPedido']);
            $O->setIdCliente($Registro['IdCliente']);
            $O->setFechaRegistro($Registro['Fecha']);
            $O->setIdEstado($Registro['IdEstado']);
            //$ListaUsuarios[] = $U; //Asisgar a la lista el objeto.
        }
        Db::CerrarConexion($Db); //LLamar el método para cerrar la conexión.
        return $O; //Retornar el array de objetos.
    } 
    


    public function RegistrarUsuario($Usuario){
        //Conectar a la DB
        $Db = Db::Conectar();
        //Definir el SQL
        $Sql = $Db->prepare('INSERT INTO usuarios1(
            TipoDocumento,NumeroDocumento,Nombres,Apellidos,
            CorreoElectronico,Contrasena,IdEstado,IdRol)
            VALUES(:TipoDocumento,:Documento,:Nombres,
            :Apellidos,:CorreoElectronico,:Contrasena,
            :IdEstado,:IdRol)');
            $Sql->bindValue('TipoDocumento',$Usuario->getTipoDocumento());
            $Sql->bindValue('Documento',$Usuario->getNumeroDocumento());
            $Sql->bindValue('Nombres',$Usuario->getNombres());
            $Sql->bindValue('Apellidos',$Usuario->getApellidos());
            $Sql->bindValue('CorreoElectronico',$Usuario->getCorreoElectronico());
            $Sql->bindValue('Contrasena',md5($Usuario->getNumeroDocumento()));
            $Sql->bindValue('IdEstado',$Usuario->getIdEstado());
            $Sql->bindValue('IdRol',$Usuario->getIdRol());
        var_dump($Sql);
            try{
                $Sql->execute();
                echo "Registro Exitoso";
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
<?php
    class Db{
        private static $conexion=null;
        private function __construct (){}

        public static function Conectar(){
            $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            self::$conexion = new PDO('mysql:host=localhost;dbname=crud_mvc','root','',$pdo_options);
            return self::$conexion;
        }

        static function CerrarConexion(&$conexion) { //Cerrar Conexión
            $conexion=null;
        }
    }
    $Db=Db::Conectar();
    /*
    mysqli
    mysql
    pdo
    */
?>
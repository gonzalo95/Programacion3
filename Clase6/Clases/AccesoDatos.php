<?php
    class AccesoDatos
    {
        private static $_objetoAccesoDatos;
        private $_objetoPDO;
     
        private function __construct()
        {
            try 
            {
                $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=alumnos;charset=utf8', 'root', ''); //user: root; pass: ''
     
            } 
            catch (PDOException $e) 
            {
                print "Error<br/>" . $e->getMessage();
     
                die();
            }
        }
     
        public function RetornarConsulta($sql)
        {
            return $this->_objetoPDO->prepare($sql);
        }
     
        public static function DameUnObjetoAcceso()//singleton=>Solo debe existir una instancia en todo el programa, ergo encapsulo el constructor
        {
            if (!isset(self::$_objetoAccesoDatos)) 
            {       
                self::$_objetoAccesoDatos = new AccesoDatos(); 
            }
     
            return self::$_objetoAccesoDatos;        
        }
}

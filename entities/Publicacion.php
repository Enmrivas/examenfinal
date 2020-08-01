<?php

    class Account{
    

        public $id;        
        public $titulo;
        public $contenido;
        public $fecha;
        public $idUsuario;

        public function __construct(){

        }

        public function set($data){
            foreach ($data as $key => $value) $this->{$key} = $value;
        }

        public function initializeData($id, $titulo, $contenido, $fecha, $idUsuario){

            
            $this->id = $id;
            $this->nombre = $titulo;
            $this->apellido = $contenido;
            $this->correo = $fecha;
            $this->usuario = $idUsuario;
            
        }

    
    }


?>
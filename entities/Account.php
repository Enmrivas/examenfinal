<?php

    class Account{
    

        public $id;        
        public $fotoPerfil;
        public $nombre;
        public $apellido;
        public $correo;
        public $usuario;
        public $pass;

        public function __construct(){

        }

        public function set($data){
            foreach ($data as $key => $value) $this->{$key} = $value;
        }

        public function initializeData($id, $nombre, $apellido, $correo, $usuario, $pass){

            
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->correo = $correo;
            $this->usuario = $usuario;
            $this->pass = $pass;
            
        }

    
    }


?>
<?php

    class Publicacion{
    

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
            $this->titulo = $titulo;
            $this->contenido = $contenido;
            $this->fecha = $fecha;
            $this->idUsuario = $idUsuario;
            
        }

    
    }


?>
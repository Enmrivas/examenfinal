<?php

class DatabaseContext{

    public $db;
    private $fileHandler;

    function __construct($directory){
        $this->fileHandler = new JsonFileHandler($directory, "config");
        $config = $this->fileHandler->ReadConfiguration();
        $this->db = new mysqli($config->server, $config->user, $config->password, $config->database);

        if($this->db->connect_error){
            exit('Error al conectar a la base de datos');
        }

    }

}

?>
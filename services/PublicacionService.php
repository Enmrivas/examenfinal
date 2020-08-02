<?php

class PublicacionService implements ServiceBase{

    private $context;
    public $filehandler;
    public $directory;
    public $filename;

    public function __construct($directory){

        $this->context = new DatabaseContext($directory);

    }

    public function GetList(){

        $listPosts = array();

        $stmnt = $this->context->db->prepare("Select * from publicaciones");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listPosts;
        }else{

            while($row = $result->fetch_object()){

                $posts = new Publicacion();

                $posts->id = $row->id;
                $posts->titulo = $row->titulo;
                $posts->contenido = $row->contenido;
                $posts->fecha = $row->fecha;

                array_push($listPosts, $posts);

            }

        }
        $stmnt->close();
        return $listPosts;

    }

    public function GetById($id){

        $posts = new Publicacion();

        $stmnt = $this->context->db->prepare("Select * from publicaciones where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($row = $result->fetch_object()){

                $posts = new Publicacion();

                $posts->id = $row->id;
                $posts->titulo = $row->titulo;
                $posts->contenido = $row->contenido;
                $posts->fecha = $row->fecha;
                $posts->idUsuario = $row->idUsuario;

            }

        }
        $stmnt->close();
        return $posts;

    }


    public function GetByUserId($id){

        $listPosts = array();

        $posts = new Publicacion();

        $stmnt = $this->context->db->prepare("Select * from publicaciones where idUsuario = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($row = $result->fetch_object()){

                $posts = new Publicacion();

                $posts->id = $row->id;
                $posts->titulo = $row->titulo;
                $posts->contenido = $row->contenido;
                $posts->fecha = $row->fecha;
                $posts->idUsuario = $row->idUsuario;

                array_push($listPosts, $posts);

            }

        }
        $stmnt->close();
        return $listPosts;

    }

    public function Add($entidad){
        $stmnt = $this->context->db->prepare("Insert into publicaciones (titulo, contenido, fecha, idUsuario) values (?,?,?,?)");
        $stmnt->bind_param("ssss", $entidad->titulo, $entidad->contenido, $entidad->fecha, $entidad->idUsuario);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Update($id, $entidad){

        $stmnt = $this->context->db->prepare("update publicaciones set titulo = ?, contenido = ?, fecha = ?, idUsuario = ? where id = ?");
        $stmnt->bind_param("sssii", $entidad->titulo, $entidad->contenido, $entidad->fecha, $entidad->idUsuario, $id);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from publicaciones where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }
}

?>
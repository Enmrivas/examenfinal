<?php

class AccountService implements ServiceBase{

    private $utilities;
    private $context;
    public $filehandler;
    public $directory;
    public $filename;

    public function __construct($directory){

        $this->utilities = new Utilities();
        $this->context = new DatabaseContext($directory);
        $this->directory = "data";
        $this->filename = "accounts";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);

    }

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from account");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCuentas;
        }else{

            while($row = $result->fetch_object()){

                $account = new Account();

                $account->id = $row->id;
                $account->nombre = $row->nombre;
                $account->apellido = $row->apellido;
                $account->correo = $row->correo;
                $account->usuario = $row->usuario;
                $account->pass = $row->pass;

                array_push($listCuentas, $account);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function GetById($id){

        $account = new Account();

        $stmnt = $this->context->db->prepare("Select * from account where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($row = $result->fetch_object()){

                $account->id = $row->id;
                $account->nombre = $row->nombre;
                $account->apellido = $row->apellido;
                $account->correo = $row->correo;
                $account->usuario = $row->usuario;
                $account->pass = $row->pass;

            }

        }
        $stmnt->close();
        return $account;

    }

    public function Add($entidad){


        $stmnt = $this->context->db->prepare("Insert into account (nombre, apellido, correo, usuario, pass) values (?,?,?,?,?)");
        $stmnt->bind_param("sssss", $entidad->nombre, $entidad->apellido, $entidad->correo, $entidad->usuario, $entidad->pass);
        $stmnt->execute();
        $stmnt->close();

        $accountID = $this->context->db->insert_id;

        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){
                $entidad->fotoPerfil = "";
            }else{

                $typeReplace = str_replace("image/", "", $_FILES['fotoPerfil']['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $accountID . '.' . $typeReplace;
                $tmpname = $fotoFile['tmp_name'];

                $success = $this->utilities->agregarImagen('../image/cuentas/', $nombre, $tmpname, $type, $size);

                if($success){
                    $stmnt = $this->context->db->prepare("update account set fotoPerfil = ? where id = ?");
                    $stmnt->bind_param("si", $nombre, $accountID);
                    $stmnt->execute();
                    $stmnt->close();
                }
            }

        }

    }

    public function Update($id, $entidad){

        $element = $this->GetById($id);

        $stmnt = $this->context->db->prepare("update account set nombre = ?, apellido = ?, correo = ?, usuario = ?, pass = ? where id = ?");
        $stmnt->bind_param("sssssi", $entidad->nombre, $entidad->apellido, $entidad->correo, $entidad->usuario, $entidad->pass, $id);
        $stmnt->execute();
        $stmnt->close();
        
        
        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){

                $entidad->fotoPerfil = $element->fotoPerfil;

            }else{
                $typeReplace = str_replace("image/", "", $fotoFile['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $id . '.' . $typeReplace;
                $tmpFile = $fotoFile['tmp_name'];
    
                $success = $this->utilities->agregarImagen('../image/cuentas/', $nombre, $tmpFile, $type, $size);
    
                if($success){
                    $stmnt = $this->context->db->prepare("update account set fotoPerfil = ? where id = ?");
                    $stmnt->bind_param("si", $nombre, $id);
                    $stmnt->execute();
                    $stmnt->close();
                }
            }

            

        }
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from account where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }
}

?>
<?php
class UserService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    
    public function Login($usuario, $pass)
    {
        $stmnt = $this->context->db->prepare("Select * from account where usuario = ? and pass = ?");
        $stmnt->bind_param("ss", $usuario, $pass);
        $stmnt->execute();
        $result = $stmnt->get_result();
        
        if($result->num_rows === 0)
        {
            return null;
        }
        else
        {
            $entidad = $result->fetch_object();
            $user = new Account();

            $user->id = $entidad->id;
            $user->nombre = $entidad->nombre;
            $user->apellido = $entidad->apellido;
            $user->correo = $entidad->correo;
            $user->usuario = $entidad->usuario;
            $user->pass = $entidad->pass;
            
            return $user;
        }
    }
}

?>
<?php

interface ServiceBase{

    public function GetById($id);
    public function GetList();
    public function Add($entidad);
    public function Update($id, $entidad);
    public function Delete($id);


}

?>
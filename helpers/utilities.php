<?php

class Utilities{

    public function getLast($list){
        $countList = count($list);
        $lastElem = $list[$countList - 1];
    
        return $lastElem;
    }
    
    
    public function filtro($list, $filtro, $value){
    
        $filter = [];
        foreach($list as $item){
            if($item->$filtro == $value){
                array_push($filter, $item);
            }
        }
    
        return $filter;
    
    }

    public function GetCookieTime(){
        return time() + 60*60*24*30;
    }

    public function buscarID($list, $filtro, $value){
    
        $index = 0;
        foreach($list as $key => $item){
            if($item->$filtro == $value){
                $index = $key;
            }
        }
    
        return $index;
    
    }

    public function agregarImagen($directorio, $nombre, $tmpFile, $type, $size){

        $success = false;

        if(($type == "image/gif") || ($type == "image/jpg") || ($type == "image/jpeg") || ($type == "image/png") || ($type == "image/JPG") || ($type == "image/pjpeg") && ($size < 1000000) ){

            if(!file_exists($directorio)){
                
                mkdir($directorio, 0777, true);

                if(file_exists($directorio)){

                    $this->uploadFile($directorio . $nombre, $tmpFile);
                    $success = true;

                }

            }else {

                $this->uploadFile($nombre, $tmpFile);
                $success = true;

            }

        }else{
            $success = false;
        }

        return $success;
    }

    private function uploadFile($nombre, $tmpFile){
        if(file_exists($nombre)){
            unlink($nombre);
        }

        move_uploaded_file($tmpFile, $nombre);
    }
}


?>
<?php

interface IFileHandler{
    public function CreateDirectory();
    public function SaveFile($value);
    public function ReadFile();
    public function ReadConfiguration();

}

?>
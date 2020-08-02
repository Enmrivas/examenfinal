<?php
    require_once '../entities/Account.php';
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../database/DatabaseContext.php';
    require_once '../services/ServiceBase.php';
    require_once '../services/PublicacionService.php';

    session_start();
    $service = new PublicacionService("../database");

    $containsId = isset($_GET['id']);

    if($containsId){
        $idPublicacion = $_GET['id'];

        $service->Delete($idPublicacion);
    }

    header("Location: ../index.php");
    exit();


?>
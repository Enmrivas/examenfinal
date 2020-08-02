<?php 
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../database/DatabaseContext.php';
    require_once '../entities/Publicacion.php';
    require_once '../services/ServiceBase.php';
    require_once '../services/PublicacionService.php';

    $service = new PublicacionService("../database");

    session_start();

    $user = json_decode($_SESSION['user']);
    $userID = $user->id;
    $date = date("Y/m/d H:i:sa");
    if(isset($_GET['id'])){

        $idPublicacion = $_GET['id'];
        $element = $service->GetById($idPublicacion);


        if(isset($_POST['titulo']) && isset($_POST['contenido'])){

            $newUpdate = new Publicacion();

            $newUpdate->initializeData($idPublicacion, $_POST['titulo'], $_POST['contenido'], $date, $userID);

            $service->Update($idPublicacion, $newUpdate);

            header("Location: ../index.php");
            exit();

        }
    }else{
        header("Location: ../index.php");
        exit();
    }
    

?>


<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <body fiprocessed="true" onload="hide();">
    <script src="js/script.js"></script>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Blog</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="login.php">Iniciar Sesion</a>
            </li>
        </ul>
    </nav>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="edit.php?id=<?php echo $element->id?>" method="POST">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Titulo</span>
                    </div>
                        <input type="text" class="form-control" aria-label="Titulo" id="titulo" name="titulo" value="<?php echo $element->titulo ?>">
                    </div>

                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contenido</span>
                    </div>
                        <textarea class="form-control" aria-label="With textarea" id="contenido" name=contenido><?php echo $element->contenido ?></textarea>
                    </div>
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>
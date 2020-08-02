<?php 
    require_once 'helpers/FileHandler/JsonFileHandler.php';
    require_once 'helpers/FileHandler/IFileHandler.php';
    require_once 'database/DatabaseContext.php';
    require_once 'entities/Account.php';
    require_once 'helpers/utilities.php';
    require_once 'entities/Publicacion.php';
    require_once 'services/ServiceBase.php';
    require_once 'services/PublicacionService.php';
    require_once 'services/AccountService.php';

    session_start();
    
    $serviceAccount = new AccountService("database");
    $servicePublicacion = new PublicacionService("database");

    $isLogged = false;

    if(isset($_SESSION['user']) && $_SESSION['user'] != null){
      $isLogged = true;
    }else{
      $isLogged = false;
    }
    
    if($isLogged){
      $user = json_decode($_SESSION['user']);

      //var_dump($user);

      $idUsuario = $user->id;
      $listAccount = $serviceAccount->GetById($idUsuario);   
      $listPublicaciones = $servicePublicacion->GetByUserId($idUsuario);
      $date = date("Y/m/d H:i:sa");
      if(isset($_POST['titulo']) && isset($_POST['contenido'])){
        $newPost = new Publicacion();

        $newPost->initializeData(0, $_POST['titulo'], $_POST['contenido'], $date, $idUsuario);

        $servicePublicacion->Add($newPost);

        header("Location: index.php");
        exit();
      }
    }else{
      header("Location: user/login.php");
      exit();
    }

    


    

?>


<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
  <body fiprocessed="true">
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php">Blog</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="user/logout.php">Salir</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li>
                
                <?php if(!empty($listAccount)): ?>


                    <img class="profilepic" src="<?php echo "user/image/cuentas/" . $listAccount->id . ".png" ?>" alt="">
                    <p>Bienvenido <?php echo $listAccount->nombre . " " . $listAccount->apellido ?></p>
                  <?php endif; ?>
            
            </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="margin-bottom: 2%;">
        <label style="margin-top: 1%;" for="basic-url">Crear nueva Publicacion</label>

        <form action="index.php" method="POST">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Titulo</span>
          </div>
          <input type="text" class="form-control" aria-label="Titulo" id="titulo" name="titulo">
        </div>

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Contenido</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" id="contenido" name=contenido></textarea>
        </div>
        <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
        </form>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Publicaciones</h1>
        </div>

            <?php if(!empty($listPublicaciones)): ?>
              <?php foreach($listPublicaciones as $posts): ?>

                <div class="card">
                  <div class="card-header">
                      <img class="profilepic-small" src="<?php echo "image/cuentas/" . $listAccount->id . ".png" ?>" alt="foto de perfil">
                      <p><?php echo $listAccount->usuario ?></p>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $posts->titulo ?></h5>
                    <p class="card-text"><?php echo $posts->contenido ?></p>
                    <p>Fecha posteado: <?php echo $posts->fecha ?></p>
                  </div>              
                    <a class="btn btn-primary" href="publicacion/edit.php?id=<?php echo $posts->id ?>">Editar</a>
                    <a class="btn btn-danger" href="publicacion/delete.php?id=<?php echo $posts->id ?>">Borrar</a>
                </div>

              <?php endforeach; ?>
              <?php endif; ?>


      
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>

</body></html>
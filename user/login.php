<?php 
    require_once '../database/DatabaseContext.php';
    require_once '../entities/Account.php';
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../services/UserService.php';

    $result = null;
    $message = "";

    session_start();

    $service = new UserService("../database");

    if(isset($_POST['usuario']) && isset($_POST['pass']))
    {
        $result = $service->Login($_POST['usuario'], $_POST['pass']);

        if($result != null)
        {
            $_SESSION['user'] = json_encode($result);
            header("Location: ../index.php");
            exit();
        }
        else
        {
            $message = "Usuario o contraseña incorrecta";
        }
    }

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../css/styles.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login</title>
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Blog</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="add.php">Registrarse</a>
    </li>
  </ul>
</nav>

<main class="login-form card" style="background: grey; padding: 5%; margin-top: 3%;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">

                    <?php if($message != ""): ?>
                    <div class="alert alert-danger" role="alet">
                        <?= $message; ?>
                    </div>
                    <?php endif; ?>
                        <form action="login.php" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6">
                                    <input type="text" id="usuario" class="form-control" name="usuario" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="pass" class="form-control" name="pass" required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a href="add.php" class="btn btn-primary">
                                    Registrarse
                                </a>
                                
                            </div>                        
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

</main>







</body>
</html>
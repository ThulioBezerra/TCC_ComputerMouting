<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="shortcut icon" href="./img/IconCPU.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/bootstrap-min.css">
    <link rel="stylesheet" href="./css/bootstrap-select-min.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap-select-min.js"></script>
    <script src="./js/bootstrap-min.js"></script>
    <script src="https://kit.fontawesome.com/53d6a77ead.js" crossorigin="anonymous"></script>
    <title>Montagem</title>
</head>

<body>
    <header class="inicio">
        <a name="inicio"></a>
        <section class="header">
            <a href="./index.php">
                <div class="logotipo">
                    <img src="./img/logosite.png" height="60px" />
                </div>
                <div class="nomesite">Monte aqui</div>
            </a>
            <nav class="navegacao">
                <a href="index.php" class="margin-r">INICIO</a>
                <a href="@">MEU OBJETIVO</a>
                <?php
                include('./Users/logoutauto.php');
                if (isset($_SESSION['usuario']) == 1) :
                    echo "<nav class='login-button'>

                <a href='./user.php'>"
                        . 'MEU PERFIL' .
                        "</a>  <i class='fa-solid fa-user'></i>
                 </nav>";

                ?>
                <?php
                endif;
                ?>
                <?php
                if (isset($_SESSION['usuario']) != 1) :
                ?>
                    <nav class="login-button"><a href="./users/login.php">LOGIN</a> <i class="fad fa-solid fa-right-to-bracket"></i></nav>
                <?php
                endif;
                ?>
            </nav>

        </section>
    </header>

<?php
require  '../vendor/autoload.php';

use App\Entity\Usuario;

session_start();

if (!empty($_POST) and (empty($_POST['usuarioc']) || empty($_POST['senhac']))) {
    header('Location: index.php');
    exit();
}
$usuario = new Usuario();
$usuario->usuario = $_POST['usuarioc'];
$usuario->senha =  $_POST['senhac'];
$result = $usuario->getUsuario();
if (is_array($result)) {
    $_SESSION['user'] = true;
    header('location: create.php');
    exit();
} else {
    $mysql = $usuario->cadastrar();
    if (is_numeric($mysql)) {
        $_SESSION['status'] = true;
        header('location: login.php');
    }
}
exit();

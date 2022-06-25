<?php
require  '../vendor/autoload.php';

use App\Entity\Usuario;

session_start();



if (!empty($_POST) and (empty($_POST['usuariol']) || empty($_POST['senhal']))) {
    header('Location: index.php');
    exit();
}
$usuario = new Usuario();
$usuario->usuario = $_POST['usuariol'];
$usuario->senha =  $_POST['senhal'];
$result = $usuario->login();
if (is_array($result)) {
    $_SESSION['usuario'] = $usuario->usuario;
    $_SESSION['ID'] = $result['id_usuario'];
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ./login.php');
    $_SESSION['error'] = true;
    exit();
}

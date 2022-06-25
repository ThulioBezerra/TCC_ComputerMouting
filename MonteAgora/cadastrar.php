<?php
session_start();
require('./vendor/autoload.php');
include('./includes/header.php');

use App\Entity\Produtos;

$obProduto = new Produtos;
switch ($_GET['name']) {
    case 'gabinete':
        include('./cadastro/cadastrog.php');
        break;
    case 'fonte':
        include('./cadastro/cadastrof.php');
        break;

    case 'placavideo':
        include('./cadastro/cadastropv.php');
        break;
    case 'ram':
        include('./cadastro/cadastromr.php');
        break;
    case 'processador':
        include('./cadastro/cadastrop.php');
        break;
    case 'placamae':
        include('./cadastro/cadastropm.php');
        break;
    case 'gabinete':
        include('./cadastro/cadastrog.php');
        break;
    case 'disco':
        include('./cadastro/cadastrodisk.php');
        break;
}
include('./includes/footer.php');

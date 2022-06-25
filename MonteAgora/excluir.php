<?php
require __DIR__ . '/vendor/autoload.php';

use App\Entity\Produtos;


//CONSULTA A VAGA
if (isset($_GET['idg'])) {
    $obProduto = Produtos::getProduto($_GET['idg'], 'gabinete');
} else if (isset($_GET['idf'])) {
    $obProduto = Produtos::getProduto($_GET['idf'], 'fonte');
} else if (isset($_GET['idp'])) {
    $obProduto = Produtos::getProduto($_GET['idp'], 'processador');
} else if (isset($_GET['idpm'])) {
    $obProduto = Produtos::getProduto($_GET['idpm'], 'placamae');
} else if (isset($_GET['idpv'])) {
    $obProduto = Produtos::getProduto($_GET['idpv'], 'placavideo');
} else if (isset($_GET['idr'])) {
    $obProduto = Produtos::getProduto($_GET['idr'], 'ram');
} else if (isset($_GET['idd'])) {
    $obProduto = Produtos::getProduto($_GET['idd'], 'disco');
}

//VALIDAÇÃO DA VAGA
if (!$obProduto instanceof Produtos) {
    header('location: listagem.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['excluir'])) {

    if (isset($_GET['idg'])) {
        $obProduto->excluir('gabinete');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idp'])) {
        $obProduto->excluir('processador');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idpm'])) {
        $obProduto->excluir('placamae');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idr'])) {
        $obProduto->excluir('ram');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idpv'])) {
        $obProduto->excluir('placavideo');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idf'])) {
        $obProduto->excluir('fonte');
        header('location: listagem.php?status=success');
        exit;
    } else if (isset($_GET['idd'])) {
        $obProduto->excluir('disco');
        header('location: listagem.php?status=success');
        exit;
    }
}

include('./includes/header.php');
include('./includes/confirmar-delete.php');
include('./includes/footer.php');

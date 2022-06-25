<?php
session_start();
include './includes/header.php';
require './vendor/autoload.php';

use App\Entity\Produtos;

?>
<main class="conteiner">
    <?php
    //Resgata o produto de acordo com o ID
    if (isset($_GET['idg'])) {
        $obProduto = Produtos::getProduto($_GET['idg'], 'gabinete');
        include './cadastro/cadastrog.php';
    } else if (isset($_GET['idf'])) {
        $obProduto = Produtos::getProduto($_GET['idf'], 'fonte');
        include './cadastro/cadastrof.php';
    } else if (isset($_GET['idp'])) {
        $obProduto = Produtos::getProduto($_GET['idp'], 'processador');
        include './cadastro/cadastrop.php';
    } else if (isset($_GET['idpm'])) {
        $obProduto = Produtos::getProduto($_GET['idpm'], 'placamae');
        include './cadastro/cadastropm.php';
    } else if (isset($_GET['idpv'])) {
        $obProduto = Produtos::getProduto($_GET['idpv'], 'placavideo');
        include './cadastro/cadastropv.php';
    } else if (isset($_GET['idr'])) {
        $obProduto = Produtos::getProduto($_GET['idr'], 'ram');
        include './cadastro/cadastromr.php';
    } else if (isset($_GET['idd'])) {
        $obProduto = Produtos::getProduto($_GET['idd'], 'disco');
        include './cadastro/cadastrodisk.php';
    }
    include('./includes/footer.php')
    ?>
</main>

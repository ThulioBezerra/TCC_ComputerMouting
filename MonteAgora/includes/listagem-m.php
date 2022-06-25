<?php

use \App\Entity\Produtos;
use \App\Db\Pagination;

if (isset($_POST['redirect'])) {
    header('Location: ./montagem.php');
}
//BUSCA
$busca = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
switch ($_GET['name']) {
    case 'gabinete':
        define('TITLE', 'Gabinetes');
        break;
    case 'fonte':
        define('TITLE', 'Fontes');
        break;
    case 'processador':
        define('TITLE', 'Processadores');
        if (isset($_SESSION['condicaopm']) || isset($_SESSION['condicaor'])) {
            include('./includes/montacondicao.php');
        }
        break;
    case 'placamae':
        define('TITLE', 'Placas Mãe');
        if (isset($_SESSION['condicaop']) || isset($_SESSION['condicaor'])) {
            include('./includes/montacondicao.php');
        }
        break;
    case 'ram':
        define('TITLE', 'Memórias Ram');
        if (isset($_SESSION['condicaop']) || isset($_SESSION['condicaopm'])) {
            include('./includes/montacondicao.php');
        }
        break;
    case 'placavideo':
        define('TITLE', 'Placas de Video');
        break;
    case 'disco':
        define('TITLE', 'Discos');
        break;
}
//CONDIÇOES SQL
if (isset($wherec) && !isset($_GET['search'])) {
    $condicoes = [
        $wherec
    ];
} else if (isset($wherec) && isset($_GET['search'])) {
    $condicoes = [
        $wherec, strlen($busca) ? 'descricao LIKE "%' . str_replace(' ', '%', $busca)  . '%"' : null
    ];
} else if (!isset($wherec)) {
    $condicoes = [strlen($busca) ? ' AND descricao LIKE "%' . str_replace(' ', '%', $busca)  . '%"' : null];
}
$where = implode(" AND ", $condicoes);


//Quantidade de produtos
$quantidade = Produtos::GetQuantidadesProdutos($where, $table);

//Paginação
$paginacao = new Pagination($quantidade, $_GET['pagina'] ?? 1, 3);
$produtos = Produtos::getProdutos($where, null, $paginacao->getLimit(), $table);

$listagem = '';
foreach ($produtos as $produto) {
    $explode = explode("|", $produto->descricao);
    switch ($_GET['name']) {
        case 'gabinete':
            $id = $produto->codgabinete;
            $info = ([0, 10, 9, 7, 8, 11]);
            $nameinfo = (['Nome', 'Baias(2.5/3.5)', 'Cooler Traseiros', 'Cooler Superiores', 'Suporte a Placas']);
            break;
        case 'fonte':
            $id = $produto->codfonte;
            $info = ([0, 4, 1, 7, 8, 5]);
            $nameinfo = (['Nome', 'Potencia', 'PFC', '80 Plus', 'Conexão a Placa']);
            break;
        case 'placamae':
            $id = $produto->codplaca;
            $info = ([0, 6, 7, 4, 8, 5]);
            $nameinfo = (['Nome', 'Memória', 'Consumo', 'Video', 'Pinos para Conexão']);
            break;
        case 'ram':
            $id = $produto->codram;
            $info = ([0, 1, 2, 4, 5, 3]);
            $nameinfo = (['Nome', 'Modelo', 'Consumo', 'Capacidade', 'Barramento']);
            break;
        case 'placavideo':
            $id = $produto->codplacavideo;
            $info = ([0, 1, 2, 3, 5, 4]);
            $nameinfo = (['Nome', 'Modelo', 'Consumo', 'VRAM', 'Barramento']);
            break;
        case 'disco':
            $id = $produto->coddisco;
            $info = ([0, 1, 4, 3, 5, 6]);
            $nameinfo = (['Nome', 'Marca/Tipo', 'Consumo', 'Capacidade', 'Barramento']);
            break;
        case 'processador':
            $id = $produto->codprocessador;
            $nameinfo = (['Nome', 'Socket', 'Consumo', 'Memória Suportada', 'Tipo de Memória']);
            $info = ([0, 3, 9, 4, 8, 6]);
            break;
    }
    $var1 = explode(':', $explode[$info[0]]);
    $var2 = explode(':', $explode[$info[1]]);
    $var3 = explode(':', $explode[$info[2]]);
    $var4 = explode(':', $explode[$info[3]]);
    $var5 = explode(':', $explode[$info[4]]);
    $var6 = explode(':', $explode[$info[5]]);
    $listagem .= "
    <button type='submit' name='" . $_GET['name'] . "' value='$id' class= 'm-list'>"
        .
        "
        <div id='info-p'>
        <strong>" . $nameinfo[0] . "</strong>: " . $var1[1] . "<br>
        <strong>" . $nameinfo[1] . "</strong>: " . $var2[1] . " / " .  $var3[1] . "<br>
        <strong>" . $nameinfo[2] . "</strong>: " . $var4[1] . "<br>
        <strong>" . $nameinfo[3] . "</strong>: " . $var5[1] .  "<br>
        <strong>" . $nameinfo[4] . "</strong>: " .  $var6[1] . "<br>
        <input type='hidden' name='redirect' value='true'></div>
        </button>
    ";
}
//Gets
unset($_GET['pagina']);
$gets = http_build_query($_GET);
$pagination = '';
$paginas = $paginacao->getPages();
foreach ($paginas as $key => $pagina) {
    $class = $pagina['atual'] ? 'btn-primary' : 'btn-secundary';
    $pagination .= "<a href='?pagina=" . $pagina['pagina'] . '&' . $gets . "' style='text-decoration: none;'> <button type='button' class='$class'>" . $pagina['pagina'] . "</button>" . "</a>";
}

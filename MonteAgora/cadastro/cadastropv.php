<?php

require  './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['nome']) && !isset($_GET['idpv'])) {
    $placavideo = new Produtos;
    $placavideo->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " .  $_POST['nome'] . "| Marca: " . $_POST['marca'] . " | Modelo: " .  $_POST['modelo'] . " | Consumo: " . $_POST['consumo'] . "W | Barramento: " . $_POST['barramento'] . "Mhz | VRAM: " . $_POST['vram'] . 'GB';
    $placavideo->descricao = $desc;
    $placavideo->consumo = $_POST['consumo'];
    $placavideo->barramento = $_POST['barramento'];
    $placavideo->cadastrar('placavideo');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idpv'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->consumo = $_POST['consumo'];
    $obProduto->barramento = $_POST['barramento'];
    $obProduto->atualizar('placavideo');
}
?>

<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="placavideo" method="POST">
            <fieldset name="Fonte" class="cadscreen">
                <h1>Placa de Video</h1>
                <label for="nome">Nome da Placa de Video: </label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idpv'])) {
                    define('BUTON', 'Editar')
                ?>
                    <label for="descricao"></label>
                    <textarea name="descricao" id="descricao" rows="5"><?= $obProduto->descricao ?> </textarea>
                <?php } else {
                    define('BUTON', 'Cadastrar') ?>
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" required>
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" required>
                <?php } ?>
                <br>
                <section class="secoescad">
                    <label for="consumo">Consumo(Watts):</label>
                    <input type="number" name="consumo" min="10" value="<?= $obProduto->consumo ?>" style="width: 60px;">
                    <label for="barramento">Barramento(MHz):</label>
                    <input type="number" name="barramento" value="<?= $obProduto->barramento ?>" style="width: 60px;">
                    <?php
                    if (!isset($_GET['idpv'])) { ?>
                        <label for="vram">VRAM(gb):</label>
                        <input type="number" name="vram" min="1" value="1" style="width: 60px;">
                    <?php } ?>
                </section>
                <button type="submit" class="botao"><?= BUTON ?></button>
            </fieldset>
        </form>
    </section>

</main>

</body>

</html>

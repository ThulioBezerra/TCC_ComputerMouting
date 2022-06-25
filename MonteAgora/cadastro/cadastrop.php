<?php

require './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['nome']) && !isset($_GET['idp'])) {
    $processador = new Produtos;
    $processador->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " . $_POST['nome'] . "| Marca: " .  $_POST['marca'] . " | Modelo: " . $_POST['modelo'] . " | Socket: " .  $_POST['socket'] . " | Consumo: " .  $_POST['consumo'] . "W | Litografia: " .  $_POST['nanometro'] .  "| Tipo de Memória: " .  $_POST['tipomem'] . "| Video Integrado: " . $_POST['video'] . "| Capacidade: " . $_POST['capacidade'] . "gb| Barramento: " . $_POST['barramento'] . "MHz";
    $processador->descricao = $desc;
    $processador->ssocket = $_POST['socket'];
    $processador->tipomem = $_POST['tipomem'];
    $processador->consumo = $_POST['consumo'];
    $processador->ramsup = $_POST['capacidade'];
    $processador->litography = $_POST['nanometro'];
    $processador->video = $_POST['video'];
    $processador->barramento = $_POST['barramento'];
    $processador->cadastrar('processador');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idp'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->ssocket = $_POST['socket'];
    $obProduto->tipomem = $_POST['tipomem'];
    $obProduto->consumo = $_POST['consumo'];
    $obProduto->ramsup = $_POST['capacidade'];
    $obProduto->litography = $_POST['nanometro'];
    $obProduto->video = $_POST['video'];
    $obProduto->barramento = $_POST['barramento'];
    $obProduto->atualizar('processador');
}
?>
<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="processador" method="POST">
            <fieldset name="processador" class="cadscreen">
                <h1>Processador</h1>
                <label for="nome">Nome do Processador:</label>
                <input type="text" name="nome" id="nome" required autofocus value="<?= $obProduto->nome ?>">
                <?php
                if (isset($_GET['idp'])) {
                    define('BUTON', 'Editar')
                ?>
                    <label for="descricao"></label>
                    <textarea name="descricao" id="descricao" rows="5"><?= $obProduto->descricao ?> </textarea>
                <?php } else { ?>
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" required>
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" required>
                <?php } ?>
                <br>

                <section class="secoescad">
                    <label>Socket</label>
                    <input type="text" name="socket" id="socket" value="<?= $obProduto->ssocket ?>">
                    <label for="consumo">Consumo(Watts):</label>
                    <input type="number" name="consumo" min="10" value="<?= $obProduto->consumo ?>" style="width: 60px;">
                    <label>Tipo de Mem:</label>
                    <select name="tipomem" id="tipomem">
                        <option value="DDR2" <?= $obProduto->tipomem == 'DDR2'  ? 'selected' : '' ?>>DDR2</option>
                        <option value="DDR3" <?= $obProduto->tipomem == 'DDR3'  ? 'selected' : '' ?>>DDR3</option>
                        <option value="DDR4" <?= $obProduto->tipomem == 'DDR4'  ? 'selected' : '' ?>>DDR4</option>
                    </select>
                    <label for="nanometro">Litografia</label>
                    <select name="nanometro" id="nanometro">
                        <option value="32nm" <?= $obProduto->litografia == '32nm'  ? 'selected' : '' ?>>32nm</option>
                        <option value="28nm" <?= $obProduto->litografia == '28nm'  ? 'selected' : '' ?>>28nm</option>
                        <option value="14nm" <?= $obProduto->litografia == '14nm'  ? 'selected' : '' ?>>14nm</option>
                        <option value="12nm" <?= $obProduto->litografia == '12nm'  ? 'selected' : '' ?>>12nm</option>
                        <option value="10nm" <?= $obProduto->litografia == '10nm'  ? 'selected' : '' ?>>10nm</option>
                        <option value="7nm" <?= $obProduto->litografia == '7nm'  ? 'selected' : '' ?>>7nm</option>
                    </select>
                    <label for=""></label>
                    <label for="video">Video Integ.</label>
                    <select name="video" id="video">
                        <option value="Sim" <?= $obProduto->video == 'Sim'  ? 'selected' : '' ?>>Sim</option>
                        <option value="Nao" <?= $obProduto->video == 'Não'  ? 'selected' : '' ?>>Não</option>
                    </select>
                </section>
                <br>
                <label for="capacidade">Ram.Sup(gb):</label>
                <input type="number" name="capacidade" min="1" value="<?= $obProduto->ramsup ?>" step="1" style="width: 60px;">
                <label for="barramento">Barramento(MHz):</label>
                <input type="number" name="barramento" min="300" value="<?= $obProduto->barramento ?>" style="width: 60px;">
                <button type="submit" class="botao"><?= BUTON ?></button>
            </fieldset>
        </form>
    </section>

</main>

</body>

</html>

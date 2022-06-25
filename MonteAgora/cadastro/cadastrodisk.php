<?php
require './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['nome']) && !isset($_GET['idd'])) {
    $disco = new Produtos;
    $disco->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " . $_POST['nome'] . " | Marca: " . $_POST['marca'] . " | Modelo: " . $_POST['modelo'] . " | Consumo: " . $_POST['consumo'] . "W | Tipo: " . $_POST['tipodisk'] . " | Capacidade: " . $_POST['capacidade'] . "Gb | Barramento: " . $_POST['barramento'] . 'MHz';
    $disco->descricao = $desc;
    $disco->tipo = $_POST['tipodisk'];
    $disco->capacidade = $_POST['capacidade'];
    $disco->consumo = $_POST['consumo'];
    $disco->barramento = $_POST['barramento'];
    $disco->cadastrar('disco');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idd'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->tipo = $_POST['tipodisk'];
    $obProduto->capacidade = $_POST['capacidade'];
    $obProduto->consumo = $_POST['consumo'];
    $obProduto->barramento = $_POST['barramento'];
    $obProduto->atualizar('disco');
}
?>
<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="disco" method="POST">
            <fieldset name="Fonte" class="cadscreen">
                <h1>Disco</h1>
                <label for="nome">Nome do Disco: </label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idd'])) {
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
                    <label for="tipodisk">Tipo de Disco:</label>
                    <select name="tipodisk" id="tipodisk">
                        <option value="ssd">SSD</option>
                        <option value="hdd" <?= $obProduto->tipo == 'hdd'  ? 'selected' : '' ?>>Hard Disk</option>
                    </select>
                    <label for="consumo">Consumo(Watts):</label>
                    <input type="number" name="consumo" value="<?= $obProduto->consumo ?>" style="width: 60px;">
                    <label for="capacidade">Cap.Disco(Gb):</label>
                    <input type="number" name="capacidade" min="1" value="<?= $obProduto->capacidade ?>" step="1" style="width: 60px;">
                    <label for="barramento">Taxa de Transferencia(MBps):</label>
                    <input type="number" name="barramento" value="<?= $obProduto->barramento ?>" style="width: 60px;">
                    <input type="hidden" name="whatis" value="disco">
                </section>
                <button type="submit" class="botao"><?= BUTON ?></button>
            </fieldset>
        </form>
    </section>
</main>

</body>

</html>

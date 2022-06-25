<?php
require './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['tipo']) && !isset($_GET['idg'])) {
    $gabinete = new Produtos;
    $gabinete->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " .  $_POST['nome'] . "| Marca: " . $_POST['marca'] . " | Modelo: " . $_POST['modelo'] . " | Altura:  " . $_POST['altura'] . "mm| Largura: " . $_POST['largura'] . "mm| Comprimento: " . $_POST['comprimento'] .  "mm| Suporte a Coolers Frontais: " . $_POST['coolersf'] . "| Suporte a Coolers Traseiros: " . $_POST['coolersb'] . "| Suporte a Coolers Superiores: " . $_POST['coolerso'] . "| Baias 3.5: " . $_POST['baias35'] . "| Baias 2.5: " . $_POST['baias25'] . "| Suporta Placas mães:  " . $_POST['placamae'] . "| Tipo de Gabinete: " .  $_POST['tipo'];
    $gabinete->descricao = $desc;
    //Mid-tower, Full, Low...
    $gabinete->tipo = $_POST['tipo'];
    $gabinete->cadastrar('gabinete');
    unset($_SESSION['cadastro']);
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idg'])) {
    $obProduto->nome =    $_POST['nome'];
    $obProduto->descricao =  $_POST['descricao'];
    $obProduto->tipogab =     $_POST['placamae'];
    $obProduto->atualizar('gabinete');
}
?>
<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="gabinete" method="POST">
            <fieldset name="Gabinete" class="cadscreen">
                <h1>Gabinete</h1>
                <label for="nome">Nome do Gabinete</label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idg'])) {
                    DEFINE('BUTAO', 'Editar');
                ?>
                    <label for="descricao"></label>
                    <textarea name="descricao" id="descricao" rows="5"><?= $obProduto->descricao ?> </textarea>
                <?php } else {
                    DEFINE('BUTAO', 'Cadastrar');
                ?>
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" required>
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" required>
                <?php } ?>
                <br>
                <?php
                if (!isset($_GET['idg'])) {
                ?>
                    <section class="secoescad">
                        <h1>Dimensões</h1>
                        <br>
                        <label for="altura">Altura</label>
                        <input type="number" name="altura" id="altura" style="width:
                        100px;">(mm)
                        <label for="largura">Largura</label>
                        <input type="number" name="largura" id="largura" style="width: 100px;">(mm)
                        <label for="comprimento">Comprimento</label>
                        <input type="number" name="comprimento" id="comprimento" style="width:
                        100px;">(mm)
                        <label for="tipo">Formato do Gabinete</label>
                        <select name="tipo" id="tipo">
                            <option value="MINI TOWER">MINI-TOWER</option>
                            <option value="MID TOWER">MID-TOWER</option>
                            <option value="FULL TOWER">FULLTOWER</option>
                            <option value="SUPER TOWER">SUPERTOWER</option>

                        </select>
                    </section>
                <?php } ?>
                <section class="secoescad">
                    <?php
                    if (!isset($_GET['idg'])) {
                    ?>
                        <label>Ventilação/Suportes</label>
                        <label for="coolers">Quant. Coolers</label>
                        front:<input type="number" name="coolersf" id="coolers" style="width: 43px;">
                        back:<input type="number" name="coolersb" id="coolers" style="width: 43px;">
                        over:<input type="number" name="coolerso" id="coolers" style="width: 43px;">
                        <label for="baias">Baias(internas)</label>
                        3.5"<input type="number" name="baias35" id="baias35" style="width: 50px;">
                        2.5"<input type="number" name="baias25" id="baias25" style="width: 50px;">
                    <?php } ?>
                    <label for="suporte">Placas Sup.</label>
                    <input type="radio" name="placamae" id="placamae" value="ATX" <?= $obProduto->tipogab == 'ATX'  ? 'checked' : '' ?>>ATX
                    <input type="radio" name="placamae" id="placamae" value="EATX" <?= $obProduto->tipogab == 'EATX'  ? 'checked' : '' ?>>EATX
                    <input type="radio" name="placamae" id="placamae" value="MICROATX" <?= $obProduto->tipogab == 'MICROATX'  ? 'checked' : '' ?>>MICROATX
                    <input type="radio" name="placamae" id="placamae" value="ITX" <?= $obProduto->tipogab == 'ITX'  ? 'checked' : '' ?>>ITX
                </section>

                <button type="submit" class="botao"><?= BUTAO ?></button>
            </fieldset>
        </form>
    </section>
</main>

</body>

</html>

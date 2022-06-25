<?php

require  './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['nome']) && !isset($_GET['idf'])) {
    $fonte = new Produtos;
    $fonte->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " . $_POST['nome'] . "| Marca: " . $_POST['marca'] . " | Modelo: " . $_POST['modelo'] . " | Tipo de Fonte: " . $_POST['tipo'] . " | Potência da Fonte: " . $_POST['potencia'] . "W | Tipo de Conexão Placa Mae: " . $_POST['conexoespm'] . "| Tipo de Conexão Placa de Video: " . $_POST['conexoespv'] . " | PFC: " . $_POST['pfc'] . " | 80 Plus: " . $_POST['80-plus'] . " | Voltagem: " . $_POST['voltagem'] . "| Conectores - EPS/ATX12V: " . $_POST['EPS/ATX12V'] . "- Molex: " . $_POST['molex'] . "- Sata: " . $_POST['sata'] . "- Conectores PCIE  " . $_POST['pcie'];
    $fonte->descricao = $desc;
    $fonte->tipo = $_POST['tipo'];
    $fonte->potencia = $_POST['potencia'];
    $fonte->conexoespm = $_POST['conexoespm'];
    $fonte->conexoespv = $_POST['conexoespv'];
    $fonte->conector12v = $_POST['conexoes12'];
    $fonte->cadastrar('fonte');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idf'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->tipo = $_POST['tipo'];
    $obProduto->potencia = $_POST['potencia'];
    $obProduto->conexoespm = $_POST['conexoespm'];
    $obProduto->conexoespv = $_POST['conexoespv'];
    $obProduto->conector12v = $_POST['conexoes12'];
    $obProduto->atualizar('fonte');
}
?>

<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="fonte" method="POST">
            <fieldset name="Fonte" class="cadscreen">
                <h1>Fonte</h1>
                <label for="nome">Nome da Fonte</label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idf'])) {
                    DEFINE('BUTON', 'Editar')
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
                    <h1 style="font-size: 2rem;">Conectores</h1>
                    <label for="conexoespm">Tipo de Conexão Placa M:</label>
                    <input type="radio" name="conexoespm" id="conexao" value="24" <?= $obProduto->conexoespm == '24' ? 'checked' : '' ?>>
                    24 pinos
                    <input type="radio" name="conexoespm" id="conexao" value="20" <?= $obProduto->conexoespm == '20' ? 'checked' : '' ?>>
                    20 pinos
                    <input type="radio" name="conexoespm" id="conexao" value="20+4" <?= $obProduto->conexoespm == '20+4' ? 'checked' : '' ?>>
                    20+4 pinos
                    <label for="conexoespm">Tipo de Conexão Placa de Video:</label>
                    <input type="radio" name="conexoespv" id="conexao" value="6+2" <?= $obProduto->conexoespv == '6+2' ? 'checked' : '' ?>>
                    6+2 pinos
                    <input type="radio" name="conexoespv" id="conexao" value="8" <?= $obProduto->conexoespv == '8' ? 'checked' : '' ?>>
                    8 pinos
                    <input type="radio" name="conexoespv" id="conexao" value="6" <?= $obProduto->conexoespv == '6' ? 'checked' : '' ?>>
                    6 pinos
                    <label for="conexoes12">Tipo de Eps12V/Atx12V:</label>
                    <input type="radio" name="conexoes12" id="conexao" value="4" <?= $obProduto->conector12v == '4' ? 'checked' : '' ?>>
                    4 pinos
                    <input type="radio" name="conexoes12" id="conexao" value="4+4" <?= $obProduto->conector12v == '4+4' ? 'checked' : '' ?>>
                    4+4 pinos
                    <input type="radio" name="conexoes12" id="conexao" value="8" <?= $obProduto->conector12v == '8' ? 'checked' : '' ?>>
                    8 pinos
                    <?php
                    if (!isset($_GET['idf'])) {
                    ?>
                        <label for="EPS/ATX12V">EPS/ATX12V</label>
                        <input type="number" name="EPS/ATX12V" id="EPS/ATX12V" style="width:
                        50px;" value="">
                        <label for="4pinos">Conector Molex</label>
                        <input type="number" name="molex" id="molex" style="width:
                        50px;">
                        <label for="sata">SATA</label>
                        <input type="number" name="sata" id="sata" style="width:
                        50px;">
                        <label for="pcie">PCI-EXPRESS</label>
                        <input type="number" name="pcie" id="pcie" style="width:
                        50px;">
                    <?php } ?>
                </section>
                <section class="secoescad">
                    <label for="tipo">Tipo de Fonte:</label>
                    <select name="tipo" id="tipo">
                        <option value="microatx" <?= $obProduto->tipo == 'microatx'  ? 'selected' : '' ?>>MicroATX</option>
                        <option value="atx" <?= $obProduto->tipo == 'atx'  ? 'selected' : '' ?>>ATX</option>
                        <option value="eatx" <?= $obProduto->tipo == 'eatx'  ? 'selected' : '' ?>>EATX</option>
                        <option value="miniitx" <?= $obProduto->tipo == 'miniitx'  ? 'selected' : '' ?>>MINIITX</option>
                    </select>
                    <br>
                    <label for="potencia">Potência(Watts):</label>
                    <input type="number" name="potencia" id="potencia" min="100" value="<?= $obProduto->potencia ?>" style="width: 60px;">
                    <?php
                    if (!isset($_GET['idf'])) {
                    ?>
                        <label for="voltagem">Voltagem Entrada: </label>
                        <select name="voltagem" id="voltagem">
                            <option value="110v">110v</option>
                            <option value="220v">220v</option>
                            <option value="100v~220v">110-220v</option>
                        </select>
                        <br>

                        <br>
                        <label for="pfc">PFC</label>
                        <input type="radio" name="pfc" value="Ativo" id="pfc" checked>Ativo
                        <input type="radio" name="pfc" value="Inativo" id="pfc">Inativo
                        <label for="80plus">80-plus</label>
                        <input type="radio" name="80-plus" id="80-plus" value="None" checked>none
                        <input type="radio" name="80-plus" id="80-plus" value="Standard" checked>Padrão
                        <input type="radio" name="80-plus" id="80-plus" value="Bronze">Bronze
                        <input type="radio" name="80-plus" id="80-plus" value="Silver">Prata
                        <input type="radio" name="80-plus" id="80-plus" value="Gold">Ouro
                    <?php
                    }
                    ?>
                </section>
                <button type="submit" class="botao"><?= BUTON ?></button>
            </fieldset>
        </form>
    </section>

</main>

</body>

</html>

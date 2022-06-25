<?php

require  './vendor/autoload.php';

use App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['nome']) && !isset($_GET['idr'])) {
    $memoriaram = new Produtos;
    $memoriaram->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " .  $_POST['nome'] . " | Marca: " .  $_POST['marca'] . " | Modelo: " . $_POST['modelo'] . " | Tipo:" . $_POST['tipomem'] . " - " . $barramento = $_POST['barramento'] . "MHz | Consumo: " . $_POST['consumo'] . "W | Capacidade: " . $_POST['capacidade'] . "Gb";
    $memoriaram->descricao = $desc;
    $memoriaram->tipo = $_POST['tipomem'];
    $memoriaram->capacidade = $_POST['capacidade'];
    $memoriaram->consumo = $_POST['consumo'];
    $memoriaram->barramento = $_POST['barramento'];
    $memoriaram->cadastrar('ram');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idr'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->tipo = $_POST['tipomem'];
    $obProduto->capacidade = $_POST['capacidade'];
    $obProduto->consumo = $_POST['consumo'];
    $obProduto->barramento = $_POST['barramento'];
    $obProduto->atualizar('ram');
}
?>

<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="memoriaram" method="POST">
            <fieldset name="Fonte" class="cadscreen">
                <h1>Memória Ram</h1>
                <label for="nome">Nome da RAM: </label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idr'])) {
                    DEFINE('BUTON', 'Editar');
                ?>
                    <label for="descricao"></label>
                    <textarea name="descricao" id="descricao" rows="5"><?= $obProduto->descricao ?> </textarea>
                <?php } else {
                    DEFINE('BUTON', 'Cadastrar') ?>
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" required>
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" required>
                <?php } ?>
                <br>
                <?php
                if (!isset($_GET['idr'])) {

                ?>
                    <label for="tipomem">Tipo de Mem:</label>
                    <select name="tipomem" id="tipomem"></select>
                    <script>
                        $(document).ready(function() {
                            $('select').selectpicker();
                            carrega_dados('tipomem');

                            function carrega_dados(tipo, ddr = '') {
                                $.ajax({
                                    url: "./cadastro/code.php",
                                    method: "POST",
                                    data: {
                                        tipo: tipo,
                                        ddr: ddr
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        for (var count = 0; count < data.length; count++) {
                                            html += "<option value='" + data[count].nome + "'" + ">" + data[count].nome + '</option>';
                                        }
                                        if (tipo == 'tipomem') {
                                            $('#tipomem').html(html);
                                            $('#tipomem').selectpicker('refresh');
                                        } else {
                                            $('#barramento').html(html);
                                            $('#barramento').selectpicker('refresh');
                                        }
                                    }
                                })
                            }
                            $(document).on('change', '#tipomem', function() {
                                var ddr = $('#tipomem').val();
                                carrega_dados('barramento', ddr);
                            });
                        });
                    </script>
                    <label for="barramento">Barramento(FSB)</label>
                    <select name="barramento" id="barramento"></select>
                <?php } else { ?>
                    <label for="tipomem">Tipo de Mem:</label>
                    <select name="tipomem" id="tipomem">
                        <option value="DDR" <?= $obProduto->tipo == 'DDR'  ? 'selected' : '' ?>>DDR</option>
                        <option value="DDR2" <?= $obProduto->tipo == 'DDR2'  ? 'selected' : '' ?>>DDR2</option>
                        <option value="DDR3" <?= $obProduto->tipo == 'DDR3'  ? 'selected' : '' ?>>DDR3</option>
                        <option value="DDR4" <?= $obProduto->tipo == 'DDR4'  ? 'selected' : '' ?>>DDR4</option>
                    </select>
                    <label for="barramento">Barramento(FSB)</label>
                    <input type="number" name="barramento" value="<?= $obProduto->barramento ?>">

                <?php } ?>
                <label for="consumo">Consumo(Watts):</label>
                <input type="number" name="consumo" min="2" value="<?= $obProduto->consumo ?>" style="width: 60px;">
                <label for="capacidade">Cap.Ram(Gb):</label>
                <input type="number" name="capacidade" min="1" value="<?= $obProduto->capacidade ?>" step="1" style="width: 60px;">
                <input type="hidden" name="whatis" value="memoriaram">
    </section>
    <button type="submit" class="botao"><?= BUTON ?></button>
    </fieldset>
    </form>
    </section>

</main>

</body>

</html>

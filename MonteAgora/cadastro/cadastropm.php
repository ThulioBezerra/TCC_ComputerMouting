<?php

require './vendor/autoload.php';

use \App\Entity\Produtos;

if (isset($_POST['saida'])) {
    unset($_SESSION['cadastro']);
    header('Location: ./formulario.php');
}
if (isset($_POST['nome']) && !isset($_GET['idpm'])) {
    $placamae = new Produtos;
    $placamae->nome = $_POST['nome'];
    //Montagem da descrição a ser formatada
    $desc = "Nome: " .  $_POST['nome'] . "| Marca: " .  $_POST['marca'] . " | Modelo " .  $_POST['modelo'] . " | Formato da Placa: " . $_POST['tipo'] . " | Consumo da Placa: " . $_POST['consumo'] . "W | Tipo de Conexão Placa Mae: " . $_POST['conexoes'] . "| Tipo Memória Suportada: " .  $_POST['tipomem'] . '-' . $_POST['barramento'] . " | Capacidade para RAM: " . $_POST['capacidade'] . "gb | Video Integrado: " . $_POST['video'] . " | Slots RAM: " . $_POST['slotsram'] . "| Qt. PCIe: " . $_POST['pci'] . " | Qt. SATA " . $_POST['sata'];
    $placamae->descricao = $desc;
    $placamae->ssocket = $_POST['socket'];
    $placamae->tipo = $_POST['tipo'];
    $placamae->tipomem = $_POST['tipomem'];
    $placamae->barramento = $_POST['barramento'];
    $placamae->slotsram = $_POST['slotsram'];
    $placamae->ramsup = $_POST['capacidade'];
    $placamae->consumo = $_POST['consumo'];
    $placamae->conectores = $_POST['conexoes'];
    $placamae->qtpci = $_POST['pci'];
    $placamae->qtsata = $_POST['sata'];
    $placamae->video = $_POST['video'];
    $placamae->cadastrar('placamae');
    exit;
} else if (isset($_POST['nome']) && isset($_GET['idpm'])) {
    $obProduto->nome = $_POST['nome'];
    $obProduto->descricao = $_POST['descricao'];
    $obProduto->ssocket = $_POST['socket'];
    $obProduto->tipo = $_POST['tipo'];
    $obProduto->tipomem = $_POST['tipomem'];
    $obProduto->barramento = $_POST['barramento'];
    $obProduto->slotsram = $_POST['slotsram'];
    $obProduto->ramsup = $_POST['capacidade'];
    $obProduto->consumo = $_POST['consumo'];
    $obProduto->conectores = $_POST['conexoes'];
    $obProduto->qtpci = $_POST['pci'];
    $obProduto->qtsata = $_POST['sata'];
    $obProduto->video = $_POST['video'];
    $obProduto->atualizar('placamae');
}
?>
<main class="conteiner">
    <section id="helptext">
        <a id="saida" href="./listagem.php">X</a>
        <form name="placamae" method="POST">
            <fieldset name="placa-mae" class="cadscreen">
                <h1>Placa Mãe</h1>
                <label for="nome">Nome da Placa Mãe</label>
                <input type="text" name="nome" id="nome" value="<?= $obProduto->nome ?>" required autofocus>
                <?php
                if (isset($_GET['idpm'])) {
                    DEFINE('BUTON', 'Editar');
                ?>
                    <label for="descricao"></label>
                    <textarea name="descricao" id="descricao" rows="5"><?= $obProduto->descricao ?> </textarea>
                <?php } else {
                    DEFINE('BUTON', 'Cadastrar'); ?>
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" required>
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" required>
                <?php } ?>
                <br>
                <section class="secoescad">
                    <label>Socket:</label>
                    <input type="text" name="socket" id="socket" value="<?= $obProduto->ssocket ?>">
                    <?php
                    if (!isset($_GET['idpm'])) {

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
                            <option value="DDR" <?= $obProduto->tipomem == 'DDR'  ? 'selected' : '' ?>>DDR</option>
                            <option value="DDR2" <?= $obProduto->tipomem == 'DDR2'  ? 'selected' : '' ?>>DDR2</option>
                            <option value="DDR3" <?= $obProduto->tipomem == 'DDR3'  ? 'selected' : '' ?>>DDR3</option>
                            <option value="DDR4" <?= $obProduto->tipomem == 'DDR4'  ? 'selected' : '' ?>>DDR4</option>
                        </select>
                        <label for="barramento">Barramento(FSB)</label>
                        <input type="number" name="barramento" value="<?= $obProduto->barramento ?>">

                    <?php } ?>
                    <label for="tipo">Tipo da Placa:</label>
                    <select name="tipo" id="tipo">
                        <option value="MICROATX" <?= $obProduto->tipo == 'MICROATX'  ? 'selected' : '' ?>>MicroATX</option>
                        <option value="ATX" <?= $obProduto->tipo == 'ATX'  ? 'selected' : '' ?>>ATX</option>
                        <option value="EATX" <?= $obProduto->tipo == 'EATX'  ? 'selected' : '' ?>>EATX</option>
                        <option value="ITX" <?= $obProduto->tipo == 'ITX'  ? 'selected' : '' ?>>ITX</option>
                    </select>
                    <label for="consumo">Consumo(Watts):</label>
                    <input type="number" name="consumo" min="10" value="<?= $obProduto->consumo ?>" step="5" style="width: 60px;">
                    <label for="video">Video intg</label>
                    <select name="video" id="video">
                        <option value="Sim" <?= $obProduto->video == 'Sim'  ? 'selected' : '' ?>>Sim</option>
                        <option value="Nao" <?= $obProduto->video == 'Nao'  ? 'selected' : '' ?>>Não</option>
                    </select>
                </section>
                <section class="secoescad">
                    <?php
                    if (!isset($_GET['idpm'])) {
                    ?>
                        <label for="pci">Qt. PciE</label>
                        <input type="number" name="pci" min="0" value="0" style="width: 60px;">
                    <?php
                    }
                    ?>
                    <label for="pci">Qt. PciEx16</label>
                    <input type="number" name="pci" min="0" value="<?= $obProduto->qtpci ?>" style="width: 60px;">
                    <label for="qtsata">Qt.Sata</label>
                    <input type="number" name="sata" value="<?= $obProduto->qtsata ?>" step="1" min="1" style="width: 40px;">
                    <br>
                    <label for="slotsram">Slots de Ram</label>
                    <input type="number" name="slotsram" min="2" value="<?= $obProduto->slotsram ?>" style="width: 60px;">
                    <label for="capacidade">Cap. Ram Suportada(Gb):</label>
                    <input type="number" name="capacidade" min="1" value="<?= $obProduto->ramsup ?>" step="1" style="width: 60px;">
                    <label for="conexoes">Tipo de Conexao:</label>
                    <input type="radio" name="conexoes" id="conexao" value="24" <?= $obProduto->conectores == "24" ? 'checked' : '' ?>>
                    24 pinos
                    <input type="radio" name="conexoes" id="conexao" value="20" <?= $obProduto->conectores == "20" ? 'checked' : '' ?>>
                    20 pinos
                    <input type="radio" name="conexoes" id="conexao" value="20+4" <?= $obProduto->conectores == "20+4" ? 'checked' : '' ?>>
                    20+4 pinos
                </section>
                <br>
                <button type="submit" class="botao"><?= BUTON ?></button>
            </fieldset>
        </form>
    </section>
</main>

</body>

</html>

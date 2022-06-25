<?php
session_start();
include('./includes/header.php');
require('./vendor/autoload.php');

use App\Entity\Produtos;

?>

<main class="conteiner">
    <?php
    $resultados = '';
    if (empty($_GET['name'])) {
        //Formulário para escolhar o produto
        echo " <form method='GET' id= 'form-cad' >
            <button type='submit' value='gabinete' name='name' class='navcad'>Cad. Gab</button>
            <button type='submit' value='fonte' name='name' class='navcad'>Cad. Fonte</button>
            <button type='submit' value='placamae' name='name' class='navcad'>Cad. Placa-mãe</button>
            <button type='submit' value='processador' name='name' class='navcad'>Cad. processador</button>
            <button type='submit' value='ram' name='name' class='navcad'>Cad. Memória Ram</button>
            <button type='submit' value='placavideo' name='name' class='navcad'>Cad. Placa de Video</button>
            <button type='submit' value='disco' name='name' class='navcad'>Cad. Disco</button>
        </form>";
    } else if ($_GET['name'] == 'gabinete') {
        $produtos = Produtos::GetProdutos(null, null, null, 'gabinete');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codgabinete . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idg=' . $produto->codgabinete . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idg=' . $produto->codgabinete . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'fonte') {
        $produtos = Produtos::GetProdutos(null, null, null, 'fonte');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codfonte . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idf=' . $produto->codfonte . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idf=' . $produto->codfonte . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'placamae') {
        $produtos = Produtos::GetProdutos(null, null, null, 'placamae');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codplaca . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idpm=' . $produto->codplaca . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idpm=' . $produto->codplaca . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'processador') {
        $produtos = Produtos::GetProdutos(null, null, null, 'processador');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codprocessador . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idp=' . $produto->codprocessador . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idp=' . $produto->codprocessador . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'ram') {
        $produtos = Produtos::GetProdutos(null, null, null, 'ram');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codram . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idr=' . $produto->codram . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idr=' . $produto->codram . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'disco') {
        $produtos = Produtos::GetProdutos(null, null, null, 'disco');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->coddisco . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idd=' . $produto->coddisco . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idd=' . $produto->coddisco . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    } else if ($_GET['name']  == 'placavideo') {
        $produtos = Produtos::GetProdutos(null, null, null, 'placavideo');
        foreach ($produtos as $produto) {
            $resultados .= '<tr>
                              <td>' . $produto->codplacavideo . '</td>
                              <td>' . $produto->nome . '</td>
                              <td>' . $produto->descricao . '</td>
                              <td>
                                <a href="./editar.php?idpv=' . $produto->codplacavideo . '">
                                  <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="./excluir.php?idpv=' . $produto->codplacavideo . '">
                                  <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                              </td>
                            </tr>';
        }
    }
    if (isset($_GET['name'])) {
    ?>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>

        <a class="btn btn-success" href="./cadastrar.php?name=<?= $_GET['name'] ?>">Nova Peça</a>
    <?php } ?>
</main>
</body>

</html>

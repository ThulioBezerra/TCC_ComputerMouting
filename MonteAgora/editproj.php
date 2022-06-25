<?php
session_start();
require __DIR__ . './vendor/autoload.php';

use App\Entity\Projetos;
use App\Entity\Produtos;

$produto = new Produtos;
if ($_SESSION['usuario'] == 0) {
    header('location: ./users/login.php');
}
if (isset($_GET['name']) && $_GET['name'] == 'finally') {
    $projeto = new Projetos;
    $projeto->nome = $_SESSION['projeto'];
    $projeto->codgabinete = isset($_SESSION['gabinetee']) ? $_SESSION['gabinetee'] : null;
    $projeto->codfonte = isset($_SESSION['fontee']) ? $_SESSION['fontee'] : null;
    $projeto->codplacamae = isset($_SESSION['placamaee']) ? $_SESSION['placamaee'] : null;
    $projeto->codplacavideo = isset($_SESSION['placavideoe']) ? $_SESSION['placavideoe'] : null;
    $projeto->coddisco = isset($_SESSION['discoe']) ? $_SESSION['discoe'] : null;
    $projeto->codprocessador = isset($_SESSION['processadore']) ? $_SESSION['processadore'] : null;
    $projeto->codram = isset($_SESSION['rame']) ? $_SESSION['rame'] : null;
    $projeto->id_usuario = $_SESSION['ID'];
    $projeto->atualizar();
    header('Location: ./user.php?status=sucess');
} else if (isset($_GET['codproj'])) {
    $projeto = Projetos::getProjeto($_GET['codproj']);
    $_SESSION['projeto'] == $projeto->nome;
}
if (isset($_POST['gabinete'])) {
    $_SESSION['gabinete'] = $_POST['gabinete'];
    $_SESSION['sucess'] = 'true';
}
//
else if (isset($_POST['fonte'])) {
    $_SESSION['fonte'] = $_POST['fonte'];
    $fonte = $produto->getProduto($_POST['fonte'], 'fonte');
    $_SESSION['fontpot'] = $fonte->potencia;
    $_SESSION['potenciaalert'] = number_format($fonte->potencia / 1.4, 2, '.', '');
    $_SESSION['sucess'] = 'true';
    if (isset($_SESSION['projpotencia'])) {
        if ($_SESSION['fontpot'] < $_SESSION['projpotencia']) {
            $error = "<div> Erro: Fonte não contém potencia suficiente. </div>";
            unset($_SESSION['fonte']);
            unset($_SESSION['fontpot']);
            unset($_SESSION['sucess']);
            unset($_SESSION['potenciaalert']);
            $_SESSION['error'] =  'errorfonte';
        }
    }
}
//
else if (isset($_POST['processador'])) {
    $processador = $produto->getProduto($_POST['processador'], 'processador');
    if (isset($_SESSION['processador'])) {
        $processadorx = $produto->getProduto($_SESSION['processador'], 'processador');
        $_SESSION['projpotencia'] -= $processadorx->consumo;
    }
    $_SESSION['projpotencia'] += $processador->consumo;
    $_SESSION['condicaop'] = [
        "tipomem" => $processador->tipomem,
        "barramento" => $processador->barramento,
        "socket" => $processador->ssocket,
        "ramsup" => $processador->ramsup
    ];
    if (isset($_SESSION['fontpot'])) {
        if ($_SESSION['projpotencia'] <= $_SESSION['fontpot']) {
            $_SESSION['processador'] = $_POST['processador'];
            $_SESSION['sucess'] = 'true';
            $_SESSION['ddr'] = $processador->tipomem;
        } else {
            echo "<div class='error'> A fonte cadastrada não suporta as peças cadastradas. </div>";
            $_SESSION['projpotencia'] -= $processador->consumo;
        }
    } else {
        $_SESSION['processador'] = $_POST['processador'];
        $_SESSION['sucess'] = 'true';
    }
}

//
else if (isset($_POST['placavideo'])) {
    $placavideo = $produto->getProduto($_POST['placavideo'], 'placavideo');
    if (isset($_SESSION['placavideo'])) {
        $placavideox = $produto->getProduto($_SESSION['placavideo'], 'placavideo');
        $_SESSION['projpotencia'] -= $placavideox->consumo;
    }
    $_SESSION['projpotencia'] += $placavideo->consumo;
    if (isset($_SESSION['fontpot'])) {
        if ($_SESSION['projpotencia'] <= $_SESSION['fontpot']) {
            $_SESSION['placavideo'] = $_POST['placavideo'];
            $_SESSION['sucess'] = 'true';
        } else {
            echo "<div class='error'> A fonte cadastrada não suporta as peças cadastradas. </div>";
            $_SESSION['projpotencia'] -= $placavideo->consumo;
        }
    } else {
        $_SESSION['placavideo'] = $_POST['placavideo'];
        $_SESSION['sucess'] = 'true';
    }
}
//
else if (isset($_POST['placamae'])) {
    $placamae = $produto->getProduto($_POST['placamae'], 'placamae');
    if (isset($_SESSION['placamae'])) {
        $placamaex = $produto->getProduto($_SESSION['placamae'], 'placamae');
        $_SESSION['projpotencia'] -= $placamaex->consumo;
    }
    $_SESSION['projpotencia'] += $placamae->consumo;
    $_SESSION['condicaopm'] = [
        "tipomem" => $placamae->tipomem,
        "barramento" => $placamae->barramento,
        "socket" => $placamae->ssocket,
        "ramsup" => $placamae->ramsup
    ];
    if (isset($_SESSION['fontpot'])) {
        if ($_SESSION['projpotencia'] <= $_SESSION['fontpot']) {
            $_SESSION['placamae'] = $_POST['placamae'];
            $_SESSION['sucess'] = 'true';
        } else {
            echo "<div class='error'> A fonte cadastrada não suporta as peças cadastradas. </div>";
            $_SESSION['projpotencia'] -= $placamae->consumo;
        }
    } else {
        $_SESSION['placamae'] = $_POST['placamae'];
        $_SESSION['sucess'] = 'true';
    }
}
//
else if (isset($_POST['disco'])) {
    $disco = $produto->getProduto($_POST['disco'], 'disco');
    if (isset($_SESSION['disco'])) {
        $discox = $produto->getProduto($_SESSION['disco'], 'disco');
        $_SESSION['projpotencia'] -= $discox->consumo;
    }
    $_SESSION['projpotencia'] += $disco->consumo;
    if (isset($_SESSION['fontpot'])) {
        if ($_SESSION['projpotencia'] <= $_SESSION['fontpot']) {
            $_SESSION['disco'] = $_POST['disco'];
            $_SESSION['sucess'] = 'true';
        } else {
            echo "<div class='error'> A fonte cadastrada não suporta as peças cadastradas. </div>";
            $_SESSION['projpotencia'] -= $disco->consumo;
        }
    } else {
        $_SESSION['disco'] = $_POST['disco'];
        $_SESSION['sucess'] = 'true';
    }
}
//
else if (isset($_POST['ram'])) {
    $ram = $produto->getProduto($_POST['ram'], 'ram');
    if (isset($_SESSION['ram'])) {
        $ramx = $produto->getProduto($_SESSION['ram'], 'ram');
        $_SESSION['projpotencia'] -= $ramx->consumo;
    }
    $_SESSION['projpotencia'] += $ram->consumo;
    $_SESSION['condicaor'] = [
        "tipo" => $ram->tipo,
        "barramento" => $ram->barramento,
        "capacidade" => $ram->capacidade,
    ];
    if (isset($_SESSION['fontpot'])) {
        if ($_SESSION['projpotencia'] <= $_SESSION['fontpot']) {
            $_SESSION['ram'] = $_POST['ram'];
            $_SESSION['sucess'] = 'true';
        } else {
            echo "<div class='error'> A fonte cadastrada não suporta as peças cadastradas. </div>";
            $_SESSION['projpotencia'] -= $ram->consumo;
        }
    } else {
        $_SESSION['ram'] = $_POST['ram'];
        $_SESSION['sucess'] = 'true';
    }
}
//
else if (isset($_POST['nomeprojeto'])) {
    $_SESSION['projeto'] = $_POST['nomeprojeto'];
}
//

if (isset($_GET['excluir'])) {
    $delete = new Produtos;
    switch ($_GET['excluir']) {
        case 'gabinete':
            unset($_SESSION['gabinete']);
            break;
        case 'fonte':
            unset($_SESSION['fonte']);
            break;
        case 'placamae':
            $produto = $delete->getProduto($_SESSION['placamae'], 'placamae');
            $_SESSION['projpotencia'] -= $produto->consumo;
            unset($_SESSION['placamae']);
            unset($_SESSION['condicaopm']);
            break;
        case 'processador':
            $produto = $delete->getProduto($_SESSION['processador'], 'processador');
            $_SESSION['projpotencia'] -= $produto->consumo;
            unset($_SESSION['processador']);
            unset($_SESSION['condicaop']);
            break;
        case 'placavideo':
            $produto = $delete->getProduto($_SESSION['placavideo'], 'placavideo');
            $_SESSION['projpotencia'] -= $produto->consumo;
            unset($_SESSION['placavideo']);
            break;
        case 'disco':
            $produto = $delete->getProduto($_SESSION['disco'], 'disco');
            $_SESSION['projpotencia'] -= $produto->consumo;
            unset($_SESSION['disco']);
            break;
        case 'ram':
            $produto = $delete->getProduto($_SESSION['ram'], 'ram');
            $_SESSION['projpotencia'] -= $produto->consumo;
            unset($_SESSION['ram']);
            unset($_SESSION['condicaor']);
            break;
    }
    header('Location: ./montagem.php');
}
//
if (!isset($_GET['name'])) {
    if (isset($_SESSION['projeto'])) {
        define('TITLE', $_SESSION['projeto']);
    } else {
        define('TITLE', isset($_SESSION['projeto']) ? $_SESSION['projeto'] : 'Novo Projeto');
    }
} else if (isset($_GET['name']) && isset($_SESSION['projeto'])) {

    switch ($_GET['name']) {
        case 'gabinete':
            $table = 'gabinete';
            break;
        case 'fonte':
            $table = 'fonte';
            break;
        case 'placamae':
            $table = 'placamae';
            break;
        case 'ram':
            $table = 'ram';
            break;
        case 'placavideo':
            $table = 'placavideo';
            break;
        case 'disco':
            $table = 'disco';
            break;
        case 'processador':
            $table = 'processador';
            break;
    }
}
?>
<?php include('./includes/header.php');
if (isset($_SESSION['sucess'])) {
    echo "<div id='sucess'> Produto cadastrado com sucesso! </div>";
}
if (isset($_SESSION['error'])) {
    "<div class='error'> eita </div>";
}
if (isset($_SESSION['fontpot']) && isset($_SESSION['projpotencia'])) {
    if ($_SESSION['projpotencia'] >= $_SESSION['potenciaalert']) {
        echo "<div id='alert'> Cuidado, você está chegando no limite de sua fonte. </div>";
    }
}
if (isset($table)) {
    include './includes/listagem-m.php';
} ?>

<main>
    <h3 id="center"><?= TITLE ?> <?php if (isset($_SESSION['projeto']) && !isset($_GET['name'])) : ?><form method="GET" style="display: inline;"><button name="name" style="background-color: transparent; border: none;" value="editproj">&#9998;</button></form>
        <?php endif; ?>
    </h3>
    <?php
    if (isset($_GET['name'])) :
    ?>
        <form id="pesquisar" method="GET" class="searcharea">

            <input type="search" name="search" id="search" placeholder="Pesquise" size="25" value="<?= $busca ?>">
            <input type="hidden" value="<?= $_GET['name'] ?>" name="name">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

        </form>
        <hr>
        <form method="POST" class="montagem">
            <?= $listagem ?>
            <div class="paginacao"><?= $pagination ?> </div>
        </form>
    <?php endif;
    if (!isset($_GET['name']) && isset($_SESSION['projeto'])) {
        include './includes/form-main.php';
        unset($_SESSION['sucess']);
    } else if (!isset($_GET['name']) && !isset($_SESSION['projeto'])) {
        echo "
            <form method='POST' id='projetname'>
            <label> Insira o nome do seu projeto</label>
            <input name='nomeprojeto' type='text' size=50' >
            </form>
        ";
    }
    ?>
</main>
</body>
<script type="text/javascript">
    setTimeout(function() {
        $('#sucess').fadeOut('slow');
    }, 3000);
</script>

</html>

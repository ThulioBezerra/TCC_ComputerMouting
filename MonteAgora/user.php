<?php
session_start();
include('./includes/header.php');
require './vendor/autoload.php';
if (!isset($_SESSION['usuario'])) {
    header('location:./users/login.php');
    exit();
}

use App\Db\Database;
use App\Entity\Usuario;
use \App\Db\Pagination;
use App\Entity\Projetos;
use App\Entity\Produtos;
?>
<main id='bg'>
    <div id="perfil">
        <form name='usuario' id="usuario-info" method="GET">

            <img src="./img/login.png">
            <?php echo "<div id='center-w' >" . $_SESSION['usuario'] . '</div>' ?>
            <button type='submit' class="button-user" name="tab" value="user">Minha Conta</button>
            <button type='submit' class="button-user" name="" value="">Meus Projetos</button>
            <?php
            $select = new Database('usuario');
            $where = "usuario='" . $_SESSION['usuario'] . "' AND id_usuario=" . "1";
            $tipouser = $select->select($where);
            if ($row = $tipouser->fetch(PDO::FETCH_ASSOC)) {
                echo "<a href='./listagem.php' class='button-user'>Gerenciar peças</a>";
            }
            ?>
            <a href="./users/logout.php" class="button-user" id="color-red">Sair</a>
        </form>
        <?php
        if (isset($_GET['tab']) && $_GET['tab'] == 'user') {
        ?>
            <form id="info_usuario" method="GET">
                <?php
                if (isset($_SESSION['error']) && $_SESSION['error'] == false) {
                    echo '<div> Senha atualizada! </div>';
                    unset($_SESSION['error']);
                }
                ?>
                <button type="submit" name='form' value="password">Editar Senha</button>
                <button type="submit" name='form' value="delet">Excluir Conta</button>
            </form>
        <?php
        } else if (isset($_GET['form']) && $_GET['form'] == 'password') { ?>
            <section class="info_usuarioedit">
                <form class="edit-user" method="POST">
                    <?php
                    if (isset($_SESSION['error']) && $_SESSION['error'] == true) {
                        echo '<span> Senha incorreta! </span>';
                        unset($_SESSION['error']);
                    } ?>
                    <label for="">Senha Atual</label>
                    <input type="text" name='atual' required>
                    <label for="">Nova Senha</label>
                    <input type="text" name="nova" required>
                    <button type="submit">Editar</button>
                </form>
            </section>
        <?php if (isset($_POST['atual']) && isset($_POST['nova'])) {
                $usuario = new Usuario;
                $usuario->usuario = $_SESSION['usuario'];
                $usuario->senha = $_POST['atual'];
                $teste = $usuario->login();
                if (is_array($teste)) {
                    $usuario->id_usuario = $_SESSION['ID'];
                    $usuario->senha = $_POST['nova'];
                    $usuario->atualizarpass();
                    $_SESSION['error'] = false;
                    header("location:./user.php?tab=user");
                } else {
                    $_SESSION['error'] = true;
                }
            }
        } else if (isset($_GET['form']) && $_GET['form'] == 'delet') {
            echo "  <section class='info_usuarioedit'><form method='POST' class='edit-user'>
                    Tem certeza?
                    <button type='submit' name='confirmacao' value='s'>Excluir Conta</button>
                    <button type='submit' name='confirmacao' value='n'>Voltar</button>
                  </form> </section>";

            if (isset($_POST['confirmacao']) && $_POST['confirmacao'] == 's') {
                $usuarioe = new Usuario;
                $usuarioe->id_usuario = $_SESSION['ID'];
                $usuarioe->excluir();
                session_destroy();
                header('Location: index.php');
            }
        } else if (!isset($_GET['tab']) && !isset($_GET['form'])) {
            $where = "id_usuario= " . $_SESSION['ID'];
            $quantidade = Projetos::GetQuantidadesProjetos($where);
            $paginacao = new Pagination($quantidade, $_GET['pagina'] ?? 1, 3);
            $projetos = Projetos::getProjetos($where, null, $paginacao->getLimit());
            print_r($projetos);
            if (!empty($projetos)) {
                $listagem = '';
                $produto = new Produtos;
                foreach ($projetos as $projeto) {
                    $produtog = Produtos::getProduto($projeto->codgabinete_gabinete, 'gabinete');
                    $produtof = Produtos::getProduto($projeto->codfonte_fonte, 'fonte');
                    $produtop = Produtos::getProduto($projeto->codprocessador_processador, 'processador');
                    $produtopm = Produtos::getProduto($projeto->codplacamae_placamae, 'placamae');
                    $produtor = Produtos::getProduto($projeto->codram_ram, 'ram');
                    $produtopv = Produtos::getProduto($projeto->codplacavideo_placavideo, 'placavideo');
                    $produtod = Produtos::getProduto($projeto->coddisco_disco, 'disco');
                    $listagem .= "
        <div class='list_projetos'>"
                        . "Gabinete: "      . $produtog->nome . "<br>"
                        . "Fonte: "       . $produtof->nome . "<br>"
                        . "processador: "       . $produtop->nome . "<br>"
                        . "Placa de video: "       . $produtopv->nome . "<br>"
                        . "Placa mãe: "        . $produtopm->nome . "<br>"
                        . "Ram: "      . $produtor->nome . "<br>"
                        . "Disco: "        . $produtod->nome .

                        "</div>";
                }
                $pagination = '';
                $paginas = $paginacao->getPages();
                foreach ($paginas as $key => $pagina) {
                    $class = $pagina['atual'] ? 'btn-primary' : 'btn-secundary';
                    $pagination .= "<a href='?pagina=" . $pagina['pagina'] . "' style='text-decoration: none;'> <button type='button' class='$class'>" . $pagina['pagina'] . "</button>" . "</a>";
                }
                echo "<section id='projetos'> <div id='list'> <h1 id='topico'>Meus Projetos</h1>" .
                    $listagem .
                    "</div>" .
                    $pagination .
                    "</section>";
            } else {
                echo "  <section class='info_usuarioedit'><h1 id= 'topico'> Sem projetos existentes </h1></section>";
            }
        }
        ?>
    </div>
</main>
<?php include './includes/footer.php' ?>
</body>

</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../img/IconCPU.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/normalize.css">

</head>

<body class="logcre">
    <main>
        <div class="logon">

            <h1 class="nomeinicio">Login</h1>
            <?php
            if (isset($_SESSION['status'])) :
            ?>

                <p id="success">Conta criada com sucesso!</p>

            <?php
            endif;
            unset($_SESSION['status']);
            ?>
            <form class="formlog" action="loginp.php" method="POST">
                <fieldset class="loginbord">
                    <div>
                        <label for="usuariol"><strong>Usuario</strong></label>
                        <?php
                        if (isset($_SESSION['error'])) :
                        ?>
                            <p class="error"><small>Usuário/Senha incorretos!</small></p>
                        <?php
                        endif;
                        unset($_SESSION['error']);
                        ?>
                        <input type="text" name="usuariol" id="usuario" placeholder="Seu usuário" required autofocus size="25">
                    </div>
                    <div>
                        <label for="senhal"><strong>Senha</strong></label>
                        <input type="password" name="senhal" id="senha" placeholder="Sua senha" required maxlength="15" size="25">
                    </div>
                    <button type="submit" class="botao">Logar</button>
                    <p>Não tem uma conta? <a href="./create.php" target="_self" rel="prev">Clique aqui!</a></p>
                </fieldset>
            </form>
        </div>
    </main>
</body>

</html>

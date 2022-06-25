<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/normalize.css">
</head>

<body class="logcre">

    <main>
        <div class="logon">
            <h1 class="nomeinicio">Criar conta</h1>
            <form class="formlog" action="createp.php" method="POST" name="login">
                <fieldset class="loginbord">
                    <div style="display: block;">
                        <label for="usuarioc"><strong>Usuário</strong></label>
                        <?php
                        if (isset($_SESSION['user'])) :
                        ?>
                            <p class="error">Já existem usuários com este nome</p>
                        <?php
                        endif;
                        unset($_SESSION['user']);
                        ?>
                        <input type="text" name="usuarioc" id="usuario" placeholder="Nome do usuário" required autofocus size="25">
                    </div>
                    <div>
                        <label for="senhac"><strong>Senha</strong></label>
                        <small>(Conter máx. 15 dígitos)</small>
                        <input type="password" name="senhac" id="Criar Senha" placeholder="Senha" required maxlength="15" size="25">
                    </div>
                    <button type="submit" class="botao">Criar</button>
                    <p>Já tem uma conta? <a href="./login.php" target="_self" rel="next">Clique aqui!</a></p>
                </fieldset>
            </form>
        </div>
    </main>
</body>

</html>

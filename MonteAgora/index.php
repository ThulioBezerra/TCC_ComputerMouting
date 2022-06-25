<?php
session_start();
include('./Users/logoutauto.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/IconCPU.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <script src="https://kit.fontawesome.com/53d6a77ead.js" crossorigin="anonymous"></script>
    <title>TCC</title>
</head>

<body>
    <div class="conteiner">
        <header>
            <!---modificado-->
            <section class="header">
                <a href="./index.php">
                    <div class="logotipo">
                        <img src="./img/logosite.png" />
                    </div>
                    <div class="nomesite">Monte aqui</div>
                </a>
                <nav class="navegacao">
                    <a href="index.php" class="margin-r">INICIO</a>
                    <a href="#howtouse">COMO FUNCIONA</a>
                    <?php
                    if (isset($_SESSION['usuario']) == 1) :
                        echo "<nav class='login-button'>

                             <a href='./user.php'>"
                            . 'MEU PERFIL ' .
                            "</a><i class='fa-solid fa-user'></i>" .
                            "
                             </nav>";
                    ?>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (isset($_SESSION['usuario']) != 1) :
                    ?>

                        <nav class="login-button">
                            <a href="./Users/login.php">LOGIN</a>
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </nav>
                    <?php
                    endif;
                    ?>
                </nav>



        </header>
        <?php
        if (isset($_GET['status']) == 'sucess') {
        ?>
            <div id="sucess">Projeto finalizado com sucesso.</div>
        <?php unset($_SESSION['gabinete'], $_SESSION['fonte'], $_SESSION['projeto'], $_SESSION['placamae'], $_SESSION['ram'], $_SESSION['disco'], $_SESSION['placavideo'], $_SESSION['processador']);
        } ?>
        </section>
        <div id="centro">
            <button class="button-primary"><a href="./artigo.php">MEU OBJETIVO</a> </button>
            <button class="button-primary"><a href="./montagem.php">MONTE AGORA</a></button>
        </div>
    </div>
    <main>
        <section id="main-index">
            <h1 id="topico">OLÁ, BEM VINDO AO MONTEAGORA</h1>
            <hr style="width: 8rem;border-color: var(--cb);">
            <hr style="width: 3rem;border-color: var(--cb);">
            <hr style="width: 1rem;border-color: var(--cb);">
            <div id="htw-nav">
                <div class="htw-img">
                    <picture>
                        <source media="(max-width: 600px)" srcset="./img/processador-pq.jpg" sizes="img/png">
                        <img src="./img/processador-200.jpg" alt="processador">
                    </picture>
                    <button class="htw-button"><a href="./montagem.php">MONTE AGORA</a> </button>
                </div>
                <div class="htw-img">
                    <picture>
                        <source media="(max-width: 600px)" srcset="./img/videos-pq.jpg" sizes="img/png">
                        <img src="./img/videos-200.jpg" alt="video">
                    </picture>
                    <button class="htw-button"> <a href="./videos.php">VIDEOS</a></button>
                </div>
                <div class="htw-img">
                    <picture>
                        <source media="(max-width: 600px)" srcset="./img/help-pq.jpg" sizes="img/png">
                        <img src="./img/help-200.jpg" alt="help">
                    </picture>

                    <button class="htw-button"><a href="./help.php">AJUDE-ME</a>
                </div>
            </div>
        </section>

        <section id="central">
            <div id='howtouse'>
                <article class="htw-text">
                    <header>
                        <h1>MONTAGEM</h1>
                        <hr style="width: 8rem; border-color: var(--cb);">
                        <hr style="width: 3rem; border-color: var(--cb);">
                        <hr style="width: 1rem; margin-bottom: 4rem;border-color: black;">
                    </header>
                    <p>A ferramenta principal deste site é a montagem dinâmica e precisa fornecida pelo aplicativo. As peças cadastradas têm informações retiradas de fontes confiáveis e, a partir delas, promovemos ao consumidor final a experiência de uma montagem 100% segura e de acordo com seu estilo!</p>
                </article>
                <article class=" htw-text">
                    <header>
                        <h1>VÍDEOS</h1>
                        <hr style="width: 8rem; border-color: var(--cb); ">
                        <hr style="width: 3rem; border-color: var(--cb);">
                        <hr style="width: 1rem; border-color: var(--cb); margin-bottom: 4rem;">
                    </header>
                    <p>A seção de vídeos contém conteúdos oriundos do da plataforma de canais YouTube. Os vídeos tem por finalidade a educação acadêmica e profissional para aqueles que necessitam de suporte técnico para montagem e manejo das peças. Nenhum vídeo é de autoria do criador do site, que mantém a legitimidade dos direitos autorais e monetização direta ao autor.</p>
                </article>
                <article class="htw-text">
                    <header>
                        <h1>AJUDA</h1>
                        <hr style="width: 8rem; border-color: var(--cb);">
                        <hr style="width: 3rem; border-color: var(--cb);">
                        <hr style="width: 1rem; border-color: var(--cb); margin-bottom: 4rem;">
                    </header>
                    <p>A seção ajuda contém informações básicas sobre como proceder ao uso deste aplicativo web. Lá se encontram diversos parágrafos com o intuito de ensinar a usar coretamente o App. </p>
                </article>
            </div>
            <br><br>
            <br>
        </section>
    </main>
    <?php include './includes/footer.php' ?>
</body>
<script src="./js/script.js"></script>

</html>

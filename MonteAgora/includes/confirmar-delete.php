<main>

    <h2 class="mt-3">Excluir Produto</h2>

    <form method="post">

        <div class="form-group">
            <p>Você deseja realmente excluir a vaga <strong><?= $obProduto->nome ?></strong>?</p>
        </div>

        <div class="form-group">
            <a href="listagem.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>

            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>

    </form>

</main>

<form method='GET' id='form-main'>
    <table class='table bg-light mt-3' id='montagem-list'>
        <thead>
            <tr>
                <th>
                    Peças
                </th>
                <th>
                    Ações
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    Gabinete (<?= isset($_SESSION['gabinete']) ? 1 : 0 ?>/1)
                </td>
                <?php if (isset($_SESSION['gabinete'])) { ?>
                    <td>
                        <button type="submit" name='name' value="gabinete" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="gabinete" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="gabinete" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>
            </tr>
            <tr>
                <td>
                    Fonte (<?= isset($_SESSION['fonte']) ? 1 : 0 ?>/1)
                </td>
                <?php if (isset($_SESSION['fonte'])) { ?>
                    <td>
                        <button type="submit" name='name' value="fonte" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="fonte" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="fonte" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>
            </tr>
            <tr>
                <td>
                    Placa Mãe (<?= isset($_SESSION['placamae']) ? 1 : 0 ?>/1)
                </td>
                <?php if (isset($_SESSION['placamae'])) { ?>
                    <td>
                        <button type="submit" name='name' value="placamae" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="placamae" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="placamae" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>
            </tr>
            <tr>
                <td>
                    Processador (<?= isset($_SESSION['processador']) ? 1 : 0 ?>/1)
                </td>
                <?php if (isset($_SESSION['processador'])) { ?>
                    <td>
                        <button type="submit" name='name' value="processador" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="processador" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="processador" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>

            </tr>
            <tr>
                <td>Memória Ram (<?= isset($_SESSION['ram']) ? 1 : 0 ?>/1)</td>
                <?php if (isset($_SESSION['ram'])) { ?>
                    <td>
                        <button type="submit" name='name' value="ram" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="ram" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="ram" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>

            </tr>
            <tr>
                <td>Placa de Vídeo (<?= isset($_SESSION['placavideo']) ? 1 : 0 ?>/1)</td>
                <?php if (isset($_SESSION['placavideo'])) { ?>
                    <td>
                        <button type="submit" name='name' value="placavideo" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' type="submit" name="excluir" value="placavideo" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="placavideo" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>

            </tr>
            <tr>
                <td>Disco (<?= isset($_SESSION['disco']) ? 1 : 0 ?>/1)</td>
                <?php if (isset($_SESSION['disco'])) { ?>
                    <td>
                        <button type="submit" name='name' value="disco" class="btn btn-success" id='edit'>Editar</button>
                        <button type='submit' name="excluir" value="disco" class="btn btn-primary">Excluir</button>
                    </td>
                <?php
                } else { ?>
                    <td><button type="submit" name='name' value="disco" class="btn btn-success">Adicionar</button></td>
                <?php  } ?>
            </tr>
        </tbody>
    </table>
    <?php
    if (isset($_SESSION['gabinete']) && isset($_SESSION['fonte']) && isset($_SESSION['placamae']) && isset($_SESSION['placavideo']) && isset($_SESSION['processador']) && isset($_SESSION['disco']) && isset($_SESSION['ram'])) {
        $change = "class= 'finish'";
    } else {
        $change = "id= 'finish'";
    }
    ?>
    <button name='name' value="finally" <?= $change ?>> Finalizar </button>
</form>

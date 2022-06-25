<?php
require('../vendor/autoload.php');

use \App\Db\Database;

if (isset($_POST["tipo"])) {
    if ($_POST['tipo'] == "tipomem") {
        $database = new Database('ddr');
        $sql = $database->select();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $saida[] = array(
                'id' => $row["id"],
                'nome' => $row["tipo"]
            );
        }
        echo json_encode($saida);
    } else {
        $database = new Database('barramentos');
        $ddr = $_POST['ddr'];
        $sql = $database->select("ddr='$ddr'");
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $saida[] = array(
                'nome' => $row["barramento"]
            );
        }
        echo json_encode($saida);
    }
}

<?php
$wherec = '';
if ($_GET['name'] == 'processador') {
    if (isset($_SESSION['condicaopm'])) {
        $wherec = "tipomem = '" .  $_SESSION['condicaopm']['tipomem'] . "' AND " .  "barramento <= " .  $_SESSION['condicaopm']['barramento'] . " AND " . "ssocket = '" .  $_SESSION['condicaopm']['socket'] . "'";
    }
    if (isset($_SESSION['condicaor'])) {
        if (!empty($wherec)) {
            $wherec .= " AND " . "ramsup >=" .  $_SESSION['condicaor']['capacidade'];
        } else {
            $wherec = "tipomem = '" .  $_SESSION['condicaor']['tipo'] . "' AND barramento <= " .  $_SESSION['condicaor']['barramento'] . " AND ramsup >= " .  $_SESSION['condicaor']['capacidade'];
        }
    }
} else if ($_GET['name'] == 'placamae') {
    if (isset($_SESSION['condicaop'])) {
        $wherec .= "tipomem = '" .  $_SESSION['condicaop']['tipomem'] . "' AND barramento >= " .  $_SESSION['condicaop']['barramento'] . " AND ssocket = '" .  $_SESSION['condicaop']['socket'] . "' AND ramsup >= " .  $_SESSION['condicaop']['ramsup'];
    }
    if (isset($_SESSION['condicaor'])) {
        if (!empty($wherec)) {
            $wherec .= " AND " . "ramsup >=" .  $_SESSION['condicaor']['capacidade'];
        } else {
            $wherec = "tipomem = '" .  $_SESSION['condicaor']['tipo'] . "' AND barramento >= " .  $_SESSION['condicaor']['barramento'] .  " AND ramsup >= " .  $_SESSION['condicaor']['capacidade'];
        }
    }
} else if ($_GET['name'] == 'ram') {
    if (isset($_SESSION['condicaop'])) {
        $wherec .= "tipo = '" .  $_SESSION['condicaop']['tipomem'] . "' AND barramento <= " .  $_SESSION['condicaop']['barramento'] . " AND capacidade <= " .  $_SESSION['condicaop']['ramsup'];
    }
    if (isset($_SESSION['condicaopm'])) {
        if (!empty($wherec)) {
        } else {
            $wherec = "tipo = '" .  $_SESSION['condicaopm']['tipomem'] . "' AND barramento <= " .  $_SESSION['condicaopm']['barramento'] .  " AND capacidade <= " .  $_SESSION['condicaopm']['ramsup'];
        }
    }
}
echo $wherec;

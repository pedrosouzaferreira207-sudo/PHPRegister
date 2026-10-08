<?php
session_start();

if (isset($_SESSION['erros'])) {
    foreach ($_SESSION['erros'] as $erro) {
        echo "<p style='color:red;'>$erro</p>";
    }
    unset($_SESSION['erros']);
}

if (isset($_SESSION['sucesso'])) {
    echo "<p style='color:green;'>".$_SESSION['sucesso']."</p>";
    unset($_SESSION['sucesso']);
}
?>
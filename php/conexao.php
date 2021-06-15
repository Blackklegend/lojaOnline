<?php 
    $server = "localhost";
    $user = "root";
    $password = "";
    $banco = "lojaonline";

    $conexao = mysqli_connect($server, $user, $password);
    if ($conexao) {
        $database = mysqli_select_db($conexao, $banco);
        if(!$database) {
            echo "Banco MySQL não existe.<br>";
        }
    } else {
        echo "Não conectou.<br>";
    }
?>
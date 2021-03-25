<?php

// if (dirname($_SERVER["PHP_SELF"]) == DIRECTORY_SEPARATOR) {
//     $root = "";
// } else {
//     $root = dirname($_SERVER["PHP_SELF"]);
// }

//$local = "localhost";
$local = "108.179.193.39:3306"; //"localhost";
$login = "cstmac48_user";
$senha = "6OF@ntia+eiy";
$database = "cstmac48_vendania";

$mysqli = new mysqli($local, $login, $senha, $database);
$mysqli->set_charset("utf8");

// Verifica se ocorreu algum erro
if (mysqli_connect_errno()) {
    die('Não foi possível conectar-se ao banco de dados: ' . mysqli_connect_error());
    exit();
}

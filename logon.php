<?php
@session_start();
include "config.php";

function anti_injection($sql){
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$sql);
	$sql = trim($sql);
	$sql = strip_tags($sql);
	//$sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
	return $sql;
}

$login = $mysqli->real_escape_string(anti_injection($_POST['login'])); 
$senha = $mysqli->real_escape_string(anti_injection($_POST['senha']));

$sqlLogon = $mysqli->query("SELECT usu_cd_usuario, usu_ds_email, usu_ds_login, usu_ds_senha FROM usuario WHERE (usu_ds_login = '$login' OR usu_ds_email = '$login') AND usu_ds_senha = '$senha'");
$existecadastro = $sqlLogon->num_rows;

if (empty($existecadastro)) {

    echo "<script>alert('E-mail ou Senha estão errados.')</script>";
	echo "<meta http-equiv='refresh' content='0;url=home'>"; // redireciona a index	
	
}else{
$logon = $sqlLogon->fetch_assoc();	
	
        // $_SESSION['login']  = $login;	
		// $_SESSION['senha']  = $senha;
		$_SESSION['usu_cd_usuario']  = $logon['usu_cd_usuario'];

echo "<meta http-equiv='refresh' content='0;url=./conta/perfil'>";     

}

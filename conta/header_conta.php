<?php
if (empty($_SESSION['usu_cd_usuario'])) {

	echo 'Vai pra tela de login, rapaz';
	echo "<meta http-equiv='refresh' content='0;url=home'>";
	exit;
}
?>

<?php
$sqlUsuario = $mysqli->query("SELECT * FROM usuario WHERE usu_cd_usuario = {$_SESSION['usu_cd_usuario']}");
$usuario = $sqlUsuario->fetch_assoc();

$sqlEmpresa = $mysqli->query("SELECT * FROM empresa WHERE emp_cd_usuario = {$_SESSION['usu_cd_usuario']}");
$empresa = $sqlEmpresa->fetch_assoc();

?>

<div class="pt-2">
	<div class="container ">
		<div class="row align-items-center">
			<div class="col-xl-12 col-lg-12 col-md-12 col-12">
				<!-- Bg -->
				<div class="rounded-top" style="
								background: url(assets/img/profile-bg.jpg) no-repeat;
								background-size: cover;
                                padding-top: 7.5rem!important;
							"></div>
				<div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-bottom shadow-sm">
					<div class="d-flex align-items-center">
						<div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
							<img src="assets/img/foto_perfil/<?php echo $usuario['usu_ds_fotoperfil'] ?>" class="avatar-xl rounded-circle border-width-4 border-white" alt="" />
						</div>
						<div class="lh-1">
							<h3 class="mb-0">
								<?php echo $usuario['usu_nm_nome'] ?>
							</h3>
							<p class="mb-0 d-block"><?php echo $usuario['usu_ds_email'] ?></p>
						</div>
					</div>
					<div>
						<a href="home" class="btn btn-outline-primary btn-sm d-none d-md-block">Página inicial</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

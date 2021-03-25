<?php include "header_conta.php" ?>

<div class="pt-4">
	<div class="container">
		<div class="row">

			<?php include "menu_perfil.php" ?>

			<div class="col-lg-9 col-md-8 col-12">
				<!-- Card -->
				<div class="card border-0 bg-white sombra-1">
					<!-- Card header -->
					<div class="card-header bg-white d-lg-flex justify-content-between align-items-center">
						<div class="mb-3 mb-lg-0">
							<h4 class="mb-0">Meu Perfil</h4>
							<p class="mb-0">
								Dados do usuário.
							</p>
						</div>
						<div>
							<?php
							$dt_criacao = date_create($usuario['usu_dt_criacao']);
							?>
							<a href="" class="btn btn-success btn-sm">Você está na Vendania desde <?php echo date_format($dt_criacao, 'd/m/Y') ?></a>
						</div>
					</div>
					<!-- Card body -->
					<div class="card-body">
						<div class=" pt-0 pb-5">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									<img src="assets/img/foto_perfil/<?php echo $usuario['usu_ds_fotoperfil'] ?>" id="img_perfil" class="avatar-xl rounded-circle" alt="" />
									<div class="ms-3">
										<h4 class="mb-0">Foto do Perfil</h4>
									</div>
								</div>
							</div>
							<hr class="my-4" />
							<div>
								<h4 class="mb-3">Seus dados</h4>
								<!-- Form -->
								<div class="row g-1">
									<!-- Login -->
									<div class="col-12 col-md-6">
										<span class="mb-0">Login: </span>
										<span>
											<span class="text-success"><?php echo $usuario['usu_ds_login'] ?></span>
										</span>
									</div>
									<!-- Email -->
									<div class="col-12 col-md-6">
										<span class="mb-0">Email: </span>
										<span>
											<span class="text-success"><?php echo $usuario['usu_ds_email'] ?></span>
										</span>
									</div>
									<!-- Nome -->
									<div class="col-12 col-md-6">
										<span class="mb-0">Nome Completo: </span>
										<span>
											<span class="text-success"><?php echo $usuario['usu_nm_nome'] ?></span>
										</span>
									</div>
									<!-- Dt atualização -->
									<?php
									$dt_atualizacao = date_create($usuario['usu_dt_atualizacao']);
									?>
									<div class="col-12 col-md-6">
										<span class="mb-0">Ultima atualização: </span>
										<span>
											<span class="text-success"><?php echo date_format($dt_atualizacao, 'd/m/Y') ?></span>
										</span>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
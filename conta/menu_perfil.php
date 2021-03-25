<div class="col-lg-3 col-md-4 col-12">
    <!-- Side navbar -->
    <nav class="navbar navbar-expand-md navbar-light sombra-1 mb-4 rounded p-3 bg-white">
        <!-- Menu -->
        <a class="d-xl-none d-lg-none d-md-none " href="/conta/perfil">Menu</a>
        <!-- Button -->
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuPerfil" aria-controls="navbarMenuPerfil" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse navbar -->
        <div class="collapse navbar-collapse" id="navbarMenuPerfil">
            <div class="navbar-nav flex-column">
                <span class="p-1 mb-1"><?php echo $usuario['usu_nm_nome'] ?></span>
                <ul class="list-unstyled mb-4">
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'perfil'? 'active': '';?>" href="conta/perfil"><i class="bi bi-person-fill me-2"></i>Perfil</a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'time_line'? 'active': '';?>" href="conta/time_line"><i class="bi bi-bookmark-check-fill me-2"></i>
                            Linha do tempo
                        </a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'produtos_recomendados'? 'active': '';?>" href="conta/produtos_recomendados"><i class="bi bi-gift-fill me-2"></i>Produtos recomendados</a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'notificacoes'? 'active': '';?>" href="conta/notificacoes"><i class="bi bi-bell-fill me-2"></i>Notificações</a>
                    </li>
                </ul>

                <!-- Navbar header -->
                <span class="p-1 mb-1">Empresa</span>
                <ul class="list-unstyled mb-4">
                   <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'atualizar_empresa'? 'active': '';?>" href="conta/atualizar_empresa"><i class="bi bi-card-list me-2"></i>Atualizar dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'listar_produtos'? 'active': '';?>" href="conta/listar_produtos"><i class="bi bi-bag-fill me-2"></i>Listar Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $rota[1] == 'cadastrar_produto'? 'active': '';?>" href="conta/cadastrar_produto"><i class="bi bi-bag-plus-fill me-2"></i>Cadastrar Produto</a>
                    </li>
                </ul>

                <!-- Navbar header -->
                <span class="p-1 mb-1">Configurações</span>
                <ul class="list-unstyled mb-4">
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="bi bi-person-bounding-box me-2"></i>Editar Perfil</a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="bi bi-bookmark-heart me-2"></i>Editar Interesses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="bi bi-lock me-2"></i>Alterar Senha</a>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="sair"><i class="bi bi-power me-2"></i>Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
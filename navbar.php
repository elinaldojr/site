<!-- Modal Login-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="h3 mb-3 fw-normal">Digite seus dados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body form-signin">
        <form action="logon.php" method="post">
          <label for="inputEmail" class="visually-hidden">E-mail </label>
          <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Usuário ou e-mail" required autofocus>
          <label for="inputPassword" class="visually-hidden">Senha</label>
          <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Lembrar de mim
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
        </form>
      </div>
      <div class="modal-footer">
        <span>Ainda não tem cadastro? <a href="login.html">Clique aqui!</a></span>
      </div>

    </div>
  </div>
</div>


<!-- Modal CEP-->
<div class="modal fade" id="selecionarCEP" tabindex="-1" aria-labelledby="selecionarCEPLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selecionarCEPLabel">Escolha sua localização</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Insira um CEP do Brasil.</span>
        <form method="post" class="row row-cols-lg-auto g-3 align-items-center">
          <div class="col-12">
            <input name="cep_parte1" type="number" class="form-control" style="width: 6em;" placeholder="00000">
          </div>
          <div class="col-12">
            <span>-</span>
          </div>
          <div class="col-12">
            <input name="cep_parte2" type="number" class="form-control" style="width: 4em;" placeholder="000">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Confirmar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand me-1  d-sm-block" href="home">
        <img src="assets/img/logo-mini.png" class="" alt="Logo Vendania">
        <img src="assets/img/vendania-mini.png" class="d-none d-sm-inline-block" alt="Vendania">
      </a>
      <!-- <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      <!-- <div class="collapse navbar-collapse" id="navbarTogglerDemo02"> -->
      <?php
      // if (isset($_POST['cep_parte1']) && isset($_POST['cep_parte2'])) {
      //   $cep = ($_POST['cep_parte1'] != '') ? htmlspecialchars($_POST['cep_parte1']) : '00000';
      //   $cep .= ($_POST['cep_parte2'] != '') ? htmlspecialchars($_POST['cep_parte2']) : '000';

      //   function get_endereco($cep)
      //   {
      //     // formatar o cep removendo caracteres nao numericos
      //     $cep = preg_replace("/[^0-9]/", "", $cep);
      //     $url = "http://viacep.com.br/ws/$cep/xml/";

      //     $xml = simplexml_load_file($url);
      //     return $xml;
      //   }

      //   $endereco = get_endereco($cep);
      ?>

      <!-- <div class="d-flex flex-row align-items-center text-white">
            <div class="col-auto me-1">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div class="col-auto ">
              <small class="d-block fw-bold"><?php echo $endereco->localidade . "-" . $endereco->uf; ?></small>
            </div>
          </div>

        <?php //} else { 
        ?>
          <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#selecionarCEP">
            <div class="d-flex flex-row align-items-center text-white">
              <div class="col-auto me-1">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="col-auto ">
                <small class="d-block fw-light fst-italic text-start">Olá</small>
                <small class="d-block fw-bold">Selecione o endereço</small>
              </div>
            </div>
          </button> -->
      <?php //} 
      ?>


      <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home">Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Categorias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cidades</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Dicas</a>
            </li>
          </ul> -->

      <div class="d-block text-white w-50 mx-0 mx-sm-1 ">

        <div class="input-group has-validation">
          <select class="form-select input-group-text px-2 d-none d-md-block" name="cidade" required>
            <option value="">Cidade...</option>
          </select>

          <select class="form-select input-group-text px-4 d-none d-md-block" name="categoria" required>
            <option value="">Categoria...</option>

            <?php
            $sqlCategoria = $mysqli->query("SELECT * FROM categoria ORDER BY cat_nm_categoria ASC;");
            while ($categoria = $sqlCategoria->fetch_assoc()) {
            ?>
              <option value="<?php echo $categoria['cat_cd_categoria'] ?>"><?php echo $categoria['cat_nm_categoria'] ?></option>
            <?php } ?>

          </select>

          <input type="text" class="form-control w-50" placeholder="O que procura?" required>
          <button type="button" class="btn btn-primary">
            <i class="bi bi-search"></i>
          </button>
          <div class="invalid-feedback">
            Your username is required.
          </div>
        </div>
      </div>

      <?php if (!isset($_SESSION['usu_cd_usuario'])) { ?>

        <div class="d-flex">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Fazer login
          </button>
        </div>

      <?php } else { ?>
        <?php
        $sqlUsuario = $mysqli->query("SELECT * FROM usuario WHERE usu_cd_usuario = '" . $_SESSION['usu_cd_usuario'] . "'");
        $usuario = $sqlUsuario->fetch_assoc();
        ?>

        <div class="dropdown ">
          <button class="btn dropdown-toggle p-0 text-light" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="avatar avatar-md avatar-indicators avatar-online">
              <img alt="avatar" src="assets/img/foto_perfil/<?php echo $usuario['usu_ds_fotoperfil']; ?>" class="rounded-circle">
            </div>
          </button>

          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end p-2" aria-labelledby="dropdownUserProfile">
            <li>
              <div class="d-flex">
                <div class="avatar avatar-md avatar-indicators avatar-online mx-1">
                  <img alt="avatar" src="assets/img/foto_perfil/<?php echo $usuario['usu_ds_fotoperfil']; ?>" class="rounded-circle">
                </div>

                <div class="ml-3 lh-1 mx-1 text-light">
                  <h6 class="mb-1"><?php echo $usuario['usu_nm_nome']; ?></h6>
                  <p class="mb-0 text-muted"><?php echo $usuario['usu_ds_email']; ?></p>
                </div>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li><a class="dropdown-item <?php echo $rota[1] == 'perfil' ? 'active' : ''; ?>" href="./conta/perfil"><i class="bi bi-person-fill"></i> Perfil</a></li>
            <li><a class="dropdown-item <?php echo $rota[1] == 'listar_produtos' || $rota[1] == 'cadastrar_produto' ? 'active' : ''; ?>" href="./conta/listar_produtos"><i class="bi bi-handbag-fill"></i> Produtos</a></li>
            <li><a class="dropdown-item" href="configuracoes"><i class="bi bi-gear-fill"></i> Configurações</a></li>
            <li><a class="dropdown-item" href="ajuda"><i class="bi bi-question-circle-fill"></i></i> Ajuda</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="sair"><i class="bi bi-power"></i> Sair</a></li>
          </ul>
        </div>

      <?php } ?>

      <!-- </div> -->

    </div>
  </nav>


</header>
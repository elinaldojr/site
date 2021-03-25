<main>

  <section class="text-center container">
    <div class="row pt-3">
      <div class="col-lg-6 col-md-6 mx-auto pt-5 my-lg-5">
        <h1 class="fw-light">Fácil e Rápido</h1>
        <p class="lead text-muted">Encontre 80% do que você mais precisa, em apenas 20% do tempo.
        </p>
        <p>
          <a href="#" class="btn btn-primary my-2">Encontrar empresas</a>
          <a href="cadastro" class="btn btn-secondary my-2">Quero promover minha empresa</a>
        </p>
      </div>
      <div class="col-lg-6 col-md-6"><img src="assets/img/garoto-propaganda.png" alt="" class="img-fluid"></div>
    </div>

    <div class="d-flex flex-wrap justify-content-center mt-1">
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary ">#restaurante</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#academia</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#distribuidora</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#mercado</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#hortifruti</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#hotel</a>
      </div>
      <div class="p-2 bg-white border border-1 rounded mx-1 mb-1">
        <a href="" class="text-decoration-none text-secondary">#muitomais</a>
      </div>
    </div>
  </section>


  <div class="bg-white py-4 shadow-lg mt-1">
    <div class="container">
      <div class="row align-items-center no-gutters">
        <!-- Features -->
        <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
          <div class="d-flex align-items-center">
            <div class="icon bg-primary rounded-circle text-center fs-3 text-white me-3" style="width: 3rem; height: 3rem;">
              <i class="bi bi-building"></i>
            </div>
            <div class="ml-3">

              <?php
              $sqlQtdEmpresa = $mysqli->query("SELECT count(emp_cd_empresa) AS qtd_empresas FROM empresa");
              $qtdEmpresa = $sqlQtdEmpresa->fetch_assoc()
              ?>

              <h4 class="mb-0 font-weight-semi-bold"><?php echo $qtdEmpresa['qtd_empresas'] ?>+ Empresas</h4>
              <p class="mb-0">Novas empresas todos os dias</p>
            </div>
          </div>
        </div>
        <!-- Features -->
        <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
          <div class="d-flex align-items-center">
            <div class="icon bg-primary rounded-circle text-center fs-3 text-white me-3" style="width: 3rem; height: 3rem;">
              <i class="bi bi-calendar2-check"></i>
            </div>
            <div class="ml-3">

              <?php
              $sqlQtdCategoria = $mysqli->query("SELECT count(cat_cd_categoria) AS qtd_categorias FROM categoria");
              $qtdCategoria = $sqlQtdCategoria->fetch_assoc()
              ?>

              <h4 class="mb-0 font-weight-semi-bold"><?php echo $qtdCategoria['qtd_categorias'] ?>+ Categorias</h4>
              <p class="mb-0">Encontre o que você precisa</p>
            </div>
          </div>
        </div>
        <!-- Features -->
        <div class="col-xl-4 col-lg-4 col-md-12">
          <div class="d-flex align-items-center">
            <div class="icon bg-primary rounded-circle text-center fs-3 text-white me-3" style="width: 3rem; height: 3rem;">
              <i class="bi bi-person-plus"></i>
            </div>
            <div class="ml-3">

              <?php
              $sqlQtdUsuario = $mysqli->query("SELECT count(usu_cd_usuario) AS qtd_usuarios FROM usuario");
              $qtdUsuario = $sqlQtdUsuario->fetch_assoc()
              ?>

              <h4 class="mb-0 font-weight-semi-bold"><?php echo $qtdUsuario['qtd_usuarios'] ?>+ Usuários</h4>
              <p class="mb-0">A Vendania continua crescendo</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="py-2 bg-light">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
        <h4>Recomendadas</h4>
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary ">Ver todas</button>
        </div>
      </div>


      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        <?php
        $sqlEmpresa = $mysqli->query("SELECT * FROM empresa INNER JOIN categoria ON emp_cd_categoria = cat_cd_categoria ORDER BY emp_nm_nome DESC LIMIT 4;");

        while ($empresa = $sqlEmpresa->fetch_assoc()) {
        ?>
          <div class="col ">
            <div class="card shadow h-100">
              <a href="empresa/<?php echo $empresa['emp_cd_empresa']; ?>" class="card-img-top">
                <img class="card-img-top " style="" aria-label="Placeholder: Thumbnail" alt="imagem" src="assets/img/empresa/<?php echo $empresa['emp_ds_logo']; ?>" />
              </a>

              <div class="card-body pt-1">
                <h5 class="card-text mb-0"><?php echo $empresa['emp_nm_nome']; ?><?php if ($empresa['emp_ds_status'] == 'liberada') { ?> <i class="bi bi-patch-check-fill text-primary"></i><?php } ?></h5>
                <p class="card-text fst-italic text-black-50 fs-6">em <?php echo $empresa['cat_nm_categoria'] ?></p>
                <p class="text-black-50 m-0 "><i class="bi bi-geo-alt-fill me-2 "></i>Itabuna-BA</p>

                <?php if (trim($empresa['emp_ds_email']) != "") { ?>
                  <p class="text-black-50 m-0 "><i class="bi bi-envelope-fill me-2"></i><?php echo $empresa['emp_ds_email']; ?></p>
                <?php } ?>

                <p class="text-black-50 m-0 "><i class="bi bi-telephone-fill"></i>
                  <a class="text-muted" href=""><?php echo $empresa['emp_nu_telefone']; ?></a>
                </p>

                <!-- <div class="lh-1 py-2">
                  <span>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                  </span>
                  <span class="text-warning">4.5</span>
                  <span class="text-muted">(27)</span>
                </div> -->

                <div class="d-flex justify-content-between align-items-center pt-5">
                  <div class="btn-group position-absolute " style="bottom: 15px; left:15px;">
                    <a href="empresa/<?php echo $empresa['emp_cd_empresa']; ?>" class="btn btn-sm btn-outline-secondary ">Ver dados</a>
                  </div>
                  <?php
                  $dt_atualizacao = date_create($empresa['emp_dt_atualizacao']);
                  ?>
                  <small class="text-muted position-absolute" style="bottom: 10px; right:10px;"><?php echo date_format($dt_atualizacao, 'd/m/Y'); ?></small>
                </div>
              </div>
            </div>
          </div>
        <?php } //fecha while
        ?>
        <!--fecha <div class="row">-->
      </div>

      <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
        <h4>Mais recentes</h4>
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary ">Ver todas</button>
        </div>
      </div>


      <div class="row row-cols-1 row-cols-sm-2  row-cols-lg-4 g-4">
        <?php
        $sqlEmpresa = $mysqli->query("SELECT * FROM empresa INNER JOIN categoria ON emp_cd_categoria = cat_cd_categoria ORDER BY emp_nm_nome DESC LIMIT 4;");

        while ($empresa = $sqlEmpresa->fetch_assoc()) {
        ?>
          <div class="col ">
            <div class=" card shadow h-100 ">
              <a href="empresa/<?php echo $empresa['emp_cd_empresa']; ?>" class="card-img-top">
                <img class="card-img-top " style="" aria-label="Placeholder: Thumbnail" alt="imagem" src="assets/img/empresa/<?php echo $empresa['emp_ds_logo']; ?>" />
              </a>

              <div class="card-body pt-2">
                <h5 class="card-text mb-0"><?php echo $empresa['emp_nm_nome']; ?><?php if ($empresa['emp_ds_status'] == 'liberada') { ?> <i class="bi bi-patch-check-fill text-primary"></i><?php } ?></h5>
                <p class="card-text fst-italic text-black-50 fs-6">em <?php echo $empresa['cat_nm_categoria'] ?></p>
                <p class="text-black-50 m-0 "><i class="bi bi-geo-alt-fill me-2 "></i>Itabuna-BA</p>

                <?php if (trim($empresa['emp_ds_email']) != "") { ?>
                  <p class="text-black-50 m-0 "><i class="bi bi-envelope-fill me-2"></i><?php echo $empresa['emp_ds_email']; ?></p>
                <?php } ?>

                <p class="text-black-50 m-0 "><i class="bi bi-telephone-fill"></i>
                  <a class="text-muted" href=""><?php echo $empresa['emp_nu_telefone']; ?></a>
                </p>

                <!-- <div class="lh-1 py-2">
                  <span>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                  </span>
                  <span class="text-warning">4.5</span>
                  <span class="text-muted">(27)</span>
                </div> -->

                <div class="d-flex justify-content-between align-items-center pt-5">
                  <div class="btn-group position-absolute " style="bottom: 15px; left:15px;">
                    <a href="empresa/<?php echo $empresa['emp_cd_empresa']; ?>" class="btn btn-sm btn-outline-secondary ">Ver dados</a>
                  </div>
                  <?php
                  $dt_atualizacao = date_create($empresa['emp_dt_atualizacao']);
                  ?>
                  <small class="text-muted position-absolute" style="bottom: 10px; right:10px;"><?php echo date_format($dt_atualizacao, 'd/m/Y'); ?></small>
                </div>
              </div>
            </div>
          </div>
        <?php } //fecha while
        ?>
        <!--fecha <div class="row">-->
      </div>

    </div>
  </div>

</main>
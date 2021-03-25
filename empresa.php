<?php
$sqlEmpresa = $mysqli->query("SELECT * FROM empresa INNER JOIN categoria ON emp_cd_categoria = cat_cd_categoria WHERE emp_cd_empresa = {$id}");
$empresa = $sqlEmpresa->fetch_assoc();
?>

<?php
$sqlProduto = $mysqli->query("SELECT * FROM produto WHERE pro_cd_empresa = {$id}");
$qtdProduto = $sqlProduto->num_rows;
?>

<div style="
				background: url(assets/img/profile-bg.jpg) repeat-x;
				background-position: center;
                padding: 4.5rem 0;
			"></div>
<!-- User info -->

<div class="card p-lg-2 pt-2 pt-lg-0 rounded-0 border-0 bg-white sombra-1">
    <div class="container ">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <div class="position-relative mt-n9">
                        <img src="assets/img/empresa/<?php echo $empresa['emp_ds_logo'] ?>" alt="" class="rounded-circle avatar-xxl border-white border-width-4 position-relative">
                        <a href="#!" class="position-absolute top-0 end-0 me-2 mt-2" data-toggle="tooltip" data-placement="top" title="Verified">
                            <img src="assets/img/checked-mark.svg" alt="" height="30" width="30" />
                        </a>
                    </div>
                    <div class="ms-3">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 font-weight-bold me-2"><?php echo $empresa['emp_nm_nome'] ?></h3>
                            <span class="badge badge-light-primary fw-light"><?php echo $empresa['cat_nm_categoria'] ?></span>
                        </div>
                        <span class="fs-6 text-muted "><?php echo $empresa['emp_ds_slogan'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="font-size-md mt-4 mt-lg-0 pb-2 pb-lg-0 d-lg-flex justify-content-end">
                    <?php if (trim($empresa['emp_ds_site']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_ds_site']); ?>" title="Site" class="bi bi-link-45deg text-black-50 me-2 fs-5"></a>
                    <?php } ?>
                    <?php if (trim($empresa['emp_ds_instagram']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_ds_instagram']); ?>" title="Instagram" class="bi bi-instagram text-black-50 me-2 fs-5"></a>
                    <?php } ?>
                    <?php if (trim($empresa['emp_ds_facebook']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_ds_facebook']); ?>" title="Facebook" class="bi bi-facebook text-black-50 me-2 fs-5"></a>
                    <?php } ?>
                    <?php if (trim($empresa['emp_ds_linkedin']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_ds_linkedin']); ?>" title="LinkedIn" class="bi bi-linkedin text-black-50 me-2 fs-5 "></a>
                    <?php } ?>
                    <?php if (trim($empresa['emp_ds_youtube']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_ds_youtube']); ?>" title="Youtube" class="bi bi-youtube text-black-50 me-2 fs-5 "></a>
                    <?php } ?>
                    <?php if (trim($empresa['emp_nu_whatsapp']) != "") { ?>
                        <a href="<?php echo trim($empresa['emp_nu_whatsapp']); ?>" title="Whatsapp" class="bi bi-whatsapp text-black-50 me-2 fs-5"></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content -->
<div class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-12 mb-4">
                <!-- Card -->

                <div class="card border-0 sombra-1 bg-white ">
                    <nav>
                        <div class="nav nav-tabs mb-1" id="nav-tab" role="tablist">
                            <?php
                            if ($qtdProduto > 0) {
                            ?>
                                <a class="nav-link active" id="nav-produto-tab" data-bs-toggle="tab" href="#nav-produto" role="tab" aria-controls="nav-produto" aria-selected="false">Meus Produtos <span class="text-muted fs-6">(<?php echo $qtdProduto; ?>)</span></a>
                            <?php
                            }
                            ?>
                            <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Sobre</a>
                            <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Mapa</a>
                        </div>
                    </nav>

                    <!-- Card body -->
                    <div class="card-body">
                        <div class="tab-content px-2" id="nav-tabContent">
                            <?php
                            if ($qtdProduto > 0) {
                            ?>
                                <div class="tab-pane fade show active" id="nav-produto" role="tabpanel" aria-labelledby="nav-produto-tab">
                                    <div class="container">
                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                                            <?php
                                            while ($produto = $sqlProduto->fetch_assoc()) {
                                            ?>
                                                <div class="col">
                                                    <div class="card mb-3 h-100">
                                                        <img src="./assets/img/produto/<?php echo $produto['pro_ds_foto1'] ?>" class="card-img-top" alt="...">
                                                        <div class="card-body d-grid gap-2">
                                                            <h5 class="card-title"><?php echo $produto['pro_nm_produto']; ?></h5>
                                                            <p class="card-text"><?php echo $produto['pro_ds_descricao']; ?></p>
                                                            <a href="" type="button" class="btn btn-success"><i class="bi bi-whatsapp me-2"></i>Comprar</a>
                                                            <?php
                                                            $dt_atualizacao = date_create($produto['pro_dt_atualizacao']);
                                                            ?>
                                                            <p class="card-text"><small class="text-muted">Atualizado em <?php echo date_format($dt_atualizacao, 'd/m/Y'); ?></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } //fecha while
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } //fecha if
                            ?>

                            <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <b>Telefone: </b><span></span><br>
                                <b>Celular: </b><span></span><br>
                                <b>E-mail: </b><span></span><br>
                                <b>Endereço: </b><span></span><br>
                                <b>Cidade: </b><span>Itabuna</span><br>
                                <b>Funcionamento: </b><span>Segunda a Sábado (09h00 às 18h00)</span><br><br>
                                <p>Placeholder content for the tab panel. This one relates to the home tab. Takes you miles
                                    high, so high, 'cause she’s got that one international smile. There's a stranger in my
                                    bed, there's a pounding in my head. Oh, no. In another life I would make you stay.
                                    ‘Cause I, I’m capable of anything. Suiting up for my crowning battle. Used to steal your
                                    parents' liquor and climb to the roof. Tone, tan fit and ready, turn it up cause its
                                    gettin' heavy. Her love is like a drug. I guess that I forgot I had a choice.</p>
                            </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7714.876539593798!2d-39.28826102698532!3d-14.800640785813979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x739aafbe2fde369%3A0xe3813793770b657!2sMangabinha%2C%20Itabuna%20-%20BA!5e0!3m2!1spt-BR!2sbr!4v1613561152788!5m2!1spt-BR!2sbr" class="w-100" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-12">
                <!-- Card -->
                <div class="card border-0 mb-4 sombra-1">
                    <!-- Card body -->
                    <div class="card-body">
                        <h4>Sobre a empresa</h4>
                        <p>
                            Criada em 2012, a Tok Modas trás a melhor opção para quem gosta de se vestir
                            bem. Com acessórios para homens e mulheres, nossas peças trazem charme e elegância a um
                            preço justo. Venha nos conhecer.
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 mb-4 sombra-1">
                    <!-- Card body -->
                    <div class="card-body">
                        <h4>Funcionamento</h4>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Abre</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-muted fst-italic">
                                    <td>Domingo</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Segunda</td>
                                    <td>09:00</td>
                                    <td>18:00</td>
                                </tr>
                                <tr>
                                    <td>Terça</td>
                                    <td>09:00</td>
                                    <td>18:00</td>
                                </tr>
                                <tr>
                                    <td>Quarta</td>
                                    <td>09:00</td>
                                    <td>18:00</td>
                                </tr>
                                <tr>
                                    <td><b>Quinta</b><i class="bi bi-clock-fill text-danger ms-2"></i></td>
                                    <td><b>09:00</b></td>
                                    <td><b>18:00</b></td>
                                </tr>
                                <tr>
                                    <td>Sexta</td>
                                    <td>09:00</td>
                                    <td>18:00</td>
                                </tr>
                                <tr class="text-muted fst-italic">
                                    <td>Sábado</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Card -->
                <!-- <div class="card border-0 mb-4 mb-lg-0 sombra-1">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <div>
                                <h4 class="mb-0 font-weight-bold">32</h4>
                                <p class="fs-6 mb-0">Produtos</p>
                            </div>
                            <div>
                                <span><i class="bi bi-file-text font-size-lg"></i></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <div>
                                <h4 class="mb-0 font-weight-bold">11.604</h4>
                                <p class="fs-6 mb-0">Visitas</p>
                            </div>
                            <div>
                                <span><i class="bi bi-people-fill font-size-lg"></i></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="mb-0 font-weight-bold">123</h4>
                                <p class="fs-6 mb-0">Avaliações</p>
                            </div>
                            <div>
                                <span><i class="bi bi-star font-size-lg"></i></span>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>



        </div>
    </div>
</div>
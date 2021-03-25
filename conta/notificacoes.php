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
                            <h4 class="mb-0">Notificações</h4>


                        </div>

                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class=" pt-0 pb-5">


                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <rect width="100%" height="100%" fill="#007aff" />
                                    </svg>

                                    <strong class="me-auto">Vendania</strong>
                                    <small class="text-muted">Agora mesmo</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Não há novas notificações no momento!
                                </div>
                            </div>

                            <div class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <rect width="100%" height="100%" fill="#007aff" />
                                    </svg>

                                    <strong class="me-auto">Vendania</strong>
                                    <?php $dt_criacao = date_create($usuario['usu_dt_criacao']);?>
                                    <small class="text-muted"><?php echo date_format($dt_criacao, 'd/m/Y')?></small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Estamos muito felizes e empolgados de ter você aqui conosco.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


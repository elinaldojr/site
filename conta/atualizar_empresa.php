<?php include "header_conta.php" ?>

<?php
$sqlEmpresa = $mysqli->query("SELECT * FROM empresa WHERE emp_cd_usuario = {$_SESSION['usu_cd_usuario']}");
$empresa = $sqlEmpresa->fetch_assoc()
?>

<?php
$msg_atualizacao = "";

if (!empty($id) && $id == "envia") {
    //CADASTRAR EMPRESA
    if (!empty($_FILES['logo']['tmp_name'])) {
        $bg = date("YmdHis");
        $tmp_name = $_FILES['logo']['tmp_name'];
        $real_name = $_FILES['logo']['name'];
        $separa = explode(".", $real_name);
        $extensao = strtolower($separa[count($separa) - 1]);
        $destino = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/empresa/" . $bg . "." . $extensao;
        $logo = $bg . "." . $extensao;
        $upload = move_uploaded_file($tmp_name, $destino);

        $pasta = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/empresa/";

        $alturady = 300;
        $largurady = 300;

        if ($extensao == 'jpg' || $extensao == 'jpeg') {
            $imgy = @imagecreatefromjpeg($pasta . $logo);
        } else if ($extensao == 'png') {
            $imgy = @imagecreatefrompng($pasta . $logo);
        } elseif ($extensao == 'gif') {
            $imgy = @imagecreatefromgif($pasta . $logo);
        }

        $larguraoy = imagesx($imgy);
        $alturaoy = imagesy($imgy);
        $novay = imagecreatetruecolor($largurady, $alturady);
        imagecopyresampled($novay, $imgy, 0, 0, 0, 0, $largurady, $alturady, $larguraoy, $alturaoy);
        imagejpeg($novay, "{$pasta}{$logo}", 100);

        @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/empresa/" . $_POST['logo_atual']);
    } else {
        $logo = $_POST['logo_atual'];
    }

    //                          0                     1                       2                          3                        4                                   5                     6                      7                          8                         9                         10                        11                       12                        13          14
    $dados = array(trim($_POST['nome']), trim($_POST['slogan']), trim($_POST['categoria']), trim($_POST['celular']), trim($_POST['telefone_comercial']), trim($_POST['site']), trim($_POST['email']), trim($_POST['instagram']), trim($_POST['facebook']), trim($_POST['whatsapp']), trim($_POST['linkedin']), trim($_POST['youtube']), trim($_POST['endereco']), trim($_POST['cidade']), $logo);

    $nome = htmlentities(@$dados[0], ENT_QUOTES, 'UTF-8');
    $slogan = htmlentities(@$dados[1], ENT_QUOTES, 'UTF-8');
    $categoria = (int)(@$dados[2]);
    $celular = htmlentities(@$dados[3], ENT_QUOTES, 'UTF-8');
    $telefone_comercial = htmlentities(@$dados[4], ENT_QUOTES, 'UTF-8');
    $site = htmlentities(@$dados[5], ENT_QUOTES, 'UTF-8');
    $email = htmlentities(@$dados[6], ENT_QUOTES, 'UTF-8');
    $instagram = htmlentities(@$dados[7], ENT_QUOTES, 'UTF-8');
    $facebook = htmlentities(@$dados[8], ENT_QUOTES, 'UTF-8');
    $whatsapp = htmlentities(@$dados[9], ENT_QUOTES, 'UTF-8');
    $linkedin = htmlentities(@$dados[10], ENT_QUOTES, 'UTF-8');
    $youtube = htmlentities(@$dados[11], ENT_QUOTES, 'UTF-8');
    $endereco = htmlentities(@$dados[12], ENT_QUOTES, 'UTF-8');
    $cidade = (int)(@$dados[13]);
    $logo = (@$dados[14]);

    $query = "UPDATE empresa SET emp_nm_nome = '{$nome}',
    emp_ds_slogan = '{$slogan}', emp_ds_email = '{$email}', 
    emp_cd_categoria = {$categoria}, emp_nu_celular = '{$celular}', 
    emp_nu_telefone = '{$telefone_comercial}', emp_ds_site = '{$site}', 
    emp_ds_instagram = '{$instagram}', emp_ds_facebook = '{$facebook}', 
    emp_nu_whatsapp = '$whatsapp', emp_ds_youtube = '$youtube', emp_ds_linkedin = '$linkedin',
    emp_ds_endereco = '{$endereco}', emp_cd_cidade = {$cidade}, 
    emp_no_cep = '', 
    emp_bl_receber_newsletter = false, 
    emp_ds_logo = '$logo', emp_cd_usuario = {$_SESSION['usu_cd_usuario']}, 
    emp_dt_atualizacao = '" . date("Y-m-d H:i:s") . "' WHERE emp_cd_empresa = {$empresa['emp_cd_empresa']}";

    if ($mysqli->query($query)) {
        $msg_atualizacao = "<div class='alert alert-success' role='alert'>
        Os dados da empresa foram atualizados com sucesso!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
        </div>";

        $erro = 0;
    } else {
        $erro = 1;
    }
}
?>

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
                            <h4 class="mb-0"><?php echo $empresa['emp_nm_nome'] ?></h4>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <?php
                        //se houver erro ao atualizar os dados da empresa
                        if (isset($erro) && !$erro) {
                            echo $msg_atualizacao;
                        }
                        //se não houver ao atualizar os dados da empresa ou
                        //se o usuário não tentou atualizar ainda
                        else {
                        ?>
                            <div class=" pt-0 pb-5">
                                <form accept-charset="utf-8" class="needs-validation" enctype="multipart/form-data" action="conta/atualizar_empresa/envia" method="post">
                                    <div class="d-lg-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center mb-4 mb-lg-0">
                                            <img src="./assets/img/empresa/<?php echo $empresa['emp_ds_logo'] ?>" id="img_perfil" class="avatar-xl rounded" alt="" />
                                            <div class="ms-3">
                                                <h4 class="mb-0">Logotipo/marca</h4>
                                            </div>
                                        </div>
                                        <input id="logo" type="file" name="logo" accept="image/*">
                                        <input type="hidden" name="logo_atual" value="<?php echo $empresa['emp_ds_logo']; ?>">
                                    </div>

                                    <hr class="my-4" />

                                    <h4 class="mb-3">Dados da Empresa</h4>

                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="<?php echo $empresa['emp_nm_nome']; ?>" required>
                                            <div class="invalid-feedback">
                                                Preencha o nome.
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control text-muted" id="email" disabled placeholder="" value="<?php echo $empresa['emp_ds_email']; ?>">
                                            <input type="hidden" class="form-control" name="email" placeholder="" value="<?php echo $empresa['emp_ds_email']; ?>">
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="slogan" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="slogan" name="slogan" placeholder="" value="<?php echo $empresa['emp_ds_slogan']; ?>" required>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="endereco" class="form-label">Endereco</label>
                                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="" value="<?php echo $empresa['emp_ds_slogan']; ?>" required>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="cidade" class="form-label">Cidade</label>
                                            <select id="cidade" name="cidade" class="form-control form-select">
                                                <option></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="categoria" class="form-label">Categoria</label>
                                            <select id="categoria" name="categoria" class="form-control form-select">
                                                <?php
                                                $sqlCategoria = $mysqli->query("SELECT * FROM categoria ORDER BY cat_nm_categoria ASC");
                                                while ($categoria = $sqlCategoria->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $categoria['cat_cd_categoria']; ?>" <?php echo $categoria['cat_cd_categoria'] == $empresa['emp_cd_categoria'] ? "selected" : ""; ?>><?php echo $categoria['cat_nm_categoria'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" disabled name="status" class="form-control form-select">
                                                <?php
                                                //$sqlCategoria = $mysqli->query("SELECT * FROM categoria ORDER BY cat_nm_categoria ASC");
                                                //while ($categoria = $sqlCategoria->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $empresa['emp_ds_status']; ?>"><?php echo $empresa['emp_ds_status'] ?></option>
                                                <?php //} 
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="text" class="form-control " id="celular" name="celular" placeholder="" value="<?php echo $empresa['emp_nu_celular']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="telefone_comercial" class="form-label">Telefone Comercial</label>
                                            <input type="text" class="form-control" id="telefone_comercial" name="telefone_comercial" placeholder="" value="<?php echo $empresa['emp_nu_telefone']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="site" class="form-label">Site</label>
                                            <input type="text" class="form-control " id="site" name="site" placeholder="" value="<?php echo $empresa['emp_ds_site']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="whatsapp" class="form-label">Whatsapp</label>
                                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="" value="<?php echo $empresa['emp_nu_whatsapp']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" class="form-control " id="instagram" name="instagram" placeholder="" value="<?php echo $empresa['emp_ds_instagram']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="" value="<?php echo $empresa['emp_ds_facebook']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" class="form-control " id="youtube" name="youtube" placeholder="" value="<?php echo $empresa['emp_ds_youtube']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="linkedin" class="form-label">LinkedIn</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="" value="<?php echo $empresa['emp_ds_linkedin']; ?>">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Atualizar dados</button>
                                    </div>
                                </form>
                            </div>

                        <?php
                        } //fecha else
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
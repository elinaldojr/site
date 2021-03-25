<?php
function utf8_strtr($string){
    $string = preg_replace("/[áàâãä]/", "a", $string);
    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
    $string = preg_replace("/[éèê]/", "e", $string);
    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
    $string = preg_replace("/[íì]/", "i", $string);
    $string = preg_replace("/[ÍÌ]/", "I", $string);
    $string = preg_replace("/[óòôõö]/", "o", $string);
    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
    $string = preg_replace("/[úùü]/", "u", $string);
    $string = preg_replace("/[ÚÙÜ]/", "U", $string);
    $string = preg_replace("/ç/", "c", $string);
    $string = preg_replace("/Ç/", "C", $string);
    $string = preg_replace("/ª/", "", $string);
    $string = preg_replace("/º/", "", $string);
    $string = preg_replace("/°/", "", $string);

    $Naoquero = array(",", ".", "-", "  ");
    $Naoquerod = array(" / ", "/");
    $Naoquerot = array("@", "!");
    $chave = strtolower(preg_replace('/[`^~\'"]/', null, iconv('iso-8859-1', 'ASCII//TRANSLIT', $string)));
    $chave = str_replace($Naoquerot, "", $chave);
    $chave = str_replace($Naoquerod, " ", $chave);
    $chave = str_replace($Naoquero, "", $chave);
    return str_replace(" ", "-", $chave);
}


$alertar = NULL;

if (!empty($id) && $id == "envia") {

    $dados_usuario = NULL;
    $dados_usuario = array(trim($_POST['nome']), trim($_POST['email']), trim($_POST['funcao']), trim($_POST['usuario']), trim($_POST['senha']));

    $erro = false;

    if (!$erro) {
        $nome = htmlentities(@$dados_usuario[0], ENT_QUOTES, 'UTF-8');
        $email = htmlentities(@$dados_usuario[1], ENT_QUOTES, 'UTF-8');
        $login = htmlentities(@$dados_usuario[3], ENT_QUOTES, 'UTF-8');
        $senha = htmlentities(@$dados_usuario[4], ENT_QUOTES, 'UTF-8');

        //cadastra usuario
        $mysqli->query("INSERT INTO usuario (usu_nm_nome, usu_ds_email, usu_ds_login, usu_ds_senha, usu_st_nivel, usu_ds_fotoperfil) 
        VALUES ('" . @$nome . "', '" . @$email . "', '" . @$login . "', '" . @$senha . "', '1', 'avatar-padrao-1.png'/*, '" . date("Y-m-d H:i:s") . "'*/)") or die($mysqli->error);

        $id_usuario = $mysqli->insert_id;

        if ($id_usuario > 0) {
            $_SESSION['usu_cd_usuario'] = $id_usuario;


            //CAD EMPRESA
            if (!empty($_FILES['logotipo_empresa']['tmp_name'])) {
                $bg = date("YmdHis");
                $tmp_name  = $_FILES['logotipo_empresa']['tmp_name'];
                $real_name = $_FILES['logotipo_empresa']['name'];
                $separa = explode(".", $real_name);
                $extensao = strtolower($separa[count($separa) - 1]);
                $destino = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/empresa/" . $bg . "." . $extensao;
                $logotipo_empresa = $bg . "." . $extensao;
                $upload = move_uploaded_file($tmp_name, $destino);

                $pasta = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/empresa/";

                $alturady = 300;
                $largurady = 300;

                if ($extensao == 'jpg' || $extensao == 'jpeg') {
                    $imgy = @imagecreatefromjpeg($pasta . $logotipo_empresa);
                } else if ($extensao == 'png') {
                    $imgy = @imagecreatefrompng($pasta . $logotipo_empresa);
                } elseif ($extensao == 'gif') {
                    $imgy = @imagecreatefromgif($pasta . $logotipo_empresa);
                }

                $larguraoy = imagesx($imgy);
                $alturaoy = imagesy($imgy);
                $novay = imagecreatetruecolor($largurady, $alturady);
                imagecopyresampled($novay, $imgy, 0, 0, 0, 0, $largurady, $alturady, $larguraoy, $alturaoy);
                imagejpeg($novay, "{$pasta}{$logotipo_empresa}", 100);
            } else {
                $logofotof = 0;
                $logotipo_empresa = 'empresa-padrao-1.png';
            }


            $dados_empresa = array(trim($_POST['nome_empresa']), trim($_POST['categoria']), trim($_POST['celular']), trim($_POST['telefone_comercial']), trim($_POST['site_empresa']), trim($_POST['email_empresa']), trim($_POST['instagram_empresa']), trim($_POST['facebook_empresa']), trim($_POST['endereco_empresa']), trim($_POST['cidade']), $logotipo_empresa);

            $nome_empresa = htmlentities(@$dados_empresa[0], ENT_QUOTES, 'UTF-8');
            $celular = htmlentities(@$dados_empresa[2], ENT_QUOTES, 'UTF-8');
            $telefone_comercial = htmlentities(@$dados_empresa[3], ENT_QUOTES, 'UTF-8');
            $site_empresa = htmlentities(@$dados_empresa[4], ENT_QUOTES, 'UTF-8');
            $email_empresa = htmlentities(@$dados_empresa[5], ENT_QUOTES, 'UTF-8');
            $instagram_empresa = htmlentities(@$dados_empresa[6], ENT_QUOTES, 'UTF-8');
            $facebook_empresa = htmlentities(@$dados_empresa[7], ENT_QUOTES, 'UTF-8');
            $endereco_empresa = htmlentities(@$dados_empresa[8], ENT_QUOTES, 'UTF-8');

            $query = ("INSERT INTO empresa (emp_nm_nome, emp_ds_email, emp_cd_categoria, emp_ds_status, emp_no_celular, emp_no_telefone, emp_ds_site, emp_ds_instagram, emp_ds_facebook, emp_ds_endereco, emp_cd_cidade, emp_ds_logo, emp_cd_usuario, emp_dt_criacao, emp_dt_atualizacao) 
            VALUES ('" . @$nome_empresa . "', '" . @$email_empresa . "', '" . @$dados_empresa[1] . "', 'pendente', '" . @$celular . "', '" . @$telefone_comercial . "','" . @$site_empresa . "','" . @$instagram_empresa . "','" . @$facebook_empresa . "', '" . @$endereco_empresa . "', '" . @$dados_empresa[9] . "', '" . @$logotipo_empresa . "', " . $id_usuario . ", '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')");

            if($mysqli->query($query)){
                $id_empresa = $mysqli->insert_id;
                $chave = utf8_strtr($nome_empresa) . "-{$id_empresa}";

            $mysqli->query("UPDATE empresa SET emp_ds_chave = '{$chave}' WHERE emp_cd_empresa = {$id_empresa}") or die($mysqli->error);

            }
        }

        $txtmsgemail = "Texto teste";
        if (!empty($email)) {

            include("classes/class.phpmailer.php");

            $mail = new PHPMailer();
            $mail->SetLanguage("br");
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = true;
            $mail->Username = 'vendaniaoficial@gmail.com';
            $mail->Password = $hostpass;
            $mail->IsHTML(true);
            $mail->From = 'vendaniaoficial@gmail.com';
            $mail->FromName = 'Vendania';

            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->Subject = "Seu cadastro foi feito com sucesso - Vendania.com.br";

            $msgcorpo = '
            
' . $txtmsgemail . ' 

<b>Seus dados de acesso são:</b>  
E-mail: ' . @$login . '
Senha: ' . @$senha . '
     
<b>Anteciosamente,</b>
Vendania';



            $mail->Body = '<p><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#333333">Seja bem vinda(o). Agora você faz parte da Vendania.</font></p>' . nl2br($msgcorpo);

            $femail = $email;

            $email = trim($femail);
            $mail->ClearAddresses();
            $mail->AddAddress($email);
            if (!$mail->Send()) {
                //echo "ERRO Nome: $nome<br>Email: $femail<br>-------------<br><br>";
            } else {
                //echo "Nome: $nome<br>Email: $femail<br>-------------<br><br>";
            }
            $mail->SmtpClose();
            //sleep(15);


            /////////////////////////////////////////////////	
            /////////////////////////////////////////////////	

            $mail = new PHPMailer();
            $mail->SetLanguage("br");
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = true;
            $mail->Username = 'vendaniaoficial@gmail.com';
            $mail->Password = $hostpass;
            //$mail->Timeout = (int) '300';
            $mail->IsHTML(true);
            $mail->From = 'vendaniaoficial@gmail.com';
            $mail->FromName = 'Vendania';

            $mail->SMTPSecure = "tls";
            $mail->Port     = 587;

            // Configuração de Assuntos e Corpo do E-mail
            $mail->Subject = "Você acabou de receber um cadastro novo - " . 'Vendania' . "";

            $sql_pais = $mysqli->query("SELECT * FROM usuario WHERE usu_cd_usuario = '" . @$id_usuario . "'");
            $row_pais = $sql_pais->fetch_assoc();

            // $sqlcidade_sel = $mysqli->query("SELECT * FROM empresa WHERE empresa_cd_usuario = '" . @$id_usuario . "'");
            // $rowcidade_sel = $sqlcidade_sel->fetch_assoc();

            $msgcorpo = '

' . $txtmsgemail . ' 

<b>Acesse o ADMIN do site para liberar o cadastro:</b>  
Empresa: ' . @$nome . '
E-mail: ' . @$email . '
País:
Cidade: 
     
<b>Anteciosamente,</b>
Vendania';

            $mail->Body = '<p><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#333333">Você acabou de receber um cadastro novo</font></p>

' . nl2br($msgcorpo) . '

';

            $femail = 'jrdulahan@gmail.com';

            $email = trim($femail);
            $mail->ClearAddresses();
            $mail->AddAddress($email);
            if (!$mail->Send()) {
                //echo "ERRO Nome: $nome<br>Email: $femail<br>-------------<br><br>";
            } else {
                //echo "Nome: $nome<br>Email: $femail<br>-------------<br><br>";
            }
            $mail->SmtpClose();
            //sleep(15);	
        }

        $alertar = "<div class='alert alert-success' role='alert'>
        <h4 class='alert-heading'>Bem vinda(o)!</h4>
        O cadastro foi efetuado com sucesso. Estamos muito felizes que você está conosco.<br>
        <a href='home' class='alert-link'>Voltar para página principal.</a>.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
        </div>";
    }
}

?>

<div class="container-fluid " style="background: #ffa70e;">
    <div class="container">
        <div class="row">
            <div class=" col-lg-10 col-md-12 col-12 pt-5 pb-4">
                <div class="d-lg-flex align-items-center justify-content-between">
                    <!-- Content -->
                    <div class="mb-4 mb-lg-0">
                        <h1 class="text-white mb-1">Cadastrar minha empresa</h1>
                        <p class="mb-0 text-white lead">
                            Falta pouco para sua empresa fazer parte da <strong>Vendania</strong>.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Card -->
        <div class="card border-0 sombra-1 mt-4 p-4 ">
            <?php echo $alertar; ?>

            <h5 class="mb-3">Formulário de Cadastro</h5>
            <form accept-charset="utf-8" action="cadastro/envia" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row g-3">


                    <?php
                    //se usuario não estiver logado
                    if (!isset($_SESSION['usu_cd_usuario'])) {
                    ?>

                        <div class="col-sm-4">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" value="" required>
                            <div class="invalid-feedback">
                                Preencha seu nome completo.
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@eu.com">
                            <div class="invalid-feedback">
                                Preencha seu email.
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="funcao" class="form-label">Função na Empresa</label>
                            <select class="form-select" id="funcao" name="funcao" required>
                                <option value=""></option>
                                <option>Proprietário</option>
                                <option>Gerente</option>
                                <option>Colaborador</option>
                                <option>Outro</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="usuario" class="form-label">Nome de Usuário</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">vendania.com.br/</span>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="meu_usuario" required>
                                <div class="invalid-feedback">
                                    Escreva seu nome de usuário
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Digite a Senha.
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Confirme a Senha.
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-6">
                            <label for="nome_empresa" class="form-label">Nome da Empresa</label>
                            <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Minha empresa" value="" required>
                            <div class="invalid-feedback">
                                Nome da Empresa é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value=""></option>
                                <?php
                                $sqlCategoria = $mysqli->query("SELECT * FROM categoria ORDER BY cat_nm_categoria ASC");
                                while ($categoria = $sqlCategoria->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $categoria['cat_cd_categoria']; ?>">
                                        <?php echo $categoria['cat_nm_categoria']; ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="(73) 99999-9999" value="" required>
                            <div class="invalid-feedback">
                                Digite o Celular.
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <label for="telefone_comercial" class="form-label">Tel. Comercial</label>
                            <input type="text" class="form-control" id="telefone_comercial" name="telefone_comercial" placeholder="(73) 99999-9999" value="" required>
                            <div class="invalid-feedback">
                                Digite o Telefone Comercial.
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="site_empresa" class="form-label">Site da Empresa</label>
                            <input type="text" class="form-control" id="site_empresa" name="site_empresa" placeholder="exemplo@empresa.com" value="" required>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="email_empresa" class="form-label">Email da Empresa</label>
                            <input type="text" class="form-control" id="email_empresa" name="email_empresa" placeholder="exemplo@empresa.com" value="" required>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="instagram_empresa" class="form-label">Instagram da Empresa</label>
                            <input type="text" class="form-control" id="instagram_empresa" name="instagram_empresa" placeholder="exemplo@empresa.com" value="" required>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="facebook_empresa" class="form-label">Facebook da Empresa</label>
                            <input type="text" class="form-control" id="facebook_empresa" name="facebook_empresa" placeholder="exemplo@empresa.com" value="" required>
                        </div>

                        <div class="col-md-7">
                            <label for="endereco_empresa" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco_empresa" name="endereco_empresa" placeholder="Endereço da empresa" value="" required>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" required>
                                <option value=""></option>
                                <option>Acre</option>
                                <option>Amapá</option>
                                <option>Bahia</option>
                                <option>Ceará</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecione um estado.
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <label for="cidade" class="form-label">Cidade</label>
                            <select class="form-select" id="cidade" name="cidade" required>
                                <option value=""></option>
                                <option>Itabuna</option>
                                <option>Itamaraju</option>
                                <option>Ilhéus</option>
                                <option>Outra</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecione uma cidade.
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="logotipo_empresa">Logotipo/marca da Empresa</label>
                            <input type="file" class="form-control" id="logotipo_empresa" name="logotipo_empresa" accept="image/*">
                        </div>
                        <?php

                    }
                    //Se o usuario estiver logado 
                    if (isset($_SESSION['usu_cd_usuario'])) {
                        $sqlEmpresa = $mysqli->query("SELECT emp_cd_empresa FROM empresa WHERE (emp_cd_Empresa = " . $_SESSION['usu_cd_usuario'] . ");");
                        $existeCadastroEmpresa = $sqlEmpresa->num_rows;

                        $sqlUsuario = $mysqli->query("SELECT usu_st_nivel FROM usuario WHERE usu_cd_usuario = '" . $_SESSION['usu_cd_usuario'] . "'");
                        $usuario = $sqlUsuario->fetch_assoc();

                        //se usuario tiver empresa cadastrada ou se o nivel dele NÃO for de administrador
                        if (($existeCadastroEmpresa == 1) && ($usuario['usu_st_nivel'] == 1)) {
                            echo "<script>alert('Você já possui uma empresa cadastrada.')</script>";
                            echo "<script language='JavaScript'>
                                window.location = 'home';
                                </script>";
                        }

                        //se usuario não tiver nenhuma empresa cadastrada ou se o nivel dele for de administrador
                        if (($existeCadastroEmpresa == 0) || ($usuario['usu_st_nivel'] > 1)) {
                        ?>

                            <div class="col-md-5 col-sm-6">
                                <label for="nome_empresa" class="form-label">Nome da Empresa</label>
                                <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Minha empresa" value="" required>
                                <div class="invalid-feedback">
                                    Nome da Empresa é obrigatório.
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value=""></option>
                                    <?php
                                    $sqlCategoria = $mysqli->query("SELECT * FROM categoria ORDER BY cat_nm_categoria ASC");
                                    while ($categoria = $sqlCategoria->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $categoria['cat_cd_categoria']; ?>">
                                            <?php echo $categoria['cat_nm_categoria']; ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-6">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="(73) 99999-9999" value="" required>
                                <div class="invalid-feedback">
                                    Digite o Celular.
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-6">
                                <label for="telefone_comercial" class="form-label">Tel. Comercial</label>
                                <input type="text" class="form-control" id="telefone_comercial" name="telefone_comercial" placeholder="(73) 99999-9999" value="" required>
                                <div class="invalid-feedback">
                                    Digite o Telefone Comercial.
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="site_empresa" class="form-label">Site da Empresa</label>
                                <input type="text" class="form-control" id="site_empresa" name="site_empresa" placeholder="exemplo@empresa.com" value="" required>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="email_empresa" class="form-label">Email da Empresa</label>
                                <input type="text" class="form-control" id="email_empresa" name="email_empresa" placeholder="exemplo@empresa.com" value="" required>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="instagram_empresa" class="form-label">Instagram da Empresa</label>
                                <input type="text" class="form-control" id="instagram_empresa" name="instagram_empresa" placeholder="exemplo@empresa.com" value="" required>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="facebook_empresa" class="form-label">Facebook da Empresa</label>
                                <input type="text" class="form-control" id="facebook_empresa" name="facebook_empresa" placeholder="exemplo@empresa.com" value="" required>
                            </div>

                            <div class="col-md-7">
                                <label for="endereco_empresa" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco_empresa" name="endereco_empresa" placeholder="Endereço da empresa" value="" required>
                            </div>

                            <div class="col-md-2 col-sm-6">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" required>
                                    <option value=""></option>
                                    <option>Acre</option>
                                    <option>Amapá</option>
                                    <option>Bahia</option>
                                    <option>Ceará</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecione um estado.
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <select class="form-select" id="cidade" name="cidade" required>
                                    <option value=""></option>
                                    <option>Itabuna</option>
                                    <option>Itamaraju</option>
                                    <option>Ilhéus</option>
                                    <option>Outra</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecione uma cidade.
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="logotipo_empresa">Logotipo/marca da Empresa</label>
                                <input type="file" class="form-control" id="logotipo_empresa" name="logotipo_empresa">
                            </div>

                    <?php }
                    }
                    ?>

                </div>

                <hr class="my-4">

                <div class="col-12">
                    <label for="cupom_desconto" class="form-label">Cupom de desconto</label>
                    <input type="text" class="form-control" id="cupom_desconto" name="cupom_desconto" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Preencha com seu endereço.
                    </div>
                </div>

                <hr class="my-4">

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="politica">
                    <label class="form-check-label" for="politica">Li e concordo com a política de privacidade da Vendania.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="receber_emails">
                    <label class="form-check-label" for="receber_emails">Desejo receber e-mails da Vendania.</label>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Pagamanto</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                        <label class="form-check-label" for="credit">Cartão de Crédito</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="debit">Boleto</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="paypal">Pix</label>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Enviar Dados</button>
            </form>
        </div>

    </div>
</div>
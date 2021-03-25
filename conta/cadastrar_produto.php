<?php include "header_conta.php" ?>

<?php
if (empty($_SESSION['id_produto']) && !empty($id) && $id != "envia") {
    $_SESSION['id_produto'] = $id;
} elseif (!empty($_SESSION['id_produto']) && $id != "envia") {
    $_SESSION['id_produto'] = $id;
}
?>

<?php
function utf8_strtr($string)
{
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

//cadastrar produto
if (!empty($id) && ($id == "envia" || $id == "edita")) {

    $fotos_form = array($_FILES['foto1'], $_FILES['foto2'], $_FILES['foto3'], $_FILES['foto4']);
    $fotos = array();

    $cont = 0;
    foreach ($fotos_form as $value) {
        if ($value['name'] != "") {
            $bg = md5(rand() * 10000000);
            $tmp_name  = $value['tmp_name'];
            $real_name = $value['name'];
            $separa = explode(".", $real_name);
            $extensao = strtolower($separa[count($separa) - 1]);
            $destino = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $bg . "." . $extensao;
            $fotos[$cont] = $bg . "." . $extensao;
            $upload = move_uploaded_file($tmp_name, $destino);

            $pasta = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/";

            $alturady = 800;
            $largurady = 800;

            if ($extensao == 'jpg' || $extensao == 'jpeg') {
                $imgy = @imagecreatefromjpeg($pasta . $fotos[$cont]);
            } else if ($extensao == 'png') {
                $imgy = @imagecreatefrompng($pasta . $fotos[$cont]);
            } elseif ($extensao == 'gif') {
                $imgy = @imagecreatefromgif($pasta . $fotos[$cont]);
            }

            $larguraoy = imagesx($imgy);
            $alturaoy = imagesy($imgy);
            $novay = imagecreatetruecolor($largurady, $alturady);
            imagecopyresampled($novay, $imgy, 0, 0, 0, 0, $largurady, $alturady, $larguraoy, $alturaoy);
            imagejpeg($novay, "{$pasta}{$fotos[$cont]}", 100);

            //caso seja atualização, remove a foto atual do banco
            if (!empty($_SESSION['id_produto'])) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $_POST['foto1']);
                @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $_POST['foto2']);
                @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $_POST['foto3']);
                @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $_POST['foto4']);
            }
        } else {
            //atualização
            //se o usuário não inserir nenhuma imagem, matém as que já existem
            if (!empty($_SESSION['id_produto'])) {
                $ind = $cont + 1; //pega o índice da foto
                $foto_atual = "foto{$ind}"; //concatena
                $fotos[$cont] = $_POST[$foto_atual]; //matém a foto já existente se o usuário não inserir outra
            }
            //cadastro
            //se o usuário não inserir nenhuma imagem, insere texto vazio ('')
            else {
                $logofotof = 0;
                $fotos[$cont] = '';
            }
        }
        $cont++;
    }

    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $valor = trim($_POST['valor']);
    $valor_promocional = trim($_POST['valor_promocional']);
    $foto1 = trim($fotos[0]);
    $foto2 = trim($fotos[1]);
    $foto3 = trim($fotos[2]);
    $foto4 = trim($fotos[3]);
    $status = trim($_POST['status']);

    //substitui a vígula por ponto
    $valor = str_replace(",", ".", $_POST['valor']);
    $valor_promocional = str_replace(",", ".", $_POST['valor_promocional']);

    //cadastra produto
    if ($id == "envia" && empty($_SESSION['id_produto'])) {
        $query = ("INSERT INTO produto (pro_nm_produto, pro_ds_descricao, pro_vl_precooriginal, pro_vl_precopromocional, pro_st_status, pro_ds_foto1, pro_ds_foto2, pro_ds_foto3, pro_ds_foto4, pro_cd_empresa, pro_dt_criacao, pro_dt_atualizacao) 
        VALUES ('{$nome}', '{$descricao}', {$valor}, {$valor_promocional}, '{$status}', '{$foto1}', '{$foto2}', '{$foto3}', '{$foto4}', {$empresa['emp_cd_empresa']}, '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');");

        $msg_sucesso = "";

        if ($mysqli->query($query)) {
            $id_produto = $mysqli->insert_id;
            $chave = utf8_strtr($_POST['nome']) . "-{$id_produto}";

            $mysqli->query("UPDATE produto SET pro_ds_chave = '{$chave}' WHERE pro_cd_produto = {$id_produto}") or die($mysqli->error);

            $msg_sucesso = "<div class='alert alert-success' role='alert'>
    O produto foi criado com sucesso!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
    </div>";

            $erro = 0;
        }
    }
    //atualiza produto
    else {

        $chave = utf8_strtr($_POST['nome']) . "-{$_SESSION['id_produto']}";

        $query = ("UPDATE produto SET pro_nm_produto='{$nome}', pro_ds_chave='{$chave}',
        pro_ds_descricao='{$descricao}', pro_vl_precooriginal='{$valor}',
        pro_vl_precopromocional='{$valor_promocional}', pro_st_status='{$status}',
        pro_ds_foto1='{$foto1}',pro_ds_foto2='{$foto2}',pro_ds_foto3='{$foto3}',pro_ds_foto4='{$foto4}',
        pro_dt_atualizacao= '" . date("Y-m-d H:i:s") . "' WHERE pro_cd_produto = {$_SESSION['id_produto']};");

        if ($mysqli->query($query)) {
            $msg_sucesso = "<div class='alert alert-success' role='alert'>
    O produto foi atualizado com sucesso!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
    </div>";
            //echo "<meta http-equiv='refresh' content='0;url=./conta/listar_produtos'>";

            $erro = 0;
            unset($_SESSION['id_produto']);
        }
    }
}

?>


<div class="pt-4">
    <div class="container">
        <div class="row">

            <?php include "menu_perfil.php" ?>
            <div class="col-lg-9 col-md-8 col-12">

                <div class="card border-0 bg-white sombra-1">
                    <!-- Card header -->

                    <div class="card-header bg-white d-lg-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-lg-0">
                            <h4 class="mb-0">Cadastrar Produto</h4>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">

                        <?php
                        if (isset($erro) && !$erro) {
                            echo $msg_sucesso;
                        }
                        ?>
                        <?php
                        if (!empty($_SESSION['id_produto'])) {
                            $sqlProduto = $mysqli->query("SELECT * FROM produto WHERE pro_cd_produto = {$_SESSION['id_produto']}");
                            $produto = $sqlProduto->fetch_assoc();
                        }
                        ?>
                        <div class="pt-0 pb-5">
                            <form accept-charset="utf-8" class="needs-validation" role="form" action="conta/cadastrar_produto/<?php  ?>envia" method="post" enctype="multipart/form-data">

                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label for="nome" class="form-label">Nome:</label>
                                        <input type="text" id="nome" name="nome" value="<?php echo @$produto['pro_nm_produto'] ?>" class="form-control" maxlength="80" autocomplete="off">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="descricao" class="form-label">Descrição:</label>
                                        <textarea name="descricao" id="descricao" class="form-control" rows="3"><?php echo @$produto['pro_ds_descricao'] ?></textarea>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="valor" class="form-label"> Valor Original:</label>
                                        <input type="text" id="valor" name="valor" value="<?php echo str_replace('.', ',', @$produto['pro_vl_precooriginal']); ?>" class="form-control" autocomplete="off" onKeyDown="FormataValor(this,event,17,2);" onKeyPress="return Teclanum(event);">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="valor_promocional" class="form-label"> Valor Promocional:</label>
                                        <input type="text" id="valor_promocional" name="valor_promocional" value="<?php echo str_replace(".", ",", @$produto['pro_vl_precopromocional']); ?>" class="form-control" autocomplete="off" onKeyDown="FormataValor(this,event,17,2);" onKeyPress="return Teclanum(event);">
                                    </div>

                                    <h4>Imagens</h4>
                                    <div class="col-sm-12">
                                        <?php if (!empty($produto['pro_ds_foto1'])) { ?>
                                            <img src="./assets/img/produto/<?php echo $produto['pro_ds_foto1'] ?>" class="rounded" width="80">
                                        <?php } ?>
                                        <label class="form-label">Primeira foto:</label>
                                        <input id="logo" type="file" name="foto1" value="" accept="image/*">
                                    </div>
                                    <div class="col-sm-12">
                                        <?php if (!empty($produto['pro_ds_foto2'])) { ?>
                                            <img src="./assets/img/produto/<?php echo $produto['pro_ds_foto2'] ?>" class="rounded" width="80">
                                        <?php } ?>
                                        <label class="form-label">Segunda foto:</label>
                                        <input id="logo" type="file" name="foto2" value="" accept="image/*">
                                    </div>
                                    <div class="col-sm-12">
                                        <?php if (!empty($produto['pro_ds_foto3'])) { ?>
                                            <img src="./assets/img/produto/<?php echo $produto['pro_ds_foto3'] ?>" class="rounded" width="80">
                                        <?php } ?>
                                        <label class="form-label">Terceira foto:</label>
                                        <input id="logo" type="file" name="foto3" value="" accept="image/*">
                                    </div>
                                    <div class="col-sm-12">
                                        <?php if (!empty($produto['pro_ds_foto4'])) { ?>
                                            <img src="./assets/img/produto/<?php echo $produto['pro_ds_foto4'] ?>" class="rounded" width="80">
                                        <?php } ?>
                                        <label class="form-label">Quarta foto:</label>
                                        <input id="logo" type="file" name="foto4" value="" accept="image/*">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Status:</label>
                                        <div class="radio">
                                            <label><input type="radio" name="status" id="status" value="ativo" <?php if (empty($rowproduto['pro_st_status']) || (!empty($rowproduto['pro_st_status']) && $rowproduto['pro_st_status'] != "inativo")) {
                                                                                                                    echo "checked";
                                                                                                                } ?>> Ativo</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="status" id="status" value="inativo" <?php if (!empty($rowproduto['pro_st_status']) && $rowproduto['pro_st_status'] == "inativo") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Inativo</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "header_conta.php" ?>

<?php
$sqlEmpresa = $mysqli->query("SELECT emp_cd_empresa FROM empresa WHERE emp_cd_usuario = {$_SESSION['usu_cd_usuario']}");
$empresa = $sqlEmpresa->fetch_assoc();
////////////////////////////////////////////////


if (!empty($id) && $id == "excluir") {
    $sqlProduto = $mysqli->query("SELECT * FROM produto WHERE pro_cd_produto = '" . $ids . "' AND pro_cd_empresa = {$empresa['emp_cd_empresa']}");
    $produto = $sqlProduto->fetch_assoc();

    $fotos = array();
    $fotos[0] = $produto['pro_ds_foto1'];
    $fotos[1] = $produto['pro_ds_foto2'];
    $fotos[2] = $produto['pro_ds_foto3'];
    $fotos[3] = $produto['pro_ds_foto4'];

    foreach ($fotos as $value) {
        @unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/img/produto/" . $value);
    }

    $mysqli->query("DELETE FROM produto WHERE pro_cd_produto = '" . $ids . "' AND pro_cd_empresa = {$empresa['emp_cd_empresa']}") or die($mysqli->error);
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
                            <h4 class="mb-0">Lista de Produtos</h4>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">

                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th width="120">Imagem</th>
                                    <th>Produto</th>
                                    <th width="130">Vl Original</th>
                                    <th width="130">Vl Promocional</th>
                                    <th width="130">Status</th>
                                    <th width="130">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlProduto = $mysqli->query("SELECT * FROM produto WHERE pro_cd_empresa = {$empresa['emp_cd_empresa']} ORDER BY pro_nm_produto ASC");

                                if ($produto->num_rows > 0)
                                    while ($produto = $sqlProduto->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><img src="./assets/img/produto/<?php echo $produto['pro_ds_foto1'] ?>" class="rounded" width="80"></td>
                                        <td><?php echo $produto['pro_nm_produto']; ?></td>
                                        <td>R$ <?php echo str_replace(".", ",", $produto['pro_vl_precooriginal']); ?></td>
                                        <td>R$ <?php echo str_replace(".", ",", $produto['pro_vl_precopromocional']); ?></td>
                                        <td><span class="label text-<?php if ($produto['pro_st_status'] == 'ativo') {
                                                                        echo 'success';
                                                                    } else {
                                                                        echo 'danger';
                                                                    } ?>">
                                                <?php echo ($produto['pro_st_status'] == 'ativo') ? 'Ativo' : 'Inativo'; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <a href="conta/cadastrar_produto/<?php echo $produto['pro_cd_produto']; ?>">
                                                <i class="bi bi-pen btn btn-primary"></i></a>
                                            <a href="conta/listar_produtos/excluir/<?php echo $produto['pro_cd_produto']; ?>" onClick="return confirm('Tem certeza que deseja excluir este produto?');">
                                                <i class="bi bi-trash btn btn-danger ms-2"></i></a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'start.php'; ?>

<?php
$rota = (isset($_GET['url'])) ? $_GET['url'] : 'home';
$rota = explode('/', $rota);
$permissao = array('home', 'login', 'cadastro', 'empresa', 'sair', 'conta', 'sobre', 'em_breve');
?>

<?php require_once 'header.php'; ?>
<?php require_once 'navbar.php'; ?>

<?php

if (count($rota) > 0) {
    //se for um diretorio
    if(is_dir("{$rota[0]}")){
        $pagina = (file_exists("{$rota[0]}/{$rota[1]}.php")) ? $rota[1] : 'erro';
        $id = @$rota[2];
        $ids = @$rota[3];
    }
    //se não for um diretório
    else{
        $pagina = (file_exists("{$rota[0]}.php")) && in_array($rota[0], $permissao) ? $rota[0] : 'erro';
        $id = @$rota[1];
        $ids = @$rota[2];
    }

    if (@$rota[0] == "home") {
        $cidade_selecionada = @$rota[3];
        $cd_cidadesordem = @$rota[4];
        $teste = "home";
    }
    else if(@$rota[0] == "cadastro"){
        //$id = "envia";
    }
    else if(@$rota[0] == "conta"){
        $pagina = 'conta/'.$pagina;
        chdir('conta');
        $teste = "perfil";
    }
    else if(@$rota[0] == "empresa"){
        $teste = "empresa";
    }

    include "{$pagina}.php";
}
?>   
    


<?php require_once 'footer.php'; ?>
<?php
session_unset();  //liberta todas as variaveis da sessao
session_destroy();  // destroi todos os dados registrados da sessao

unset($_SESSION['usu_cd_usuario']);

if (isset($_SESSION['usu_cd_usuario'])) {    // testa se a variavel $_session ainda existe se existir da erro
    echo "Erro ao tentar efetuar logoff !<br><br><a href='javascript:history.back(-1)'>Click Aqui para voltar</a>";
} else { // se a variacel $_session foi destruida ai deu logoff
    echo "<script language='JavaScript'>
              window.location = 'home';
          </script>";
}

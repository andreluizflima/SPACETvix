<?php
    // ========================================
    // gestão de utilizadores
    // ========================================

    // verificar a sessão
    if(!isset($_SESSION['a'])){
        exit();
    }
    
    //verificar permissão
    $erro_permissao = false;
    if(!funcoes::Permissao(0)){
        $erro_permissao = true;
    }



?>

<?php if($erro_permissao) : ?>
<?php include('inc/sem_permissao.php') ?>
<?php else : ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col card m-3 p-3">
        <h4 class="text-center">GESTÃO DE UTILIZADORES</h4>
        
        <a href="?a=inicio" class="btn btn-primary btn-size-150">Voltar</a>
        <a href="?a=utilizadores_adicionar" class="btn btn-primary btn-size-150">Novo utilizador...</a>

        </div>        
    </div>
</div>




<?php endif; ?>
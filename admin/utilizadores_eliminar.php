<?php
    // ========================================
    // gestão de utilizadores - eliminar utilizador
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

    //verifica se id_utilizador está definido
    $id_utilizador = -1;
    if(isset($_GET['id'])){
        $id_utilizador = $_GET['id'];
    } else {
        $erro_permissao = true;
    }

    //verifica se pode avançar (id_utilizador != 1 e != do da sessão)
    if($id_utilizador == 1 || $id_utilizador == $_SESSION['id_utilizador']){
        $erro_permissao = true;
    }

    // ==============================================================
    $dados_utilizador = null;
    $gestor = new cl_gestorBD();
    if(!$erro_permissao){
        //buscar os dados do utilizador
        $parametros = [':id_utilizador' => $id_utilizador];
        $dados_utilizador = $gestor->EXE_QUERY('SELECT * FROM utilizadores
                                                WHERE id_utilizador = :id_utilizador', $parametros);
    }
?>

<?php if($erro_permissao) : ?>
<?php include('inc/sem_permissao.php') ?>
<?php else : ?>

<div class="container">
    <div class="row">
        <div class="col card m-3 p-3">
            <h4 class="text-center">ELIMINAR UTILIZADOR</h4>            
        </div>        

        <!-- dados do utilizador -->
        <div class="row">
            <div class="col-xs-6 card">
                <p>Dados do utilizador</p>
            </div>
        </div>



    </div>

    


</div>

<?php endif; ?>
<?php
    // ========================================
    // gestão de utilizadores - editar utilizador
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
    $gestor = new cl_gestorBD();
    $dados_utilizador = null;  
   
    $erro = false;
    $sucesso = false;
    $mensagem = '';  
    
    if(!$erro_permissao){
        //buscar os dados do utilizador
        $parametros = [':id_utilizador' => $id_utilizador];
        $dados_utilizador = $gestor->EXE_QUERY('SELECT * FROM utilizadores 
                                                WHERE id_utilizador = :id_utilizador', $parametros);                                                
        //verifica se existem dados do utilizador
        if(count($dados_utilizador)==0){
            $erro = true;
            $mensagem = 'Não foram encontrados dados do utilizador.';
        }
    }    
?>

<!-- erro de permissão -->
<?php if($erro_permissao) : ?>
    <?php include('inc/sem_permissao.php') ?>
<?php else : ?>

    <!-- erro de falta de dados -->
    <?php if($erro) : ?>

        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-md-6 offset-md-3 text-center">
                    <p class="alert alert-danger"><?php echo $mensagem ?></p>
                    <a href="?a=utilizadores_gerir" class="btn btn-primary btn-size-100">Voltar</a>
                </div>
            </div>
        </div>

    <?php else : ?>

    <!-- sucesso na alteração dos dados -->
    <!-- apresenta uma mensagem de sucesso -->

    <!-- formulário com os dados para alteração -->
    <div class="container">
        <div class="row card mt-3 mb-3">
            <h4 class="text-center mt-4">EDITAR DADOS DO UTILIZADOR</h4>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="mt-3 mb-3">
                        <form action="?a=editar_utilizador&id=<?php echo $id_utilizador ?>" method="post">
                            <div class="form-group">
                                <label>Utilizador:</label>
                                <p><strong><?php echo $dados_utilizador[0]['utilizador'] ?></strong></p>




                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php endif; ?>

<?php endif; ?>
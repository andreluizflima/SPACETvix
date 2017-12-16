<?php

    // ========================================
    // formulário de login
    // ========================================    
    
    // verificar a sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $erro = false;
    $mensagem = '';


    // verificar se existe um POST
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $text_email = $_POST['text_email'];

        //criar o objeto da base de dados
        $gestor = new cl_gestorBD();

        //parametros
        $parametros = [
            ':email' => $text_email
        ];

        //pesquisar na bd para verificar se existe conta de utilizador com este email
        $dados = $gestor->EXE_QUERY('SELECT * FROM utilizadores WHERE email = :email',$parametros);

        //verificar se foi encontrado email
        if(count($dados) == 0){
            $erro = true;
            $mensagem = 'Não foi encontrada conta de utilizador com esse email.';
        }
        
        //no caso de não haver erro (foi encontrada conta de utilizador com o email indicado)
        else{

            //recuperar a password            
            $nova_password = funcoes::CriarCodigoAlfanumerico(15);

            //enviar o email
            $email = new emails();
            $mensagem_enviada = $email->EnviarEmailRecuperacaoPW($nova_password);



            //alterar a senha na bd
            if($mensagem_enviada){
                $id_utilizador = $dados[0]['id_utilizador'];

                $parametros = [
                    ':id_utilizador'    => $id_utilizador,
                    ':palavra_passe'    => md5($nova_password)
                ];

                $gestor->EXE_NON_QUERY(
                    'UPDATE utilizadores
                    SET palavra_passe = :palavra_passe
                    WHERE id_utilizador = :id_utilizador', $parametros);
            } else {
                echo 'Aconteceu um erro!';
            }
        }
    }





    /*
    - formulário que permite colocar um endereço de email
    - submeter o formulário e procurar o endereço de email na tabela dos utilizadores
    - se for encontrado um email, reformular a password e envia email para o usuário/utilizador
    - informa qual é a nova password
    */

?>

<?php if($erro): ?>
    <div class="alert alert-danger text-center">
        <?php echo $mensagem ?>
    </div>
<?php endif; ?>

<div class="container-fluid">    
    <div class="row justify-content-center">
        <div class="col-md-4 card m-3 p-3">
           
            <form action="?a=recuperar_password" method="post">                
                <div class="text-center">
                <h3>Recuperar Password</h3>
                <p>Coloque aqui o seu endereço de email para recuperação da password.</p>
                </div>
                <div class="form-group">
                    <input type="email" name="text_email" class="form-control" placeholder="email" required>
                </div>                
                <div class="form-group text-center">
                    <a href="?a=inicio" class="btn btn-primary btn-size-150">Cancelar</a>
                    <button role="submit" class="btn btn-primary btn-size-150">Recuperar</button>
                </div>
            </form>            
        </div>        
    </div>
</div>
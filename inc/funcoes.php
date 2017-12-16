<?php 
    // ========================================
    // funçõe estáticas
    // ========================================

    // verificar a sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    // ===========================================================
    class funcoes{

        // =======================================================
        public static function VerificarLogin(){
            //verifica se o utilizador tem sessão ativa
            $resultado = false;
            if(isset($_SESSION['id_utilizador'])){
                $resultado = true;
            }
            return $resultado;
        }

        // =======================================================
        public static function IniciarSessao($dados){
            //iniciar a sessão
            $_SESSION['id_utilizador'] = $dados[0]['id_utilizador'];
            $_SESSION['nome'] = $dados[0]['nome'];
        }

        // =======================================================
        public static function DestroiSessao(){
            //destroi as variáveis da sessão
            unset($_SESSION['id_utilizador']);
            unset($_SESSION['nome']);
        }

        // =======================================================
        public static function CriarCodigoAlfanumerico($numChars){
            //cria um código aleatório alfanumérico
            $codigo='';
            $caracteres = 'abcdefghijklmnoprstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ0123456789!?()-%';
            for($i = 0; $i < $numChars; $i++){
                $codigo .= substr($caracteres, rand(0,strlen($caracteres)) , 1 );
            }
            return $codigo;
        }
    }

?>
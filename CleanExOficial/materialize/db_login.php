 <!--   Cabeçalho   -->
 <?php include("inc_header.php"); ?>

 <?php

    //Verificar se o cookie foi setado
    if (isset($_COOKIE["email"])) {
        $_SESSION["email"] = $_COOKIE["email"];
        $_SESSION["nome"] = $_COOKIE["nome"];
    }

    //Se o usuario estiver logado, vai para a home
    if (isset($_SESSION["email"])) {
        header("Location: carrinho.php");
    }

    //Limpeza dos caracteres especiais;
    $usuario = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (($usuario) && ($senha)) {

        require_once("db_conectar.php");

        $sql = "SELECT * FROM usuarios";
        $stmt = $conexao->prepare($sql);

        if ($stmt->execute()) {
            $db = $stmt->fetchall(PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($db as $usuarios) {
                    $usuario_valido = $usuario === $usuarios["email"];
                    $senha_valida = password_verify($senha, $usuarios["senha"]);

                    if (($usuario_valido) && ($senha_valida)) {

                        $_SESSION["erros"] = null;
                        $_SESSION["nome"] = $usuarios["nome"];
                        $_SESSION["email"] = $usuarios["email"];

                        //Expiração do cookie em 30 dias
                        $expiracao_cookie = time() + 86400 * 30;
                        
                        session_name('login');
                        session_start();

                        //Setar o cookie
                        setcookie("email", $usuarios["email"], $expiracao_cookie);
                        setcookie("nome", $usuarios["nome"], $expiracao_cookie);

                        //Redireciona para a home
                        header("Location: carrinho.php");
                    }
                }
                //Se tiver erros adiciona no array de erros
                if (!isset($_SESSION["email"])) {
                    $_SESSION["erros"] = "Usuario ou senha invalido";
                }
            }
        } else {
            echo "Erro: " . $stmt->errorCode();
        }
    }
    ?>

 <div class="section center container">

     <?php
        //Exibe os erros
        if (isset($_SESSION["erros"])) {

            echo $_SESSION["erros"];
            //Limpa os erros apos exibir os mesmos
            $_SESSION["erros"] = null;
        }
        ?>
     <div class="container">
         <form action="db_login.php" method="post">
             <div class="row">
                 <div class="input-field col s12 m4 l6">
                     <input name="email" id="email" type="text" class="validate" required>
                     <label for="usuario">Usuário</label>
                 </div>
             </div>
             <div class="row">
                 <div class="input-field col s12 m4 l6">
                     <input name="senha" id="password" type="password" class="validate" required>
                     <label for="password">Senha</label>
                 </div>
             </div>
             <div class="row">
                 <div class="col s12 m4 l6">
                     <button class="btn waves-effect waves-light left" type="submit" name="action" value="enviar">Submit
                         <i class="material-icons right">send</i>
                     </button>
                 </div>
             </div>
     </div>
 </div>
 </form>


 <!--  Rodape-->
 <?php include("inc_rodape.php"); ?>

 <!--  Scripts-->
 <?php include("inc_scripts.php"); ?>
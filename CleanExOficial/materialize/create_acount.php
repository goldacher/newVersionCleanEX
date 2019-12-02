  <!--   Cabeçalho   -->
  <?php include("inc_header.php");
  require("db_mz_funcoes.php");
  require("db_conectar.php");
  ?>

  <br>
  <form action="create_acount.php" method="post">
    <div class="container">
      <label for="Nome">Nome</label>
      <input name="nome" type="text" class="validate" />

      <label for="endereco">Endereco</label>
      <input name="endereco" type="text" class="validate" />

      <label for="cpf">CPF/CNPJ</label>
      <input name="cpf" type="text" class="validate" />

      <label for="senha">Senha</label>
      <input name="senha" type="password" class="validate" />

      <label for="email">Email:</label>
      <input name="email" type="email" class="validate" />

      <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
        <i class="material-icons right">send</i>
      </button>
    </div>
  </form>
  <br>

<?php
  $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $endereco = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) ;

  if (($nome) && ($endereco) && ($cpf) && ($senha) && ($email)) {
  require("db_conectar.php");
  $sql = "INSERT INTO usuarios (cod, nome, end, cpf, senha, email) VALUES (NULL, :nome, :end, :cpf, :senha, :email);";
  $stmt = $conexao->prepare($sql);
  $stmt->bindValue(':nome', $nome);
  $stmt->bindValue(':end', $endereco);
  $stmt->bindValue(':cpf', $cpf);
  $stmt->bindValue(':email', $email);

  $senha = password_hash($senha,PASSWORD_DEFAULT);

  $stmt->bindValue(':senha', $senha);

  if ($stmt->execute()) {

    echo "<script>alert('Usuário adicionado com sucesso..!')</script>";
    echo "<script>window.location = 'login.php'</script>";
  
} else {
  echo "Erro: " . $stmt->errorCode();
  }
}
?>

  <!--  Rodape-->
  <?php include("inc_rodape.php"); ?>
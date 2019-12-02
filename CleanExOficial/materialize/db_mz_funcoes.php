<?php function exibir_card($cod, $local_img, $nome, $preco, $descricao)
{ ?>
  <div class="col s12 m6 l4">
    <div class="card">
      <div class="card-image">
        <?php echo " <a href=detalhes.php?cod=$cod>"; ?>
        <img src="images/<?= $local_img ?>.jpg">
        </a>
        </a>
      </div>
      <div class="card-content">
        <h4 style="color: purple"><?= $nome ?></h4>
        <h5 style="color: gold">R$ <?= $preco ?>,00</h5>
        <p style="color: purple"><?= $descricao ?></p>
      </div>
      <form action="index.php" method="post">
        <div class="card-action">
          <button class="btn waves-effect waves-light" type="submit" name="add">Comprar
            <i class="material-icons right">add_shopping_cart</i>
          </button>
          <input type='hidden' name='product_id' value=<?= $cod ?>>
        </div>
      </form>
    </div>
  </div>
<?php } ?>

<?php
function cards_principal()
{
  require("db_conectar.php");

  $cat = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);

  if ($cat >= 1) {
    $sql = "SELECT * FROM produtos WHERE categoria = :cat LIMIT :qtd OFFSET :ini";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cat', $cat, PDO::PARAM_INT);
  } else {
    $sql = "SELECT * FROM produtos LIMIT :qtd OFFSET :ini";
    $stmt = $conexao->prepare($sql);
  }
  $stmt->bindValue(':qtd', 100, PDO::PARAM_INT);
  $stmt->bindValue(':ini', 0, PDO::PARAM_INT);

  if ($stmt->execute()) {
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="container">';
    foreach ($resultado as $campo) {
      exibir_card($campo['cod'], $campo['local_img'], $campo['nome'], $campo['preco'], $campo['descricao']);
    }
    echo "</div>";
  } else {
    echo "Erro na consulta: " . $stmt->errorCode();
  }

  $conexao = null; // fechar conexão;
  $stmt = null;
  $resultado = null;
}
function html_select_categoria($valor_padrao)
{
  require("db_conectar.php");
  $sql = "SELECT * FROM categoria LIMIT :qtd OFFSET :ini";
  $stmt = $conexao->prepare($sql);
  $stmt->bindValue(':qtd', 10, PDO::PARAM_INT);
  $stmt->bindValue(':ini', 0, PDO::PARAM_INT);

  if ($stmt->execute()) {
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<select name=\"categoria\">";
    echo "<option value=\"\">Selecionar</option>";
    foreach ($resultado as $campo) {
      $cod = $campo['cod'];
      $categoria = $campo['categoria'];
      if ($cod == $valor_padrao) {
        echo "<option value=\"$cod\" selected>$categoria</option>";
      } else {
        echo "<option value=\"$cod\">$categoria</option>";
      }
    }
    echo "</select>";
  } else {
    echo "Erro na consulta: " . $stmt->errorCode();
  }

  //$conexao=null; // fechar conexão; 
  $stmt = null;
  $resultado = null;
}

//add para o login
function validar_sessao()
{
  if (isset($_COOKIE["email"])) {
    $_SESSION["email"] = $_COOKIE["email"];
    $_SESSION["nome"] = $_COOKIE["nome"];
  }
  if (!isset($_SESSION["email"])) {
    $_SESSION["erros"] = "Favor efetuar o login";
    echo    "<script>
            document.location=\"db_login.php\";
        </script>";
    exit;
  }
}

//Exibir o usuario logado
function usuario_logado()
{
  if (isset($_COOKIE["email"])) {
    $_SESSION["email"] = $_COOKIE["email"];
    $_SESSION["nome"] = $_COOKIE["nome"];
  }
  if (isset($_SESSION["email"])) {
    echo "<h3>Usuario: " . $_SESSION["nome"];
    echo " (<a href=db_logout.php>Sair</a>)</h3>";
  }
}
?>
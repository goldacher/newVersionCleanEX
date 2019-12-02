<?php
require("inc_header.php");
require("db_conectar.php"); ?>

<?php

$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);

if ($cod) {
  $sql = "SELECT * FROM produtos WHERE cod = :cod LIMIT :qtd OFFSET :ini";
  $stmt = $conexao->prepare($sql);
  $stmt->bindValue(':cod', $cod, PDO::PARAM_INT);
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
    exibir_detalha($campo['cod'], $campo['local_img'], $campo['nome'], $campo['preco'], $campo['descricao']);
  }
  echo "</div>";
} else {
  echo "Erro na consulta: " . $stmt->errorCode();
}

$conexao = null; // fechar conexão;
$stmt = null;
$resultado = null;

?>

<?php function exibir_detalha($cod, $local_img, $nome, $preco, $descricao)
{ ?>

<img src="images/<?= $local_img ?>.jpg" width="400"px height="400"px>

  <p style="font-size: 30px;color:purple;"><i><b><?= $nome ?></b></i></p>
  <p style="font-size: 30px;color:gold;"><i><b><?= "R$" .  $preco . ",00" ?></b></i></p>

  <ul>
    <li style="font-size: 30px;color:purple;"><i><b><?= $descricao ?></b></i></p></li>
  </ul>

  <form action="index.php" method="post">
    <div class="card-action">
      <button class="btn waves-effect waves-light" type="submit" name="add">Comprar
        <i class="material-icons right">add_shopping_cart</i>
      </button>
      <input type='hidden' name='product_id' value=<?= $cod ?>>
    </div>
  </form>

<?php } ?>

<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
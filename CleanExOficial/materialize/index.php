<!--   Cabeçalho   -->
<?php
require("inc_header.php");
require("db_conectar.php");
require("db_mz_funcoes.php");
session_start();


if (isset($_POST['add'])) {
  if (isset($_SESSION['cart'])) {

    $item_array_id = array_column($_SESSION['cart'], "product_id");

    if (in_array($_POST['product_id'], $item_array_id)) {
      echo "<script>alert('O produto já foi adicionado..!')</script>";
      echo "<script>window.location = 'index.php'</script>";
    } else {

      $count = count($_SESSION['cart']);
      $item_array = array(
        'product_id' => $_POST['product_id']
      );

      $_SESSION['cart'][$count] = $item_array;

      echo "<script>alert('Produto adicionado com sucesso..!')</script>";
      echo "<script>window.location = 'index.php'</script>";
    }
  } else {

    $item_array = array(
      'product_id' => $_POST['product_id']
    );

    $_SESSION['cart'][0] = $item_array;
    print_r($_SESSION['cart']);
  }
}


?>

<div class="container">
  <div class="row">
    <div class="col s12 m3">
      <aside>
        <div class="collection">
          <?php
          include("db_mz_menulateral.php");
          ?>
        </div>
      </aside>
    </div>
    <div class="col s12 m9">
      <section>
        <?php cards_principal(); ?>
      </section>
    </div>
  </div>
</div>


<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
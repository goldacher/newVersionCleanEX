<?php
require("inc_header.php");
require("db_mz_funcoes.php");

session_start();

validar_sessao();

require_once("CreateDb.php");
require_once("component.php");

$db = new CreateDb("cleanex", "produtos");

if (isset($_POST['remove'])) {
  if ($_GET['action'] == 'remove') {
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value["product_id"] == $_GET['id']) {
        unset($_SESSION['cart'][$key]);
        echo "<script>alert('Produto removido com sucesso...!')</script>";
        echo "<script>window.location = 'carrinho.php'</script>";
      }
    }
  }
}


?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cart</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">


  <div class="container-fluid">
    <div class="row px-5">
      <div class="col-md-7">
        <div class="shopping-cart">
          <hr>

          <?php

          $total = 0;
          if (isset($_SESSION['cart'])) {
            $product_id = array_column($_SESSION['cart'], 'product_id');

            $result = $db->getData();
            while ($row = mysqli_fetch_assoc($result)) {
              foreach ($product_id as $id) {
                if ($row['cod'] == $id) {
                  cartElement($row['local_img'], $row['nome'], $row['preco'], $row['cod']);
                  $total = $total + (int) $row['preco'];
                }
              }
            }
          } else {
            echo "<h5>Carrinho Vazio</h5>";
          }

          ?>

        </div>
      </div>
      <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

        <div class="pt-4">
          <h6>DETALHES DA COMPRA</h6>
          <hr>
          <div class="row price-details">
            <div class="col-md-6">
              <?php
              if (isset($_SESSION['cart'])) {
                $count  = count($_SESSION['cart']);
                echo "<h6>Preço ($count itens)</h6>";
              } else {
                echo "<h6>Preço (0 itens)</h6>";
              }
              ?>
              <h6>Frete</h6>
              <hr>
              <h6>Total</h6>
            </div>
            <div class="col-md-6">
              <h6>R$<?php echo $total; ?></h6>
              <h6 class="text-success">Gratuito</h6>
              <hr>
              <h6>R$<?php
                    echo $total;
                    ?></h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>


<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
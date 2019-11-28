<style>
  .carrinho {
    position: absolute;
    /*right: Npx; depende da imagem ela pode estar tocando no seu texto*/
    bottom: 15px;
    height: 30px;
    width: 30px;
    line-height: 10px;
  }
</style>

<header>
  <div id="navbar" class="navbar-fixed scrollspy">

    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="desinfetantes.php">Desinfetantes</a></li>
      <li><a href="cozinha.php">Cozinha</a></li>
      <li class="divider"></li>
      <li><a href="banheiro.php">Banheiro</a></li>
    </ul>
    
    <nav class="white">
      <div class="nav-wrapper container">
        <div class="nav-wrapper">
          <div class="container"> <a href="index.php" class="brand-logo"><img src="./Cleanex_Logo.png" /></a></div>
          <a href="index.php" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
          <ul class="right hide-on-med-and-down">

            <li><a class="head-link" href="sobre.php" id="sobre" onclick="functionSobre()">Sobre</a></li>
            <li><a class="head-link" href="contato.php" id="contato" onclick="functionContato()">Contato</a></li>
            <li><a class="head-link" href="login.php" id="login" onclick="functionLogin()">Login</a></li>

            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1" class="material-icons right">Categorias</a></li>

            <li><a class="head-link" href="carrinho.php" id="carrinho" onclick="functionCarrinho()">Minhas Compras<img class="carrinho" src="images/carrinho.png"></a></li>

        </div>
        </ul>
        <ul class="right side-nav" id="mobile-demo">
          <li><a class="head-link" href="sobre.php" id="products" onclick="functionSobre()">Sobre</a></li>
          <li><a class="head-link" href="contato.php" id="contato" onclick="functionContato()">Contato</a></li>
          <li><a class="head-link" href="login.php" id="login" onclick="functionLogin()">Login</a></li>
        </ul>
      </div>
    </nav>
  </div>
</header>

<!-- JavaScript no final do body para otimizar o carregamento -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js">
</script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<script>
  $(document).ready(function() {
    $('.dropdown-trigger').dropdown({
      hover: false
    });

  });
</script>
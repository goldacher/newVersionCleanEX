    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="shortcut icon" href="images/favicon (8).ico" type="image/x-icon">
    <link rel="icon" href="images/favicon (8).ico" type="image/x-icon">

    <!--   Materialize   -->
    <?php include("inc_materialize.php"); ?>

    <style>
        .carrinho {
            position: right;
            /*right: Npx; depende da imagem ela pode estar tocando no seu texto*/
            bottom: 15px;
            height: 30px;
            width: 30px;
            line-height: 2px;
        }
    </style>

    <header>
        <div id="navbar" class="navbar-fixed scrollspy">

            <nav class="white">
                <div class="nav-wrapper container">
                    <div class="container"> <a href="index.php" class="brand-logo"><img src="./Cleanex_Logo.png" /></a></div>
                    <ul class="right hide-on-med-and-down">
                    
                        <li><a class="head-link, deep-purple-text" href="db_incluir_produtos.php" id="castrar" >Cadastrar</a></li>
                        <li><a class="head-link, deep-purple-text" href="sobre.php" id="sobre">Sobre</a></li>
                        <li><a class="head-link, deep-purple-text" href="contato.php" id="contato">Contato</a></li>
                        <li><a class="head-link, deep-purple-text" href="login.php" id="login" >Login</a></li>
                        <li><a class="head-link, deep-purple-text" href="carrinho.php" id="carrinho">Minhas Compras<img class="carrinho" src="carrinho.jpg"></a></li>
                    </ul>
                </div>
            </nav>
    </header>

    <!-- Menu Mobile -->
    <ul id="mobile-navbar" class="sidenav">
        <li><a class="head-link" href="sobre.php" id="products" onclick="functionSobre()">Sobre</a></li>
        <li><a class="head-link" href="contato.php" id="contato" onclick="functionContato()">Contato</a></li>
        <li><a class="head-link" href="login.php" id="login" onclick="functionLogin()">Login</a></li>
    </ul>

    <!-- JavaScript no final do body para otimizar o carregamento -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>
    <script type="text/javascript" src="js/materialize.min.js"></script>


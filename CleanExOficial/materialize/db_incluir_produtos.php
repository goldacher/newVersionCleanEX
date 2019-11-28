<!--   Cabeçalho   -->
<?php
require("inc_header.php");
require("db_mz_funcoes.php");
require("db_conectar.php");
?>

<form action="db_incluir_produtos.php" method="post" class="container">
    <div class="input-field col s12 l6">
        Nome<input type="text" name="nome" required>
    </div>
    <div class="input-field col s12 l6">
        Preço<input type="text" name="preco" required>
    </div>
    <div class="input-field col s12 l6">
        Categoria<input type="text" name="categoria" required>
    </div>
    <div class="input-field col s12 l6">
        Nome da Imagem<input type="text" name="local_img" required>
    </div>
    <div class="input-field col s12 l6">
        Descrição<input type="text" name="descricao" required>
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
        <i class="material-icons right">send</i>
    </button>
</form><br>

<?php
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_NUMBER_INT);
$local_img = filter_input(INPUT_POST, "local_img");
$descricao = filter_input(INPUT_POST, "descricao");

if (($nome) && ($preco) && ($categoria) && ($local_img) && ($descricao)) {
    require("db_conectar.php");
    $sql = "INSERT INTO produtos (cod, nome, preco, categoria, local_img, descricao) VALUES (NULL, :nome, :preco, :categoria, :local_img, :descricao);";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':categoria', $categoria);
    $stmt->bindValue(':local_img', $local_img);
    $stmt->bindValue(':descricao', $descricao);
    if ($stmt->execute()) {
        echo "Registro inserido com sucesso!<br>";
        echo "<a href=index.php>Voltar</a>";
    } else {
        echo "Erro: " . $stmt->errorCode();
    }
}
?>


<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
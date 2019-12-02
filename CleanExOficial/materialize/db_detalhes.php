<?php
require("inc_header.php");
require_once("db_conectar.php");

$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);

if ($cod >= 1) {
    $sql = "SELECT * FROM produtos WHERE cod = :cod";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cod', $cod);
    if ($stmt->execute()) {
        $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($stmt->rowCount()) {
            foreach ($resultado as $campo) {
                echo 'Produto: ' . $campo['nome'] . '<br>';
                echo 'Preço: ' . $campo['preco'] . '<br>';
                echo 'Categoria: ' . $campo['categoria'] . '<br>';
                echo 'Nome da Img: ' . $campo['local_img']. '.jpg' . '<br>';
                echo 'Descricao: ' . $campo['descricao'] . '<br>';
            }
        } else {
            echo "<br>Registro nao encontrado!<br>";
        }
        echo '<a href="db_procurar.php">Exibir todos os resultados</a>';
    } else {
        echo "Erro: " . $stmt->errorCode();
    }
} else {
    echo "Codigo invalido";
}
?>

<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
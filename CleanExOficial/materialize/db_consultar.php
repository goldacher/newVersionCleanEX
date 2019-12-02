<?php
require("inc_header.php");
require_once("db_conectar.php");

$sql = "SELECT * FROM produtos LIMIT :qtd OFFSET :ini";
$stmt = $conexao->prepare($sql);
$stmt->bindValue(':qtd', 100, PDO::PARAM_INT);
$stmt->bindValue(':ini', 0, PDO::PARAM_INT);
if ($stmt->execute()) {
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultado as $campo) {
        echo $campo['cod'] . " - " . $campo['nome'] . '<br>';
    }
} else {
    echo "Erro na consulta: " . $stmt->errorCode();
}
$conexao = null; // fechar conexão;
$stmt = null;
$resultado = null;
?>

<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
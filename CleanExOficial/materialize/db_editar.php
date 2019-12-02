<!-- Exibir mensagem em javascript -->
<script>
    function mensagem(texto) {
        alert(texto);
        locategoriaion.href = 'db_completo.php';
    }
</script>

<?php
require("inc_header.php");
require_once("db_conectar.php");
require("db_mz_funcoes.php");

// Recebe o cod por GET e exibe o formulario;
$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);

if (($cod >= 1) && (isset($cod))) {
    //Localizar registro no bd com base no codigo
    $sql = "SELECT * FROM produtos WHERE cod = :cod";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cod', $cod);

    if ($stmt->execute()) {
        //Cria o formulario de edição de registros baseado no bd.
        $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($stmt->rowCount()) {
            foreach ($resultado as $campo) {
                $cod = $campo['cod'];
                $nome = $campo['nome'];
                $preco = $campo['preco'];
                $categoria = $campo['categoria'];
                $local_img = $campo['local_img'];
                $descricao = $campo['descricao'];
                ?>

                <form action="db_editar.php" method="post">
                    <input type="hidden" name="cod" value="<?= $cod ?>">
                    Nome: <input type="text" name="nome" value="<?= $nome ?>"><br>
                    Preço: <input type="text" name="preco" value="<?= $preco ?>"><br>
                    Cat: <?php html_select_categoria($categoria); ?><br>
                    Local Img: <input type="text" name="local_img" value="<?= $local_img ?>"><br>
                    Descricao: <input type="text" name="descricao" value="<?= $descricao ?>"><br>
                    <input type="submit" value="Atualizar" name="Atualizar">
                </form>
            <?php
                        }
                    } else {
                        echo "<br>Registro nao encontrado!<br>";
                    }
                    echo '<a href="db_completo.php">Exibir todos os resultados</a>';
                } else {
                    echo "Erro: " . $stmt->errorCode();
                }
            } else {
                //Recever os valores por POST e realizar a atualização do registro
                $cod = filter_input(INPUT_POST, "cod", FILTER_SANITIZE_NUMBER_INT);
                $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_INT);
                $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_NUMBER_INT);
                $local_img = filter_input(INPUT_POST, "local_img", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (($nome) && ($preco) && ($categoria) && ($local_img) && ($descricao) && ($cod)) {
                    require("db_conectar.php");
                    $sql = "UPDATE usuarios SET nome = :nome, preco = :preco, categoria = :categoria, local_img = :local_img, descricao = :descricao, WHERE cod = :cod";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bindValue(':cod', $cod);
                    $stmt->bindValue(':nome', $nome);
                    $stmt->bindValue(':preco', $preco);
                    $stmt->bindValue(':categoria', $categoria);
                    $stmt->bindValue(':local_img', $local_img);
                    $stmt->bindValue(':descricao', $descricao);
                    if ($stmt->execute()) {
                        ?>
            <script>
                mensagem("Registro editado com sucesso!");
            </script>
        <?php
                } else {
                    ?>
            <script>
                mensagem("Erro ao editar o registro!");
            </script>
<?php
        }
    }
}
?>

<!--  Rodape-->
<?php include("inc_rodape.php"); ?>

<!--  Scripts-->
<?php include("inc_scripts.php"); ?>
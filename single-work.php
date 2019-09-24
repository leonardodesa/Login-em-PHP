<?php
// session_start();
require_once("security.php");
?>

<?php require_once('connection-database.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SingleWork</title>
    <meta charset="UTF-8">
    <meta name="description" content="Maqina portfolio">
    <meta name="keywords" content="photography, portfolio, onepage, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <?php

    $codPortfolio = $_GET['portfolio'];
    $sql = "SELECT * from thumbs WHERE codigo = '$codPortfolio'";
    $result = $db_connect->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result-> fetch_assoc()){
            $codigo = $row['codigo'];
            $nome = $row['nome'];
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $categoria = $row['categoria'];
        }
    } else {
        echo "Não há nenhum portfolio disponível";
    }
    ?>

    <?php if ($nome != NULL) { ?>

        <h1><?php echo $codigo; ?></h1>
        <h2><?php echo $nome; ?></h2>
        <h3><?php echo $titulo; ?></h3>
        <h4><?php echo $descricao; ?></h4>
    <?php } else {
        echo "Não há nenhum portfolio disponível";
    } ?>

    <!-- FOOTER -->
    <?php include "footer.php"; ?>
</body>
</html>

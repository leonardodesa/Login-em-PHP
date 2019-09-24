<?php require_once("connection-database.php"); ?>

<?php
if (isset( $_GET["codigo"])) {
  $codigo = $_GET['codigo'];
  $email_codigo = base64_decode($codigo);

  $selecionar = "SELECT * ";
  $selecionar .= "FROM codigos ";
  $selecionar .= "WHERE codigo = '$codigo' ";
  $selecionar .= "AND data > NOW()";
  $acesso = mysqli_query($db_connect, $selecionar);

  if ($acesso->num_rows > 0){
    if (isset($_POST['password'])) {

      //Verifica se os campos estão preenchidos
      if ($_POST['password'] == "" || $_POST['confirm-password'] == ""){
        $ac[] = "Por favor preencha todos os campos corretamente.";
      }

      //Verifica se as duas senha são diferente
      if ($_POST['password'] != $_POST['confirm-password']){
        $ac[] = "As senhas são diferentes, preencha com a mesma senha.";
      }

      if (!isset($ac)) {
        $novasenha = $_POST['password'];
        $update = "UPDATE clientes SET senha = '$novasenha' WHERE email = '$email_codigo'";
        $operacao_update = mysqli_query($db_connect, $update);

        if (isset($operacao_update)) {
          $mudar = "DELETE FROM codigos WHERE codigo = '$codigo'";
          $operacao_remove = mysqli_query($db_connect, $mudar);
          if (isset($operacao_update)) {
            echo "A senha foi modificada com sucesso!";
          } else {
            echo "não foi deletado";
            // header("location:index.php");
          }
        } else {
          echo "erro na nova senha";
        }
      }
    }
  } else {
    $mensagem =  "<h1>Este link já expirou!</h1>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login V1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/login/forgot-password.css"> -->

</head>
<body>
  <?php if(!isset($mensagem)) { ?>
    <div class="container">
      <form role="form" action="" method="post" class="form-group" enctype="multipart/form-data">
        <label for="password">Nova senha</label>
        <input type="password" name="password" placeholder="New password" class="form-control" id="password" required/>
        <input type="password" name="confirm-password" placeholder="Confirm the password" class="form-control" id="confirm-password" required/>
        <button class="btn btn-block btn-danger btn-lg" id="send">change Password</button>
        <?php
        if (isset($ac)){ ?>
          <?php for($i=0;$i<count($ac);$i++){
            echo "<li>".$ac[$i];
          }
        }
        ?>
      </form>
    </div>
  <?php } else {
     echo $mensagem;
  }?>

  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

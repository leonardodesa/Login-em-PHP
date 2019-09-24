<?php require_once("connection-database.php"); ?>

<?php
if (isset( $_POST["name"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $name = $_POST['name'];

    $selectClients = "SELECT * ";
    $selectClients .= "FROM clientes ";
    $selectClients .= "WHERE email = '$email'";
    $acesso = mysqli_query($db_connect, $selectClients);

    //Verifica se os campos estão preenchidos
    if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['confirm-password'] == ""){
        $ac[] = "Por favor preencha todos os campos corretamente.";
    }
    //Verifica se ja existe o login
    if (mysqli_num_rows($acesso) > 0){
        $ac[] = "Esse e-mail já esta sendo usado por outro usuario.";
    }

    //Verifica se o e-mail esta correto
    if (!preg_match("/@./", $_POST['email'])){
        $ac[] = "E-mail invalido.";
    }

    //Verifica se as duas senha são diferente
    if ($_POST['password'] != $_POST['confirm-password']){
        $ac[] = "As senhas não são iguais.";
    }

    // verifica se não tem erro
    if (!isset($ac)){
        $inserir = "INSERT INTO clientes ";
        $inserir .= "(email, usuario, senha, nivel, nomecompleto) ";
        $inserir .= "VALUES ";
        $inserir .= "('$email', '$name', '$password', 'user', '$name')";
        $operacao_inserir = mysqli_query($db_connect, $inserir);

        if(!$operacao_inserir){
            die('falha ao banco');
        } else {
            $contaCriada[] = "Conta criada com sucesso";
        }
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
    <link rel="stylesheet" type="text/css" href="css/login/register.css">

</head>
<body>

    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="register.php" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input value="<?php if (isset( $_POST["name"])) {echo $_POST["name"];}; ?>" type="text" name="name" id="first_name" class="form-control input-sm" placeholder="Full Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input value="<?php if (isset( $_POST["email"])) {echo $_POST["email"];}; ?>" type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input value="<?php if (isset( $_POST["password"])) {echo $_POST["password"];}; ?>" type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input value="<?php if (isset( $_POST["confirm-password"])) {echo $_POST["confirm-password"];}; ?>" type="password" name="confirm-password" id="confirm-password" class="form-control input-sm" placeholder="Confirm password" required>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if (isset($ac)){ ?>
                                <?php for($i=0;$i<count($ac);$i++){
                                    echo "<li>".$ac[$i];
                                }
                            } else if(isset($contaCriada)){
                                echo "Conta criada com sucesso, faça login abaixo"; ?>
                                <input value="login" class="btn btn-info btn-block" onclick="window.location='login.php';">
                                <?php
                            }
                            if(!isset($contaCriada)) { ?>
                                <input type="submit" value="Register" class="btn btn-info btn-block">
                            <?php }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

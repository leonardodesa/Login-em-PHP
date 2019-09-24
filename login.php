<?php require_once("connection-database.php"); ?>

<?php
session_start();

if (isset( $_POST["username"])) {
    $usuario = $_POST["username"];
    $senha   = $_POST["password"];

    $login = "SELECT * ";
    $login .= "FROM clientes ";
    $login .= "WHERE email = '{$usuario}' and senha = '{$senha}'";

    $acesso = mysqli_query($db_connect, $login);

    if(!$acesso){
        die('falha ao banco');
    }

    $informacao = mysqli_fetch_assoc($acesso);

    if ( empty($informacao)) {
        $mensagem = "login sem sucesso.";
    } else {
        $_SESSION["user_portal"] = $informacao["clienteID"];
        $_SESSION["nivel"] = $informacao["nivel"];
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="img/login/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/login/util.css">
    <link rel="stylesheet" type="text/css" href="css/login/main.css">
    <!--===============================================================================================-->
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="img/login/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="login.php" method="post" >
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="username" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" action="index.php">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <a class="txt2">
                            <?php
                            if (isset($mensagem)) {
                                ?>
                                <p><?php echo $mensagem ?></p>
                                <?php echo "<br>";
                            }
                            ?>
                        </a>
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="forgot-password.php">
                            Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
    </script>

</body>
</html>

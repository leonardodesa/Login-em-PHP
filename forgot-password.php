<?php require_once("connection-database.php"); ?>
<?php
date_default_timezone_set("America/Sao_Paulo");
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// Usar as classes sem o namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>

<?php

if (isset( $_POST["email"])) {
   $email = $_POST["email"];

   if ($_POST['email'] == ""){
      $ac[] = "Por favor preencha o campo corretamente.";
   }

   // Validate email
   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

   } else {
      $ac[] = "E-mail invalido.";
   }

   $verificaEmail = "SELECT email ";
   $verificaEmail .= "FROM clientes ";
   $verificaEmail .= "WHERE email = '$email'";

   $acesso = mysqli_query($db_connect, $verificaEmail);
   $dado = $acesso->fetch_assoc();
   $total = $acesso->num_rows;

   if($total == 0 ) {
      $ac[] = "O e-mail informado não existe.";
   }

   if (empty($erro) && !isset($ac)) {
      $codigo = base64_encode($email);
      $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));

      $inserir = "INSERT INTO codigos SET codigo = '$codigo', data = '$data_expirar'";
      $inserir_banco = mysqli_query($db_connect, $inserir);

      if ($inserir_banco) {
         // Inserir Arquivos do PHPMailer

         // Criação do Objeto da Classe PHPMailer
         $mail = new PHPMailer(true);

         try {
            //Retire o comentário abaixo para soltar detalhes do envio
            // $mail->SMTPDebug = 2;

            // Usar SMTP para o envio
            $mail->isSMTP();

            // Detalhes do servidor (No nosso exemplo é o Google)
            $mail->Host = 'smtp.gmail.com';

            // Permitir autenticação SMTP
            $mail->SMTPAuth = true;
            // nome de usuario
            $mail->Username = 'leo10.saaa@gmail.com';
            // Senha do E-mail
            $mail->Password = 'Retoohspw123@';
            // Tipo de protocolo de segurança
            $mail->SMTPSecure = 'tls';

            // Porta de conexão com o servidor
            $mail->Port = 587;

            // Garantir a autenticação com o Google
            $mail->SMTPOptions = array(
               'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
               )
            );

            // Remetente
            $mail->setFrom($email, 'Nome');

            // Destinatário
            $mail->addAddress($email, 'maqina.media');

            // Conteúdo

            // Define conteúdo como HTML
            $mail->isHTML(true);

            // Assunto
            $mail->Subject = 'Insira o assunto';
            $mail->Body    = "<p>Recebemos uma tentativa de recuperação de senha para esse e-mail,
            caso não tenha sido você desconsidere esse e-mail,
            caso contrario clique no link abaixo <br/>
            <a href=http://localhost/LeositeMaqina/siteMaqina/siteMaqina/recuperar.php?codigo=$codigo>recuperar Senha</a></p>";
            $mail->AltBody = 'Formato alternativo em texto puro para emails que não aceitam HTML';

            // Enviar E-mail
            $mail->send();
            echo 'Mensagem enviada com sucesso';
         } catch (Exception $e) {
            echo 'A mensagem não foi enviada pelo seguinte motivo: ', $mail->ErrorInfo;
         }
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
   <!-- <link rel="stylesheet" type="text/css" href="css/login/forgot-password.css"> -->

</head>
<body>

   <div class="container">
      <form role="form" action="forgot-password.php" method="post" class="form-group" enctype="multipart/form-data" for="email">
         <label for="password">Email</label>
         <input value="<?php if (isset( $_POST["email"])) {echo $_POST["email"];}; ?>" type="email" name="email" placeholder="Enter your email to retrieve the password" class="form-control" id="email" required name=email/>
         <?php
         if (isset($ac)){ ?>
            <?php for($i=0;$i<count($ac);$i++){
               echo "<li>".$ac[$i];
            }
         }
         ?>
         <button class="btn btn-block btn-danger btn-lg" id="send">Send Password</button>
      </form>

   </div>

   <!--===============================================================================================-->
   <script src="vendor/jquery/jquery.js"></script>
   <!--===============================================================================================-->
   <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

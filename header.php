<?php require_once("connection-database.php"); ?>
<?php require_once("security.php"); ?>

<?php
if(isset($_SESSION["user_portal"])){
    $user = $_SESSION["user_portal"];

    $saudacao = "SELECT nomecompleto ";
    $saudacao .= "FROM clientes ";
    $saudacao .= "WHERE clienteID = {$user}";

    $saudacao_login = mysqli_query($db_connect, $saudacao);

    if (!$saudacao_login) {
        die('falha no banco');
    }

    $saudacao_login = mysqli_fetch_assoc($saudacao_login);
    $nome = $saudacao_login['nomecompleto'];

    ?>
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To the Maqina <?php echo $nome ?> !</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
            </div>
        </div>
    </header>
    <?php
}
?>

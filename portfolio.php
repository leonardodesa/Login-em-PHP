<?php
require_once("security.php");
$tipoUser = $_SESSION['nivel'];
?>

<?php require_once("connection-database.php"); ?>

<section id="portfolio">
    <div id="portfolio" class="text-center paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>My Portfolio</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="portfolio-list">
                        <ul class="nav list-unstyled" id="portfolio-flters">
                            <li class="filter filter-active" data-filter=".all">all</li>
                            <li class="filter" data-filter=".design">DESIGN</li>
                            <li class="filter" data-filter=".motion">HTML MOTION</li>
                            <?php
                            if ($tipoUser == 'admin') { ?>
                                <li class="filter" data-filter=".rich-media">RICH FORMATS</li>
                            <?php }
                            ?>
                            <li class="filter" data-filter=".video">VIDEO</li>
                        </ul>

                    </div>

                    <div class="portfolio-container">

                        <?php
                        $thumbs = "SELECT * ";
                        $thumbs .= "FROM thumbs";

                        $acesso = mysqli_query($db_connect, $thumbs);

                        if ($acesso -> num_rows > 0) {
                            while($row = $acesso->fetch_assoc()) { ?>

                                <div class="col-lg-4 col-md-6 portfolio-thumbnail all <?php echo $row['categoria']; ?> branding uikits webdesign">
                                    <a href="single-work.php?portfolio=<?php echo $row['codigo']; ?>">
                                        <img src="img/portfolio/<?php echo $row['codigo']; ?>.jpg" alt="<?php echo $row['nome']; ?>">
                                    </a>
                                </div>

                            <?php }
                        } else {
                            echo "Não há trabalhos disponiveis ";
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

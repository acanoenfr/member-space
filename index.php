<?php

    $title = "Accueil";

    // Include de l'entête du fichier
    require "includes/head.inc.php";

    $home = $auth ? "Tableau de bord" : "Accueil";

?>

    <div class="container">
        <h1><?= $home ?></h1>
        <hr>
        <?php
            include "includes/flash.inc.php";
        ?>
        <?php if ($auth) { ?>
            <p class="lead">- En cours de création</p>
        <?php } else { ?>
            <p class="lead">Connectez-vous à compte !</p>
        <?php } ?>
    </div>

<?php

    // Include du pied de page
    require "includes/foot.inc.php";

?>

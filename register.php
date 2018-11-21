<?php

    $title = "Inscription";

    // Include de l'entête du fichier
    require "includes/head.inc.php";

?>

    <div class="container">
        <h1>Inscription</h1>
        <hr>
        <?php
            include "includes/flash.inc.php";
        ?>
        <form method="POST" action="process/register.php">
            <div class="form-group">
                <label for="username">Nom d'utlisateur</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Mot de paase</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirmed">Confirmation du mot de paase</label>
                <input type="password" name="confirmed" id="confirmed" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>

<?php

    // Include du pied de page
    require "includes/foot.inc.php";

?>

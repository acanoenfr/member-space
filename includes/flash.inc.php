<?php

    if (array_key_exists("flash", $_SESSION)) {

        ?>
        
            <div class="alert alert-<?= $_SESSION["flash"][0] ?>">
                <p class="lead"><?= $_SESSION["flash"][1] ?></p>
            </div>
        
        <?php

        unset($_SESSION["flash"]);
    }

?>

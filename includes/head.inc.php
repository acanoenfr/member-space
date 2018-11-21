<?php

    // On intialise un cookie de session
    session_start();

    // Include de functions.php
    require "functions.php";

    $auth = isConnected();

?>

<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?= $title ?> - Membre</title>
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/main.css">
        </head>
        <body>
            <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
                <a class="navbar-brand" href="index.php">Espace membre</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav ml-auto">
                        <?php if ($auth) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Déconnexion</a>
                                </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Inscription</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>

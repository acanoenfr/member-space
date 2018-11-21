<?php

    // On intialise un cookie de session
    session_start();

    // Include de functions.php
    require "functions.php";

    $db = connect('localhost', 'membre', 'root', 'root', true);
    $sidreq = $db->prepare("UPDATE users SET sid = '' WHERE sid = \"{$_COOKIE['sid']}\"");
    $sidreq->execute();

    setcookie('sid', '', time() - 1);

    $_SESSION['flash'] = ["info", "Vous avez été déconnecté !"];
    header('Location: index.php');

?>

<?php

    // On intialise un cookie de session
    session_start();

    // Include de functions.php
    require "../functions.php";

    if (isset($_POST)) {

        $email = testData($_POST["email"]);
        $password = testData($_POST["password"]);

        if (!empty($email) && !empty($password)) {
            $db = connect('localhost', 'membre', 'root', 'root', true);
            $req = $db->prepare("SELECT id, username, email, password FROM users WHERE email = '{$email}' LIMIT 1");
            $req->execute();
            if ($req->rowCount() > 0) {
                $data = $req->fetch();
                if (password_verify($password, $data['password'])) {
                    $sid = "{$data['email']}-{$data['id']}";
                    $sid = md5($sid);
                    setcookie('sid', $sid, time() + 86400 * 30, '/membre');
                    $sidreq = $db->prepare("UPDATE users SET sid = \"{$sid}\" WHERE id = \"{$data['id']}\"");
                    $sidreq->execute();
                    $_SESSION['flash'] = ["success", "Bienvenue, {$data['username']} !"];
                    header('Location: ../index.php');
                } else {
                    $_SESSION['flash'] = ["danger", "Le mot de passe saisi est incorrect."];
                    header('Location: ../login.php');
                }
            } else {
                $_SESSION['flash'] = ["danger", "Ce compte n'existe pas."];
                header('Location: ../login.php');
            }
        } else {
            $_SESSION['flash'] = ["danger", "Tous les champs doivent être remplis."];
            header('Location: ../login.php');
        }

    }

?>

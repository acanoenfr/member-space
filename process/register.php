<?php

    // On intialise un cookie de session
    session_start();

    // Include de functions.php
    require "../functions.php";

    if (isset($_POST)) {

        $username = testData($_POST['username']);
        $email = testData($_POST['email']);
        $password = testData($_POST['password']);
        $confirmed = testData($_POST['confirmed']);

        if (!empty($username) && !empty($email) && !empty($password) && !empty($confirmed)) {
            if (strlen($username) <= 60) {
                if (strlen($email) <= 82) {
                    if (strlen($password) <= 8) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if ($password === $confirmed) {
                                $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
                                $db = connect('localhost', 'membre', 'root', 'root', true);
                                $req = $db->prepare("INSERT INTO users(username, email, password) VALUES ('{$username}', '{$email}', '{$hash}')");
                                $req->execute();
                                $_SESSION["flash"] = ["success", "Votre inscription a bien été prise en compte, vous pouvez désormais vous connecter."];
                                header('Location: ../index.php');
                            } else {
                                $_SESSION["flash"] = ["danger", "Le mot de passe doit être identique à la confirmation."];
                                header('Location: ../register.php');
                            }
                        } else {
                            $_SESSION["flash"] = ["danger", "Le format de l'email est incorrect."];
                            header('Location: ../register.php');
                        }
                    } else {
                        $_SESSION["flash"] = ["danger", "Le mot de passe doit être supérieur à 8 caractères."];
                        header('Location: ../register.php');
                    }
                } else {
                    $_SESSION["flash"] = ["danger", "L'email doit être inférieur à 82 caractères."];
                    header('Location: ../register.php');
                }
            } else {
                $_SESSION["flash"] = ["danger", "L'identifiant doit être inférieur à 60 caractères."];
                header('Location: ../register.php');
            }
        } else {
            $_SESSION["flash"] = ["danger", "Tous les champs doivent être remplis."];
            header('Location: ../register.php');
        }

    }

?>

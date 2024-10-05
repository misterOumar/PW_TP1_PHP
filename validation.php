<?php

if (isset($_POST['bt_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // verifier si les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {

        $file = './user.txt';

        $data_file = file_get_contents($file);

        $json_arr = json_decode($data_file, true);
        $user_found = false;

        foreach ($json_arr as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $user_found = true;
                break;
            }
        }

        if ($user_found) {


            //enregistrer l'email et le nom dans la session
            session_start();
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $user['name'];

            // redirection vers la page d'accueil
            header('Location: accueil.php');
            exit();
        } else {
            header('Location: login.php?error=erreur_2');
            exit();
            // mauvais email ou mot de passe
            echo 'Email ou mot de passe incorrect';
        }
    } else {
        // champs email ou mot de passe vides
        header('Location: login.php?error=erreur_1');
        exit();
    }
}

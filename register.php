<?php

if (isset($_POST['bt_register'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // recuperer les données du formulaire
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $form_valide = true;

    // Vérifier si tous les champs sont remplis
    if (empty($name) || empty($email) || empty($password)) {
        $form_valide = false;
        $error = "Tous les champs sont obligatoires.";
        // Rediriger vers la page d'inscription avec l'erreur
        header("Location: registration_error.html?error=$error");
        exit();
    }


    // Vérifier si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_valide = false;
        $error = "L'email est invalide.";
        header("Location: registration_error.html?error=$error");
        exit();
    }

    // Vérifier si le mot de passe vaut  au moins 8 caractères
    if (strlen($password) < 8) {
        $form_valide = false;
        $error = "Le mot de passe doit contenir au moins 8 caractères.";
        header("Location: registration_error.html?error=$error");
        exit();
    }

    if ($form_valide) {

        // Vérifier si l'email est déjà utilisé dans le fichier user.txt au format json

        $file = './user.txt';

        $data_file = file_get_contents($file);

        $json_arr = json_decode($data_file, true);
        $user_found = false;

        foreach ($json_arr as $user) {
            if ($user['email'] === $email) {
                $user_found = true;
                break;
            }
        }

        if ($user_found) {
            $error = "Cet email est déjà utilisé.";
            header("Location: registration_error.html?error=$error");
            exit();
        } else {

            // Hasher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Créer une nouvelle entrée dans le fichier user.txt en format json
            $file = './user.txt';

            $data_file = file_get_contents($file);

            $json_arr = json_decode($data_file, true);

            $json_arr[] = array(
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
            );

            $json_data = json_encode($json_arr);

            file_put_contents($file, $json_data);

            // Rediriger vers la page de connexion
            header("location: registration_success.html");
            exit();
        }
    }
}

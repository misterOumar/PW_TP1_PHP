<?php
//rediriger l'utilasteur sur la page de login s'il n'est pas dans la session
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
} else {
    // récupérer les informations de l'utilisateur connecté
    $user_email = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
}

$file = './user.txt';
$data_file = file_get_contents($file);
$liste_utilisateur = json_decode($data_file, true);

$nbre_utilisateur =  count($liste_utilisateur);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - TP1 PHP</title>
    <link rel="stylesheet" href="./style.css" />

</head>

<style>
    a.btn {
        color: #000000;
        width: 100%;
        display: block;
        padding: 1rem 2rem;
        font-family: "Courier New", Courier, monospace;
        text-align: center;
        text-decoration: none;
        margin-top: 2rem;
    }
</style>

<body>
    <div class="wrapper">
        <h1>
            Bonjour <?= $user_name; ?> 😊, vous êtes connecté!
        </h1>
        <p>
            Bienvenue sur la page d'accueil du TP1 PHP!

        </p>

        <h2>Liste des utilisateurs :  <?= $nbre_utilisateur; ?></h2>

        <table>
            <tr>
                <th>Nom complet</th>
                <th>Email</th>
            </tr>
            <?php foreach ($liste_utilisateur as $utilisateur) : ?>
                <tr>
                    <td><?= $utilisateur['name']; ?></td>
                    <td><?= $utilisateur['email']; ?></td>
                </tr>
            <?php endforeach; ?>

        </table>




        <a class="btn" href="logout.php">Se déconnecter</a>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TP1 PHP</title>

    <link rel="stylesheet" href="./style.css" />
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <form action="./validation.php" method="POST" autocomplete="off">
            <h1>Connexion</h1>

            <?php
            if (isset($_GET['error'])) {  ?>

                <div class="error-box">
                    <p class="error-message">
                        <?php
                        if ($_GET['error'] === 'erreur_1') {
                            echo "Veuillez saisir un login et un mot de passe";
                        } else if ($_GET['error'] === 'erreur_2') {
                            echo "Erreur de login/mot de passe";
                        } else {
                            echo "Une erreur inconnue s'est produite";
                        }
                        ?> </p>
                </div>
            <?php }
            ?>

            <div class="input-box">

                <div class="input-field">
                    <input type="text" id="email" name="email" placeholder="Email" />
                    <i class="bx bxs-envelope"></i>
                </div>

                <div class="input-field">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mot de passe" />
                    <i class="bx bxs-lock-alt"></i>
                </div>
            </div>

            <button type="submit" class="btn" name="bt_login" id="bt_login">
                Se connecter
            </button>
            <small style="text-align: right; display:block; margin-top:10px"> Vous n'avez pas de compte ? <a href="./register.html">Inscrivez-vous ici</a></small>
        </form>
    </div>
</body>

</html>
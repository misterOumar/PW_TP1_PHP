<?php

// detruire la session
session_start();

session_unset();
session_destroy();

// rediriger vers la page de login
header('Location: login.php');
exit;

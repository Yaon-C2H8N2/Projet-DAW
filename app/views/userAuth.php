<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/dark_mode.css"/>
    <title>Se connecter</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<div class="form_container">
    <form action="/authController" method="post">
        <label for="mail">Adresse Mail</label><br>
        <input type="email" name="mail" id="mail" required><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Connexion">
    </form>
    <br>
    <a href="/userCreate">S'inscrire</a><br>
    <a href="/forgotPassword">Mot de passe oublié</a>
</div>
</body>
<script src="js/UI_Theme.js"></script>
</html>
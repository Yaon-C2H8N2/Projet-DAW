<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>Se connecter</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<form action="/authController" method="post" style="margin-top: 10vh">
    <label for="mail">Adresse Mail</label>
    <input type="email" name="mail" id="mail" required>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Connexion">
</form>
<br>
<a href="/userCreate">S'inscrire</a><br>
<a href="/forgotPassword">Mot de passe oublié</a>
</body>
</html>
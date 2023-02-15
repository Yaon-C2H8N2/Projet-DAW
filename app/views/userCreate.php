<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/dark_mode.css"/>
    <title>S'inscrire</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php require 'navBar.php'; ?>
<div class="form_container">
    <form action="/creationController" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required><br>
        <fieldset name="nomPrenom">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" required><br>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" required>
        </fieldset>
        <fieldset name="mail">
            <label for="mail">Adresse Mail</label>
            <input type="email" name="mail" id="mail" required><br>
            <label for="mail">Confirmer adresse Mail</label>
            <input type="email" name="mail-confirm" id="mail-confirm" required>
        </fieldset>
        <fieldset name="pass">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required><br>
            <label for="password">Confirmer mot de passe</label>
            <input type="password" name="password-confirm" id="password-confirm" required><br>
        </fieldset>
        <label for="birthdate">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</div>
<script src="js/userCreate.js"></script>
<script src="js/UI_Theme.js"></script>
</body>
</html>
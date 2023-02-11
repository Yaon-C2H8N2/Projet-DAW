<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="/creationController" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" required>
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname" required>
    <br>
    <label for="mail">Adresse Mail</label>
    <input type="email" name="mail" id="mail" required>
    <label for="mail">Confirmer adresse Mail</label>
    <input type="email" name="mail-confirm" id="mail-confirm" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <label for="password">Confirmer mot de passe</label>
    <input type="password" name="password-confirm" id="password-confirm" required>
    <br>
    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" required>
    <br>
    <input type="submit" value="S'inscrire">
</form>
<script src="js/userCreate.js"></script>
</body>
</html>
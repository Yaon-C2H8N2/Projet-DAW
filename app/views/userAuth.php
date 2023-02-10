<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="/AuthController" method="post">
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
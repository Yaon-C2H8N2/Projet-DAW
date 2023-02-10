<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="/CreationController" method="post">
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
    <input type="submit" value="S'inscrire">
</form>
<br>
</body>
</html>
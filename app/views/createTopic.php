<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>Créer Topic</title>
</head>
<body>
<?php
if (isset($_SESSION['userInfo'])) {
    include "../app/models/User.php";
    $user = unserialize($_SESSION['userInfo']);
    echo var_dump($user);
} else {
    //TODO : Rediriger vers la page de connexion
}
?>
<form action="/createTopicController" method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required><br>
    <label for="content">Contenu</label><br>
    <textarea name="content" id="content" cols="30" rows="10" required></textarea><br>
    <input type="submit" value="Créer">
</form>
</body>
</html>

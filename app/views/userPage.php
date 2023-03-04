<?php

include_once '../app/models/User.php';

if (!isset($_SESSION['userInfo'])) {
    header('Location: /userAuth', true, 301);
    exit();
}

include_once '../app/models/DBManage.php';

//print user id
$user = unserialize($_SESSION['userInfo']);
$db = new DBManage();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/userPage.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Modification du Compte</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<div id="imgcontainer">
    <input type="file" onchange="saveImg()" id="inputImg" accept="image/*" style="display: none">
    <img id="imgUser" src="<?php
    if ($user->profilePicture == 'default.png' or $user->profilePicture == null or !file_exists($user->profilePicture)) {
        echo "/img/default_user.png";
    } else {
        echo $user->profilePicture;
    } ?>" onclick="changeImg()" alt=""><br>
</div>
<form id="userForm">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" value="<?php echo $user->pseudo; ?>" required>
    <output id="pseudoOut" style="color: red"></output>
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $db->getLoginFromId($user->id)['login'] ?>"
           required>
    <output id="emailOut" style="color: red"></output>
    <br>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstName; ?>" required><br>
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastName; ?>" required><br>
    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
           title="La date doit être sous la forme jour/mois/année" minlength="10" maxlength="10"
           min="1900-01-01" max="2199-01-01" value="<?php echo $user->birthDate; ?>" required>
    <br>
    <label for="password">Ancien mot de passe</label>
    <input type="password" name="password" id="password" value=""><br>
    <label for="newPassword">Nouveau mot de passe</label>
    <input type="password" minlength="8" name="newPassword" id="newPassword" value=""><br>
    <label for="passwordConfirm">Confirmer mot de passe</label>
    <input type="password" name="passwordConfirm" id="passwordConfirm" minlength="8" value=""><br>
    <input type="submit" value="Modifier">
</form>
<dialog id="dialogUser">
    <p id="dialogUserText"></p>
    <button id="dialogUserBtn">Fermer</button>
</dialog>
</body>
<script src="/js/UI_Theme.js"></script>
<script src="/js/userPage.js"></script>
<script src="/js/utility.js"></script>
</html>


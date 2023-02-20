<?php

if (!isset($_SESSION['loged'])) {
    header('Location: /userAuth', true, 301);
    exit();
}

include_once '../app/models/DBManage.php';
include_once '../app/models/User.php';

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
    <link id="link" rel="stylesheet" type="text/css" href="css/light_mode.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/userPage.css"/>
    <title>Compte</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<form id="userForm" action="/updateUserInfoController" method="post">
    <div id="imgcontainer">
        <img id="imgUser" src="<?php
        if ($user->profilePicture == 'default.png') {
            echo "img/neptune_icon.png";
        } else {
            echo $user->profilePicture;
        } ?>" onclick="" alt=""><br>
    </div>
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" value="<?php echo $user->pseudo; ?>" required><br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $db->getLoginFromId($user->id)['login'] ?>"
           required><br>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstName; ?>" required><br>
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastName; ?>" required><br>
    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" value="<?php echo $user->birthDate; ?>" required><br>
    <label for="password">Ancien mot de passe</label>
    <input type="password" name="password" id="password" value="" required><br>
    <label for="newPassword">Nouveau mot de passe</label>
    <input type="password" name="newPassword" id="newPassword" value="" required><br>
    <label for="passwordConfirm">Confirmer mot de passe</label>
    <input type="password" name="passwordConfirm" id="passwordConfirm" value="" required><br>
    <input type="submit" value="Modifier">
</form>
</body>


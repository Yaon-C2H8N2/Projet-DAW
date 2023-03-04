<?php

require_once '../app/models/DBManage.php';
require_once '../app/models/User.php';
require_once '../app/models/Utility.php';


$pseudo = $_REQUEST['pseudo'];
$login = $_REQUEST['email'];
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$birthdate = $_REQUEST['birthdate'];
$oldPassword = $_REQUEST['password'];
$newPassword = $_REQUEST['newPassword'];
$confirmPassword = $_REQUEST['passwordConfirm'];
if ($pseudo == '' or $login == '' or $firstname == '' or $lastname == '' or $birthdate == '') {
    echo 'Erreur : Les champs ne peuvent pas être vides.';
    exit();
}
$user = getUser();

$db = new DBManage();

if ($db->pseudoExists($pseudo) and $pseudo != $user->pseudo) {
    echo 'Erreur : Pseudo déjà existant.';
    exit();
}
if ($db->userExists($login) and $login != $db->getLoginFromId($user->id)['login']) {
    echo 'Erreur : Utilisateur déjà existant.';
    exit();
}

$update = $db->updateUserInfo($user->id, $pseudo, $lastname, $firstname, $birthdate);

if ($oldPassword == '' or $newPassword == '' or $confirmPassword == '') {
    if ($update) {
        echo 'Modification réussie';
        reloadUser();
    } else {
        echo 'Erreur : Modification échouée';
    }
    exit();
}

$oldPassword = hash('sha256', $oldPassword . $db->getLoginFromId($user->id)['salt']);
if (!$db->comparePassword($db->getLoginFromId($user->id)['login'], $oldPassword)) {
    echo "Erreur : l'ancien mot de passe est incorrect";
    exit();
}

if ($oldPassword == $db->getLoginFromId($user->id)['password']) {
    echo "Erreur : meme mot de passe";
    exit();
}


if ($db->updateUserLogin($user->id, $login, $newPassword)) {
    echo 'Modification réussie';
    reloadUser();
} else {
    echo 'Erreur : Modification échouée';
}


<?php

require_once '../app/models/DBManage.php';
require_once '../app/models/User.php';


$pseudo = $_POST['pseudo'];
$login = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$oldPassword = $_POST['password'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['passwordConfirm'];
$user = unserialize($_SESSION['userInfo']);

$db = new DBManage();

if($db->updateUserInfo($user->id, $pseudo, $lastname, $firstname, $birthdate) and
$db->updateUserLogin($user->id, $login, $newPassword)){
    echo 'Modification réussie';
    $_SESSION['userInfo'] = serialize($db->loadUser($login));
} else {
    echo 'Erreur : Modification échouée';
}

require '../app/views/userPage.php';
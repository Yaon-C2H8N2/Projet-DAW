<?php
include "../app/models/DBManage.php";

$dbc = new DBManage();
$login = $_POST['mail'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$pseudo = $_POST['username'];

if ($dbc->userExists($login)) {
    echo 'Erreur : Utilisateur déjà existant.';
} else if ($dbc->pseudoExists($pseudo)) {
    echo 'Erreur : Pseudo déjà existant.';
} else {
    $dbc->createUser($login, $password, $firstname, $lastname, $birthdate, $pseudo);
    echo 'Succès !';
}
?>
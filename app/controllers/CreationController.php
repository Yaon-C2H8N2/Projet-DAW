<?php
include "../app/controllers/DBController.php";

$dbc = new DBController();
$login = $_POST['mail'];
$password = $_POST['password'];

if ($dbc->userExists($login)) {
    echo 'Erreur : Utilisateur déjà existant.';
}else{
    $dbc->createUser($login, $password);
    echo 'Succès !';
}
?>
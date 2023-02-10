<?php
include "../app/controllers/DBManage.php";

$dbc = new DBManage();
$login = $_POST['mail'];
$password = $_POST['password'];

if ($dbc->userExists($login)) {
    echo 'Erreur : Utilisateur déjà existant.';
}else{
    $dbc->createUser($login, $password);
    echo 'Succès !';
}
?>
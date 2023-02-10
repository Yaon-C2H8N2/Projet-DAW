<?php
include "../app/models/DBManage.php";

$dbc = new DBManage();
$login = $_POST['mail'];
$password = $_POST['password'];

if (!$dbc->userExists($login)) {
    echo 'Erreur : Utilisateur inexistant.';
}else{
    $password = hash('sha256', $password . $dbc->getSalt($login));
    if($dbc->comparePassword($login, $password)){
        echo 'Succès !';
    }else{
        echo 'Erreur : Mauvais mot de passe.';
    }
}
?>
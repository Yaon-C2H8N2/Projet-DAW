<?php
if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['username'])) {
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
        header('Location: /', true, 301);
        exit();
    }
} else {
    header('Location: /userCreate', true, 301);
    exit();
}
?>
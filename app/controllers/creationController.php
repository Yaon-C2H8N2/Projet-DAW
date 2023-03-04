<?php
include_once "../app/models/Utility.php";
if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['username'])) {

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
        $id = $dbc->createUser($login, $password, $firstname, $lastname, $birthdate, $pseudo);
        if (isset($_FILES['img'])) {
            saveImgProfile($_FILES['img'], $id);
        }
        echo 'Succès !';
        header('Location: /', true, 301);
        exit();
    }
} else {
    header('Location: /userCreate', true, 301);
    exit();
}
?>
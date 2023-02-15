<?php
if(isset($_POST['mail']) && isset($_POST['password'])){
    include "../app/models/DBManage.php";

    $dbc = new DBManage();
    $login = $_POST['mail'];
    $password = $_POST['password'];

    if (!$dbc->userExists($login)) {
        echo 'Erreur : Utilisateur inexistant.';
    } else {


        $password = hash('sha256', $password . $dbc->getSalt($login));
        if ($dbc->comparePassword($login, $password)) {
            $_SESSION['userInfo'] = serialize($dbc->loadUser($login));
            header('Location: /forum', true, 301);
            exit();
        } else {
            header('Location: /userAuth', true, 301);
            exit();
        }
    }
}else{
    header('Location: /userAuth', true, 301);
    exit();
}
?>
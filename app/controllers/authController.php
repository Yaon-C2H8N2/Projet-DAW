<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    include_once "../app/models/DBManage.php";

    $dbc = new DBManage();
    $login = $_POST['email'];
    $password = $_POST['password'];

    if (!$dbc->userExists($login)) {
        echo 'Erreur : Utilisateur inexistant.';
    } else {


        $password = hash('sha256', $password . $dbc->getSalt($login));
        if ($dbc->comparePassword($login, $password)) {
            $_SESSION['userInfo'] = serialize($dbc->loadUser($login));
            echo json_encode(array('success' => true, 'message' => 'Connexion réussie.'));
            exit();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Utilisateur ou mot de passe incorrect.'));
            exit();
        }
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Erreur : Veuillez remplir tous les champs.'));
    exit();
}
?>
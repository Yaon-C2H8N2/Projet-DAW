<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    include_once "../app/models/DBManage.php";

    $dbc = new DBManage();
    $login = $_POST['email'];
    $password = $_POST['password'];

    if (!$dbc->userExists($login)) {
        echo json_encode(array('success' => false, 'message' => 'Erreur : Utilisateur inexistant.'));
        exit();
    } else {


        $password = hash('sha256', $password . $dbc->getSalt($login));

        //Connexion réussie
        if ($dbc->comparePassword($login, $password)) {
            $User = $dbc->loadUser($login);

            $_SESSION['userInfo'] = serialize($User);
            echo json_encode(array('success' => true, 'message' => 'Connexion réussie.'));

            //Log
            $file = fopen("../app/controllers/adminPanel/Log.txt", "a+") or die("Impossible d'ouvrir le fichier !");
            $now = DateTime::createFromFormat('U.u', microtime(true));
            $txt = date('d/m/Y') . " à " . $now->format("H\hi:s.u") . " connexion de \"" . $User->pseudo . "\" ID [" . $User->id . "]\r\n";
            fwrite($file, $txt);
            fclose($file);

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

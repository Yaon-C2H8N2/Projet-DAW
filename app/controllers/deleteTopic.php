<?php
include '../app/models/DBManage.php';

$db = new DBManage();

if (isset($_POST['idtopic'])) {

    if (unserialize($_SESSION['userInfo'])->id == 8) {
        //si id auteur topic = id user session supprimer
        $db->DeleteTopicById($_POST['idtopic']);
        header("Location: /home", true, 301);
        exit();
    } else {
        header("Location: /unauthorized", true, 301);
        exit();
    }
}



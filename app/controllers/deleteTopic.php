<?php
include_once '../app/models/DBManage.php';

$db = new DBManage();

if (isset($_POST['idtopic']) && isset($_SESSION['userInfo'])) {
    if (unserialize($_SESSION['userInfo'])->id == $db->getTopicById($_POST['idtopic'])[0]['idauteur'] || unserialize($_SESSION['userInfo'])->isAdmin){
        $db->DeleteTopicById($_POST['idtopic']);
    }
}



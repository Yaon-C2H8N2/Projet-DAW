<?php
include_once '../app/models/DBManage.php';

$db = new DBManage();
if (isset($_POST['idmessage']) && isset($_POST['idtopic']) && isset($_SESSION['userInfo'])) {
    if (unserialize($_SESSION['userInfo'])->id == $db->getMessageById($_POST['idtopic'], $_POST['idmessage'])[0]['idauteur'] || unserialize($_SESSION['userInfo'])->isAdmin){
        $db->DeleteMessageById($_POST['idmessage']);
    }
}


<?php
include '../app/models/DBManage.php';

$db = new DBManage();

if (isset($_POST['idmessage'])) {
    $db->DeleteMessageById($_POST['idmessage']);
}


<?php
include '../app/models/DBManage.php';

$db = new DBManage();

if (isset($_POST['idtopic'])) {
    $db->DeleteTopicById($_POST['idtopic']);
}



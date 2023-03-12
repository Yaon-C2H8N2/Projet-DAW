<?php

if (!isset($_REQUEST['pseudo'])) {
    echo "No pseudo provided";
    header('Location: /', true, 301);
    exit;
}

include_once '../app/models/DBManage.php';

$db = new DBManage();

$pseudo = $_REQUEST['pseudo'];

if (strlen($pseudo) < 2) {
    exit;
}


$user = $db->getUsersByPseudo($pseudo);


echo json_encode($user);
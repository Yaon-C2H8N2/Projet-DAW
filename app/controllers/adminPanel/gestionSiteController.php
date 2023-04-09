<?php
require_once '../app/models/DBManage.php';
require_once '../app/models/Utility.php';

$db = new DBManage();
$user = getUser()->isAdmin;

if ($user && isset($_POST['nombre'])) {

    for ($i = 0; $i < intval($_POST['nombre']); $i++) {
        $db->generateUser();
    }
}



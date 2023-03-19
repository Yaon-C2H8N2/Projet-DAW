<?php

require_once '../app/models/Utility.php';
require_once '../app/models/DBManage.php';

$admin = getUser()->isAdmin;
if (!$admin)
    header('Location: /', true, 301);

$db = new DBManage();

echo json_encode($db->getAllQcm());
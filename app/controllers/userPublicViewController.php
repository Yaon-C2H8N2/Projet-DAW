<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/User.php';

$db = new DBManage();
$admin = false;
if (isset($_SESSION['userInfo']))
    $admin = unserialize($_SESSION['userInfo'])->isAdmin;

//get url
$url = $_SERVER['REQUEST_URI'];

// get id after seconde /
try {
    $id = (int)explode('/', $url)[2];
} catch (Exception $e) {
    header('Location: /', true, 301);
}

$login = $db->getLoginFromId($id);
if (!$login) {
    header('Location: /404', true, 301);
    exit();
}
$user = $db->loadUser($login['login']);
if ($user == null) {
    header('Location: /404', true, 301);
    exit();
}

require_once '../app/views/userPublicView.php';


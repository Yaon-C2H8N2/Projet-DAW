<?php

require_once '../app/models/DBManage.php';
require_once '../app/models/Utility.php';

$db = new DBManage();

//get url
$url = $_SERVER['REQUEST_URI'];

// get id after seconde /
try {
    $id = (int)explode('/', $url)[2];
} catch (Exception $e) {
    header('Location: /', true, 301);
}

$cours = $db->getCourseById($id);
if (!$cours) {
    header('Location: /404', true, 301);
    exit();
}
if (!file_exists($cours->path)) {
    header('Location: /404', true, 301);
    exit();
}

$data = json_decode(file_get_contents($cours->path), true);

$admin = getUser()->isAdmin;
require_once '../app/views/courseView.php';


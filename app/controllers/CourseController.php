<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/User.php';

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


$data = json_decode(file_get_contents($cours->path), true);

//var_dump($data);

require_once '../app/views/courseView.php';


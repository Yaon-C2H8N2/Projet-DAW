<?php

require_once '../app/models/Utility.php';

$admin = getUser()->isAdmin;

if (!$admin)
    header('Location: /', true, 301);

$url = $_SERVER['REQUEST_URI'];

// get id after seconde /
try {
    $id = (int)explode('/', $url)[3];
} catch (Exception $e) {
    header('Location: /', true, 301);
}

require_once '../app/models/DBManage.php';

$db = new DBManage();

if ($db->deleteCourse($id))
    echo json_encode(array("success" => true, "message" => "Le cours a ete supprime."));
else
    echo json_encode(array("success" => false, "message" => "Erreur de la DB."));

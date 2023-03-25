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

$qcm = $db->getQCMById($id);
if (!$qcm) {
    header('Location: /404', true, 301);
    exit();
}

if ($db->deleteQCM($id))
    if (file_exists($qcm->path)) {
        unlink($qcm->path);
        echo json_encode(array("success" => true, "message" => "Le QCM a ete supprime."));
    } else
        echo json_encode(array("success" => true, "message" => "Le QCM a ete supprime de la DB mais le fichier n'existait pas."));
else
    echo json_encode(array("success" => false, "message" => "Erreur de la DB."));

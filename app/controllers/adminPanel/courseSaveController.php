<?php

require_once '../app/models/Utility.php';
require_once '../app/models/DBManage.php';

$admin = getUser()->isAdmin;
if (!$admin)
    header('Location: /', true, 301);

$cours = json_decode($_REQUEST['cours'], true);

if ($cours['title'] == null) {
    echo "Le cours n'a pas de titre";
    echo json_encode(array("success" => false, "message" => "Le cours n'a pas de titre"));
    exit;
}

$dir = 'cours' . DIRECTORY_SEPARATOR;

if (!file_exists($dir)) {
    mkdir($dir);
}

if (file_exists($dir . $cours['title'] . ".json")) {
    echo "Le cours existe deja";
    echo json_encode(array("success" => false, "message" => "Le cours existe deja"));
    exit;
}

$file = fopen($dir . $cours["title"] . ".json", "w");
fwrite($file, $_REQUEST['cours']);

echo json_encode(array("success" => true, "message" => "Le cours a ete sauvegarde"));
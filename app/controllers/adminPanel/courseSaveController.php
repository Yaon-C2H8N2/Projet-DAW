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

$nom = $cours['title'];
$ext = ".json";

while (file_exists($dir . $nom . $ext)) {
    $nom .= '(1)';
}

$file = fopen($dir . $nom . $ext, "w");
fwrite($file, $_REQUEST['cours']);

$db = new DBManage();
if ($db->addCourse($nom . $ext))
    echo json_encode(array("success" => true, "message" => "Le cours a ete sauvegarde."));
else
    echo json_encode(array("success" => false, "message" => "Erreur de la DB."));


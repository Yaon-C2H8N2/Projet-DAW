<?php

if (!isset($_REQUEST['qcm'])) {
    echo "No qcm provided";
    header('Location: /', true, 301);
    exit;
}
$json = $_REQUEST['qcm'];

$qcm = json_decode($json, true);

// check if qcm is valid

if ($qcm == null) {
    echo "Le QCM n'est pas valide";
    exit;
}

// check if qcm hase name
if (!isset($qcm['name']) or $qcm['name'] == '') {
    echo "Le QCM doit avoir un nom";
    exit();
}

// check if qcm has questions
if (!isset($qcm['questions'])) {
    echo "No questions provided";
    exit;
}


$xml = new SimpleXMLElement('<qcm/>');
$xml->addAttribute('name', $qcm['name']);


foreach ($qcm['questions'] as $question) {
    $q = $xml->addChild('question');
    $q->addAttribute('expected', $question['expected']);
    $q->addChild('text', $question['title']);
    $answers = $q->addChild('answers');
    $has_expected = false;
    foreach ($question["answers"] as $answer) {
        if ($answer == '') {
            echo "La reponse ne peut pas etre vide";
            exit;
        }
        $a = $answers->addChild('answer');
        $text = $a->addChild('text', $answer);
    }
}

$qcmDir = '../public/xml/qcm/';

if (!file_exists($qcmDir)) {
    mkdir($qcmDir, 0777, true);
}
if (file_exists($qcmDir . $qcm['name'] . '.xml')) {
    unlink($qcmDir . $qcm['name'] . '.xml');
}
$xml->asXML($qcmDir . $qcm['name'] . '.xml');

include_once '../app/models/DBManage.php';
$db = new DBManage();
$db->addQCM($qcm['name'] . '.xml');

echo "QCM créé avec succès.";
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
    $answers = $q->addChild('answers');
    $has_expected = false;
    foreach ($question as $answer) {
        if ($answer == '') {
            echo "La reponse ne peut pas etre vide";
            exit;
        }
        if (is_numeric($answer)) {
            $q->addAttribute('expected', $answer);
            $has_expected = true;
            continue;
        }
        $a = $answers->addChild('answer');
        $text = $a->addChild('text', $answer);
    }
    if (!$has_expected) {
        $q->addAttribute('expected', 1);
    }
}

if (!file_exists('../public/xml/qcm')) {
    mkdir('../public/xml/qcm', 0777, true);
}
if (file_exists('../public/xml/qcm/' . $qcm['name'] . '.xml')) {
    unlink('../public/xml/qcm/' . $qcm['name'] . '.xml');
}
$xml->asXML('../public/xml/qcm/' . $qcm['name'] . '.xml');

echo "QCM créé avec succès.";
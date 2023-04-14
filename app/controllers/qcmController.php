<?php

require_once "../app/models/DBManage.php";
require_once "../app/models/Utility.php";

$qcmid = (int)substr($url, 5);
$dbc = new DBManage();
$qcm = $dbc->getQCMById($qcmid);

if (!$qcm) {
    header("Location: /404", true, 301);
    exit();
}

$path = $qcm->path;

$questions = [];
$answers = [];
$expected_answers = [];

if (!file_exists($path)) {
    header("Location: /404", true, 301);
    exit();
}

$xml = file_get_contents($path);

$file = simplexml_load_string($xml);
foreach ($file->question as $question) {
    $questions[] = $question->text;
    $expected_answers[] = $question->attributes()->expected;
    $temp_answers = [];
    foreach ($question->answers->answer as $answer) {
        $temp_answers[] = $answer;
    }
    $answers[] = $temp_answers;
}

$admin = getUser()->isAdmin;

require_once "../app/views/qcm.php";
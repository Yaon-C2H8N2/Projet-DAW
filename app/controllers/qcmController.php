<?php

require "../app/models/DBManage.php";

$qcmid = (int) substr($url, 5);
$dbc = new DBManage();
$path = $dbc->getQCMPath($qcmid);

if($path == null) {
    header("Location: /404", true, 301);
    exit();
}

$questions = [];
$answers = [];
$expected_answers = [];

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

require "../app/views/qcm.php";
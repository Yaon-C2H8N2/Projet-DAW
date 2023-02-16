<?php

require "../app/models/DBManage.php";

//$qcmid = (int) substr($url, 7);
//$dbc = new DBManage();
//$path = $dbc->getQCMPath($qcmid);
$path = '../public/xml/qcm/test.xml';

$questions = [];
$answers = [];
$expected_answers = [];

$file = simplexml_load_file($path);
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
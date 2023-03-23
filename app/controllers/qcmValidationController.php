<?php
require "../app/models/DBManage.php";

$dbc = new DBManage();
$qcmid = (int)$_POST['qcmid'];
$path = $dbc->getQCMPath($qcmid);
$file = simplexml_load_file($path);

foreach ($file->question as $question) {
    $questions[] = $question->text;
    $expected_answers[] = $question->attributes()->expected;
}

$score = 0;
for ($i = 0; $i < count($questions); $i++) {
    if ($_POST['qcm' . $i] == ($expected_answers[$i] - 1)) {
        $score++;
    }
}
echo $score . '/' . count($questions);
<?php
require_once "../app/models/DBManage.php";

$dbc = new DBManage();
$qcmid = (int)$_POST['qcmid'];
$qcm = $dbc->getQCMById($qcmid);
if (!$qcm) {
    header("Location: /404", true, 301);
    exit();
}
file_exists($qcm->path) or die("Le fichier n'existe pas");
$file = simplexml_load_file($qcm->path);

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
$score = $score / count($questions) * 20;

$dbc->addQCMResult($qcmid, unserialize($_SESSION['userInfo'])->id, $score);


require "../app/views/qcm_note.php";
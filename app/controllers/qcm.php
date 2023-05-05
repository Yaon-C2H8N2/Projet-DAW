<?php
function getQCM()
{

    require_once "../app/models/DBManage.php";
    require_once "../app/models/Utility.php";

    if (isset($_GET['qcmid'])) {
        $qcmid = (int)$_GET['qcmid'];
    } else {
        header('Location: /index.php?controller=cours&action=getCoursPanel');
    }
    $dbc = new DBManage();
    $qcm = $dbc->getQCMById($qcmid);

    if (!$qcm) {
        header("Location: /index.php?controller=user&action=notFound", true, 301);
        exit();
    }

    $path = $qcm->path;

    $questions = [];
    $answers = [];
    $expected_answers = [];

    if (!file_exists($path)) {
        header("Location: /index.php?controller=user&action=notFound", true, 301);
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
}

function validateQCM(){
    require_once "../app/models/DBManage.php";

    $dbc = new DBManage();
    $qcmid = (int)$_POST['qcmid'];
    $qcm = $dbc->getQCMById($qcmid);
    if (!$qcm) {
        header("Location: /index.php?controller=user&action=notFound", true, 301);
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

    require_once "../app/views/qcm_note.php";
}
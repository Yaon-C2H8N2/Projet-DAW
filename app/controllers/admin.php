<?php
function getAdminPage()
{
    require '../app/views/adminPage.php';
}

function unauthorized()
{
    require '../app/views/unauthorized_Page.php';
}

function getSearchUserPage()
{
    require '../app/views/adminPanel/searchUser.php';
}

function getQCMCreationPage()
{
    require '../app/views/adminPanel/qcmCreation.php';
}

function getSiteManagementPage()
{
    require '../app/views/adminPanel/gestionSite.php';
}

function getCourseCreationPage()
{
    require '../app/views/adminPanel/courseCreation.php';
}

function getResourcesPage()
{
    require '../app/views/adminPanel/listRessource.php';
}

function searchUser()
{
    if (!isset($_REQUEST['pseudo'])) {
        echo "No pseudo provided";
        header('Location: /', true, 301);
        exit;
    }

    require_once '../app/models/DBManage.php';

    $db = new DBManage();

    $pseudo = addslashes($_REQUEST['pseudo']);

    if (strlen($pseudo) < 2) {
        exit;
    }

    $user = $db->getUsersByPseudo($pseudo);

    echo json_encode($user);
}

function addRandomUser()
{
    require_once '../app/models/DBManage.php';
    require_once '../app/models/Utility.php';

    $db = new DBManage();
    $user = getUser()->isAdmin;

    if ($user && isset($_POST['nombre'])) {

        for ($i = 0; $i < intval($_POST['nombre']); $i++) {
            $db->generateUser();
        }
    }
}

function saveQCM()
{
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
    $nom = $qcm['name'];
    $ext = ".xml";

    while (file_exists($qcmDir . $nom . $ext)) {
        $nom .= '(1)';
    }
    $xml->asXML($qcmDir . $nom . $ext);

    include_once '../app/models/DBManage.php';
    $db = new DBManage();
    $db->addQCM($nom . $ext);

    echo "QCM créé avec succès.";
}

function saveCourse()
{
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
        echo json_encode(array("success" => true, "message" => "Le cours a été sauvegardé."));
    else
        echo json_encode(array("success" => false, "message" => "Erreur de la DB."));
}

function searchQCM()
{
    require_once '../app/models/Utility.php';
    require_once '../app/models/DBManage.php';
//$admin = getUser()->isAdmin;
//if (!$admin)
//    header('Location: /', true, 301);
    $db = new DBManage();
    echo json_encode($db->getAllQcm());
}

function searchCourse()
{
    require_once "../app/models/DBManage.php";
    $db = new DBManage();
    $allCours = $db->getAllCourses();
    echo json_encode($allCours);
}

function deleteCourse()
{
    require_once '../app/models/Utility.php';

    $admin = getUser()->isAdmin;

    if (!$admin)
        header('Location: /', true, 301);

    if (isset($_GET['courseid'])) {
        $id = (int)$_GET['courseid'];
    } else {
        header('Location: /index.php?controller=admin&action=getAdminPage');
    }

    require_once '../app/models/DBManage.php';

    $db = new DBManage();
    $cours = $db->getCourseById($id);

    if ($db->deleteCourse($id)) {
        if (file_exists($cours->path)) {
            unlink($cours->path);
            echo json_encode(array("success" => true, "message" => "Le cours a été supprime."));
        } else
            echo json_encode(array("success" => true, "message" => "Le cours a été supprime de la DB mais le fichier n'existait pas."));
    } else
        echo json_encode(array("success" => false, "message" => "Erreur de la DB."));
}

function deleteQCM()
{

    require_once '../app/models/Utility.php';

    $admin = getUser()->isAdmin;

    if (!$admin)
        header('Location: /', true, 301);

    if (isset($_GET['qcmid'])) {
        $id = (int)$_GET['qcmid'];
    } else {
        header('Location: /index.php?controller=admin&action=getAdminPage');
    }

    require_once '../app/models/DBManage.php';

    $db = new DBManage();

    $qcm = $db->getQCMById($id);
    if (!$qcm) {
        header('Location: /index.php?controller=user&action=notFound', true, 301);
        exit();
    }

    if ($db->deleteQCM($id))
        if (file_exists($qcm->path)) {
            unlink($qcm->path);
            echo json_encode(array("success" => true, "message" => "Le QCM a ete supprime."));
        } else
            echo json_encode(array("success" => true, "message" => "Le QCM a ete supprime de la DB mais le fichier n'existait pas."));
    else
        echo json_encode(array("success" => false, "message" => "Erreur de la DB."));
}
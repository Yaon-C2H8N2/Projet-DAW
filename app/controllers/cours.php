<?php
function getCoursPanel()
{
    require '../app/views/coursPanel.php';
}

function coursPanel(){
    include_once '../app/models/DBManage.php';

    require_once "../app/models/DBManage.php";

    $db = new DBManage();

    $allCours = $db->getAllCourses();
}

function getCours()
{
    require_once '../app/models/DBManage.php';
    require_once '../app/models/Utility.php';

    $db = new DBManage();

    if (isset($_GET['courseid'])) {
        $id = (int)$_GET['courseid'];
    } else {
        header('Location: /index.php?controller=cours&action=getCoursPanel');
    }

    $cours = $db->getCourseById($id);
    if (!$cours) {
        header('Location: /404', true, 301);
        exit();
    }
    if (!file_exists($cours->path)) {
        header('Location: /404', true, 301);
        exit();
    }

    $data = json_decode(file_get_contents($cours->path), true);

    $admin = getUser()->isAdmin;
    require_once '../app/views/courseView.php';
}
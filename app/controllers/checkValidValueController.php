<?php

include_once '../app/models/DBManage.php';

$db = new DBManage();

if (!isset($_SESSION['userInfo'])) {
    if (isset($_REQUEST['pseudo'])) {
        echo($db->pseudoExists($_REQUEST['pseudo']) == 0 ? 'false' : 'true');
        exit();
    }
    if (isset($_REQUEST['email'])) {
        echo($db->userExists($_REQUEST['email']) == 0 ? 'false' : 'true');
        exit();
    }
}

if (isset($_SESSION['userInfo'])) {

    if (isset($_REQUEST['pseudo'])) {
        if (unserialize($_SESSION['userInfo'])->pseudo == $_REQUEST['pseudo'])
            exit();
        echo($db->pseudoExists($_REQUEST['pseudo']) == 0 ? 'false' : 'true');
    } else {
        if (isset($_REQUEST['email'])) {
            if ($db->getLoginFromId(unserialize($_SESSION['userInfo'])->id)['login'] == $_REQUEST['email'])
                exit();
            echo($db->userExists($_REQUEST['email']) == 0 ? 'false' : 'true');
        } else {
            echo false;
            exit();
        }
    }
}
<?php
require_once '../app/models/DBManage.php';
require_once '../app/models/User.php';
require_once '../app/models/Utility.php';

$user = getUser();

if (!isset($_REQUEST['user'])) {
    header('Location: /', true, 301);
    exit();
}
$db = new DBManage();


$userDeleteID = json_decode($_REQUEST['user'])->id;

if (!($login = $db->getLoginFromId($userDeleteID))) {
    echo json_encode(array('success' => false, 'message' => 'Utilisateur introuvable'));
    exit();
}
$userDelete = $db->loadUser($login['login']);
if (is_null($userDelete)) {
    echo json_encode(array('success' => false, 'message' => 'Utilisateur introuvable'));
    exit();
}

if ($user->isAdmin) {
    if ($userDelete->isAdmin) {
        echo json_encode(array('success' => false, 'message' => 'Vous ne pouvez pas supprimer cet utilisateur'));
        exit();
    } else {
        $db->deleteUser($userDelete->id);
        echo json_encode(array('success' => true, 'message' => 'Utilisateur supprimé'));
        exit();
    }
}

if ($user->id == $userDelete->id) {
    $db->deleteUser($user->id);
    session_destroy();
    echo json_encode(array('success' => true, 'message' => 'Compte supprimé'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Vous ne pouvez pas supprimer cet utilisateur'));
}

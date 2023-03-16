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

$userDelete = json_decode($_REQUEST['user']);

if ($user->isAdmin) {
    if ($userDelete->isAdmin) {
        echo json_encode(array('success' => false, 'message' => 'Vous ne pouvez pas supprimer cet utilisateur'));
        exit();
    } else {
        $db->deleteUser($userDelete->pseudo);
        echo json_encode(array('success' => true, 'message' => 'Utilisateur supprimé'));
        exit();
    }
}

if ($user->pseudo == $userDelete->pseudo) {
    $db->deleteUser($user->pseudo);
    echo json_encode(array('success' => true, 'message' => 'Utilisateur supprimé'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Vous ne pouvez pas supprimer cet utilisateur'));
}

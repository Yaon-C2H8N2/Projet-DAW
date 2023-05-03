<?php
function changeImg()
{
    include_once "../app/models/User.php";
    include_once "../app/models/DBManage.php";
    include_once "../app/models/Utility.php";


    if (!isset($_FILES['img'])) {
        echo "Aucune image reçue";
        exit();
    }
    $image = $_FILES['img'];

    if (modifyImgProfile($image)) {
        echo "Photo de profil modifiée avec succès";
    } else {
        echo "Erreur lors de la modification de la photo de profil";
    }
}

function getUserProfilePage()
{
    require '../app/views/user_Profil_Page.php';
}

function getUserModificationPage()
{
    require '../app/views/userPage.php';
}

function getAboutPage()
{
    require '../app/views/about.php';
}

function notFound(){
    require '../app/views/404.php';
}

function forgotPassword(){
    require '../app/views/forgotPassword.php';
}

function userPublicPage()
{
    include_once '../app/models/DBManage.php';
    include_once '../app/models/User.php';

    $db = new DBManage();
    $admin = false;
    if (isset($_SESSION['userInfo']))
        $admin = unserialize($_SESSION['userInfo'])->isAdmin;

    if (isset($_GET['userid'])) {
        $id = (int)$_GET['userid'];
    } else {
        header('Location: /index.php');
    }

    $login = $db->getLoginFromId($id);
    if (!$login) {
        header('Location: /404', true, 301);
        exit();
    }
    $user = $db->loadUser($login['login']);
    if ($user == null) {
        header('Location: /404', true, 301);
        exit();
    }

    require_once '../app/views/userPublicView.php';
}

function updateUserInfo()
{
    require_once '../app/models/DBManage.php';
    require_once '../app/models/User.php';
    require_once '../app/models/Utility.php';


    $pseudo = $_REQUEST['pseudo'];
    $login = $_REQUEST['email'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $birthdate = $_REQUEST['birthdate'];
    $oldPassword = $_REQUEST['password'];
    $newPassword = $_REQUEST['newPassword'];
    $confirmPassword = $_REQUEST['passwordConfirm'];
    if ($pseudo == '' or $login == '' or $firstname == '' or $lastname == '' or $birthdate == '') {
        echo 'Erreur : Les champs ne peuvent pas être vides.';
        exit();
    }
    $user = getUser();

    $db = new DBManage();

    if ($db->pseudoExists($pseudo) and $pseudo != $user->pseudo) {
        echo 'Erreur : Pseudo déjà existant.';
        exit();
    }
    if ($db->userExists($login) and $login != $db->getLoginFromId($user->id)['login']) {
        echo 'Erreur : Utilisateur déjà existant.';
        exit();
    }

    $update = $db->updateUserInfo($user->id, $pseudo, $lastname, $firstname, $birthdate);

    if ($oldPassword == '' or $newPassword == '' or $confirmPassword == '') {
        if ($update) {
            echo 'Modification réussie';
            reloadUser();
        } else {
            echo 'Erreur : Modification échouée';
        }
        exit();
    }

    $oldPassword = hash('sha256', $oldPassword . $db->getLoginFromId($user->id)['salt']);
    if (!$db->comparePassword($db->getLoginFromId($user->id)['login'], $oldPassword)) {
        echo "Erreur : l'ancien mot de passe est incorrect";
        exit();
    }

    if ($oldPassword == $db->getLoginFromId($user->id)['password']) {
        echo "Erreur : meme mot de passe";
        exit();
    }


    if ($db->updateUserLogin($user->id, $login, $newPassword)) {
        echo 'Modification réussie';
        reloadUser();
    } else {
        echo 'Erreur : Modification échouée';
    }
}

function deleteUser(){
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
        if ($userDelete->isAdmin || $userDelete->id == 1) {
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
}
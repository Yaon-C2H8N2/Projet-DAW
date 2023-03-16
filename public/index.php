<?php
$url = $_SERVER['REQUEST_URI'];
header('Content-Type: text/html; charset=utf-8');
session_start();
switch ($url) {
    case '/':
        require '../app/views/home.php';
        break;
    case str_starts_with($url, '/img/'):
        header('Content-Type: image/jpeg');
        echo file_get_contents('../public' . $url);
        break;
    case str_starts_with($url, '/css/'):
        header('Content-Type: text/css');
        echo file_get_contents('../public' . $url);
        break;
    case str_starts_with($url, '/js/'):
        header('Content-Type: text/javascript');
        echo file_get_contents('../public' . $url);
        break;
    case '/userAuth':
        require '../app/views/userAuth.php';
        break;
    case '/userCreate':
        require '../app/views/userCreate.php';
        break;
    case '/authController':
        require '../app/controllers/authController.php';
        break;
    case '/creationController':
        require '../app/controllers/creationController.php';
        break;
    case '/phpinfo':
        phpinfo();
        break;
    case '/forum':
        require '../app/views/forum.php';
        break;
    case str_starts_with($url, '/forum/'):
        if (substr($url, 7) == '') {
            require '../app/views/forum.php';
        } else {
            require '../app/controllers/topicController.php';
        }
        break;
    case '/logout':
        session_destroy();
        header('Location: /', true, 301);
        exit();
    case '/createTopic':
        require '../app/views/createTopic.php';
        break;
    case '/createTopicController':
        require '../app/controllers/createTopicController.php';
        break;
    case '/createPostController':
        require '../app/controllers/createPostController.php';
        break;
    case '/changeImg':
        require '../app/controllers/changeImgController.php';
        break;
    case '/compte':
        require '../app/views/user_Profil_Page.php';
        break;
    case '/userPage':
        require '../app/views/userPage.php';
        break;
    case '/cours':
        require '../app/views/cours.php';
        break;
    case '/unauthorized':
        require '../app/views/unauthorized_Page.php';
        break;
    case '/updateUserInfoController':
        require '../app/controllers/updateUserInfoController.php';
        break;
    case '/checkValidValue':
        require '../app/controllers/checkValidValueController.php';
        break;
    case '/about':
        require '../app/views/about.php';
        break;
    case str_starts_with($url, '/qcm/'):
        require '../app/controllers/qcmController.php';
        break;
    case '/qcmValidationController':
        require '../app/controllers/qcmValidationController.php';
        break;
    case '/admPage':
        require '../app/views/adminPage.php';
        break;
    case '/admin/searchUser':
        require '../app/views/adminPanel/searchUser.php';
        break;
    case '/admin/searchUserController':
        require '../app/controllers/adminPanel/searchUserController.php';
        break;
    case '/admin/qcmCreation':
        require '../app/views/adminPanel/qcmCreation.php';
        break;

    case '/deleteTopic':
        require '../app/controllers/deleteTopic.php';
        break;

    case '/deleteMessage':
        require '../app/controllers/deleteMessage.php';
        break;

    case '/admin/saveQcmController':
        require '../app/controllers/adminPanel/QcmSaveController.php';
        break;
    case str_starts_with($url, '/userPublicView/'):
        if (substr($url, 7) == '') {
            require '/';
        } else {
            require '../app/views/userPublicView.php';
        }
        break;
    case '/admin/courseCreation':
        require '../app/views/adminPanel/courseCreation.php';
        break;
    case '/deleteUser':
        require '../app/controllers/deleteUser.php';
        break;
    default:
        require '../app/views/404.php';
        break;
}
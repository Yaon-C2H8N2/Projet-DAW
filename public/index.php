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
        break;
    case '/createTopic':
        require '../app/views/createTopic.php';
        break;
    case '/createTopicController':
        require '../app/controllers/createTopicController.php';
        break;
    case '/createPostController':
        require '../app/controllers/createPostController.php';
        break;
    default:
        require '../app/views/404.php';
        break;
}
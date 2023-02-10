<?php
$url = $_SERVER['REQUEST_URI'];
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
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
    default:
        require '../app/views/404.php';
        break;
}
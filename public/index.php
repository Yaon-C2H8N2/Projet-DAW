<?php
$url = $_SERVER['REQUEST_URI'];
header('Content-Type: text/html; charset=utf-8');
session_start();

if (isset($_GET['action']) && isset($_GET['controller'])) {
    require '../app/controllers/' . $_GET['controller'] . '.php';
    $_GET['action']();
} else {
    require '../app/views/home.php';
}

//switch ($url) {
//    case '/about':
//        require '../app/views/about.php';
//        break;
//    default:
//        require '../app/views/404.php';
//        break;
//}
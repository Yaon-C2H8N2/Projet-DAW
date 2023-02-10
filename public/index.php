<?php
$url = $_SERVER['REQUEST_URI'];
switch ($url) {
    case '/':
        require '../app/views/home.php';
        break;
    case '/userAuth':
        require '../app/views/userAuth.php';
        break;
    case '/userCreate':
        require '../app/views/userCreate.php';
        break;
    case '/AuthController':
        require '../app/controllers/AuthController.php';
        break;
    case '/CreationController':
        require '../app/controllers/CreationController.php';
        break;
    default:
        require '../app/views/404.php';
        break;
}
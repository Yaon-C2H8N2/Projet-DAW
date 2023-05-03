<?php
$url = $_SERVER['REQUEST_URI'];
header('Content-Type: text/html; charset=utf-8');
session_start();

if (isset($_GET['action']) && isset($_GET['controller'])) {
    try{
        require '../app/controllers/' . $_GET['controller'] . '.php';
        $_GET['action']();
    } catch (Error $e){
        require '../app/views/404.php';
    }
} else {
    require '../app/views/home.php';
}
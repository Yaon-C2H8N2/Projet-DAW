<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
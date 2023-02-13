<?php

include "../app/models/DBManage.php";
include "../app/models/User.php";

$content = $_POST['content'];
$idTopic = $_POST['idtopic'];
$author = unserialize($_SESSION['userInfo'])->id;
$dbc = new DBManage();

$dbc->createPost($content, $author, $idTopic);
header('Location: /forum/' . $idTopic, true, 301);
exit();
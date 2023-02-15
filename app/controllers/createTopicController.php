<?php
if (isset($_SESSION['userInfo']) && isset($_POST['title']) && isset($_POST['content'])) {
    include "../app/models/DBManage.php";
    include "../app/models/User.php";

    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = unserialize($_SESSION['userInfo'])->id;
    $dbc = new DBManage();

    $idTopic = $dbc->createTopic($title, $content, $author);
    $dbc->createPost($content, $author, $idTopic);
    header('Location: /forum/' . $idTopic, true, 301);
    exit();
} else {
    header('Location: /forum', true, 301);
    exit();
}
?>
<?php
function getForumView()
{
    require '../app/views/forum.php';
}

function getTopic()
{
    include_once '../app/models/DBManage.php';

    if (isset($_GET['topicid'])) {
        $topicid = (int)$_GET['topicid'];
    } else {
        header('Location: /index.php?controller=forum&action=getForumView');
    }
    $dbc = new DBManage();
    $messages = $dbc->getTopicMessages($topicid);

    include_once '../app/views/topic.php';
}

function getTopicCreationView()
{
    include_once '../app/views/createTopic.php';
}

function createTopic()
{
    if (isset($_SESSION['userInfo']) && isset($_POST['title']) && isset($_POST['content'])) {
        include_once "../app/models/DBManage.php";
        include_once "../app/models/User.php";

        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = unserialize($_SESSION['userInfo'])->id;
        $dbc = new DBManage();

        $idTopic = $dbc->createTopic($title, $content, $author);
        $dbc->createPost($content, $author, $idTopic);
        header('Location: /index.php?controller=forum&action=getTopic&topicid=' . $idTopic, true, 301);
        exit();
    } else {
        header('Location: /index.php?controller=forum&action=getForumView', true, 301);
        exit();
    }
}

function createPost()
{
    include_once "../app/models/User.php";
    if (isset($_POST['content']) && isset($_POST['idtopic']) && isset($_SESSION['userInfo'])) {
        include_once "../app/models/DBManage.php";

        $content = $_POST['content'];
        $idTopic = $_POST['idtopic'];
        $author = unserialize($_SESSION['userInfo'])->id;
        $dbc = new DBManage();

        $dbc->createPost($content, $author, $idTopic);
        header('Location: /index.php?controller=forum&action=getTopic&topicid=' . $idTopic, true, 301);
        exit();
    } else {
        header('Location: /index.php?controller=forum&action=getForumView', true, 301);
        exit();
    }
}

function deleteTopic()
{
    include_once '../app/models/DBManage.php';

    $db = new DBManage();

    if (isset($_POST['idtopic']) && isset($_SESSION['userInfo'])) {
        if (unserialize($_SESSION['userInfo'])->id == $db->getTopicById($_POST['idtopic'])[0]['idauteur'] || unserialize($_SESSION['userInfo'])->isAdmin){
            $db->DeleteTopicById($_POST['idtopic']);
        }
    }
}

function deleteMessage(){
    include_once '../app/models/DBManage.php';

    $db = new DBManage();
    if (isset($_POST['idmessage']) && isset($_POST['idtopic']) && isset($_SESSION['userInfo'])) {
        if (unserialize($_SESSION['userInfo'])->id == $db->getMessageById($_POST['idtopic'], $_POST['idmessage'])[0]['idauteur'] || unserialize($_SESSION['userInfo'])->isAdmin){
            $db->DeleteMessageById($_POST['idmessage']);
        }
    }
}
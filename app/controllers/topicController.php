<?php
include '../app/models/DBManage.php';


$topicid = (int)substr($url, 7);
$dbc = new DBManage();
$messages = $dbc->getTopicMessages($topicid);

include '../app/views/topic.php';
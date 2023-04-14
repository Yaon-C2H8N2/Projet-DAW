<?php
include_once '../app/models/DBManage.php';


$topicid = (int)substr($url, 7);
$dbc = new DBManage();
$messages = $dbc->getTopicMessages($topicid);

include_once '../app/views/topic.php';
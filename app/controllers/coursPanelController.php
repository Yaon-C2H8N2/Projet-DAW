<?php
include_once '../app/models/DBManage.php';

require_once "../app/models/DBManage.php";

$db = new DBManage();

$allCours = $db->getAllCourses();


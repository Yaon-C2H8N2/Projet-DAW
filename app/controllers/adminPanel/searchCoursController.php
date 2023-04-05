<?php
require_once "../app/models/DBManage.php";
$db = new DBManage();
$allCours = $db->getAllCourses();
echo json_encode($allCours);
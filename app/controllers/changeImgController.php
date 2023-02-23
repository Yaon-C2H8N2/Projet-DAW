<?php

include "../app/models/User.php";
include "../app/models/DBManage.php";

$image = $_FILES['img'];
if($image['size'] > 5000000) {
    echo "Fichier trop volumineux<br> Veuillez choisir un fichier de moins de 5Mo.";
    exit();
}
$fileContent = file_get_contents($image['tmp_name']);
$user = unserialize($_SESSION['userInfo']);
$ext = pathinfo($image['name'], PATHINFO_EXTENSION);

if($user->profilePicture != 'default.png' and file_exists($user->profilePicture)) {
    unlink($user->profilePicture);
}

$path = 'img/userPicture/' . $user->pseudo . '.' . $ext;
move_uploaded_file($image['tmp_name'], $path);

$db = new DBManage();

if ($db->updateUserImage($user->id, $path)) {
    $user->profilePicture = $path;
    $_SESSION['userInfo'] = serialize($user);
    echo "Photo de profil modifiée avec succès";
}



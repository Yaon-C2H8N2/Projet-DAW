<?php

include "../app/models/User.php";
include "../app/models/DBManage.php";


if (!isset($_FILES['img'])) {
    echo "Aucune image reçue";
    exit();
}
$image = $_FILES['img'];
$user = unserialize($_SESSION['userInfo']);
$ext = pathinfo($image['name'], PATHINFO_EXTENSION);

if ($user->profilePicture != 'default.png' and file_exists($user->profilePicture) and $user->profilePicture != "") {
    unlink($user->profilePicture);
}

if (!is_dir('img/userPicture/'))
    mkdir('img/userPicture/');

$tmpFilePath = $image['tmp_name'];
$pathDest = 'img/userPicture/' . $user->id . '.png';

//todo beta
$out = null;
$return = null;
$command = 'ffmpeg -i ' . '"' . $image['tmp_name'] . '"' . ' -vf scale=320:-1 ' . '"' . $pathDest . '"' . ' &';
exec($command, $out, $return);

$db = new DBManage();

if ($db->updateUserImage($user->id, $pathDest )) {
    $user->profilePicture = $pathDest;
    $_SESSION['userInfo'] = serialize($user);
    echo "Photo de profil modifiée avec succès";
}



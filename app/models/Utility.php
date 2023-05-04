<?php
include_once "DBManage.php";

/**
 * @return User|null Return the user if he is connected, else return null
 */
function getUser(): User|null
{
    if (isset($_SESSION['userInfo']))
        return unserialize($_SESSION['userInfo']);
    header('Location: /');
    return null;
}

/**
 * @return void Reload the user in the session
 */
function reloadUser(): void
{
    $db = new DBManage();
    $user = $db->loadUser($db->getLoginFromId(getUser()->id)['login']);
    $_SESSION['userInfo'] = serialize($user);
}

/**
 * @param $file
 * @param $id
 * @return bool Return true if the image is saved, else return false
 */
function saveImgProfile($file, $id): bool
{
    if (!is_dir('img/userPicture/')) mkdir('img/userPicture/');

    $pathDest = 'img/userPicture/' . $id . '.png';

//todo beta
    $out = null;
    $return = null;
    $command = 'ffmpeg -i ' . '"' . $file['tmp_name'] . '"' . ' -vf scale=320:-1 ' . '"' . $pathDest . '"' . ' &';
    exec($command, $out, $return);
    $db = new DBManage();
    return $db->updateUserImage($id, $pathDest);
}

/**
 * @param $file
 * @return bool Return true if the image is modified, else return false
 */
function modifyImgProfile($file): bool
{
    $user = getUser();
    if ($user->profilePicture != 'default.png' and file_exists($user->profilePicture) and $user->profilePicture != "") {
        unlink($user->profilePicture);
    }

    $return = saveImgProfile($file, $user->id);
    if ($return) {
        reloadUser();
        return true;
    }
    return false;
}
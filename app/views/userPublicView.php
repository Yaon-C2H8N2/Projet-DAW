<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/User.php';

$db = new DBManage();
$admin = false;
if (isset($_SESSION['userInfo']))
    $admin = unserialize($_SESSION['userInfo'])->isAdmin;

//get url
$url = $_SERVER['REQUEST_URI'];

// get id after seconde /
try {
    $id = (int)explode('/', $url)[2];
} catch (Exception $e) {
    header('Location: /', true, 301);
}
$user = $db->loadUser($db->getLoginFromId($id)['login']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?php echo $user->pseudo; ?></title>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
</head>

<body>
</body>
</html>

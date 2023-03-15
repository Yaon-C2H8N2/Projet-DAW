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
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/userPublicView.css"/>
    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
    <script src="/js/UI_Theme.js"></script>

</head>
<body>

<?php require 'navBar.php'; ?>

<div class="div_main_page_create">
    <div class="form_titre_page_login">
        <div class="img_profil_create_container">
            <?php
            echo "<img width='128' height='128' src='/$user->profilePicture' class='img-radius' alt='User-Profile-Image'>";
            ?>
        </div>
    </div>

    <div style="padding: 20px 40px 60px 30px;">

        <div class="form_champ_page_login">
            <h2 class="user_pseudo" title="Nom d'utilisateur"><?php echo $user->pseudo ?></h2>
        </div>

        <hr style="width: 80%; text-align: center">

        <div class="form_champ_page_login">
            <h2 style="text-align: center" title="Nom d'utilisateur">Activité</h2>
        </div>

        <h3 style="text-align: center">C++ 20/20</h3>
        <h3 style="text-align: center">C++ 20/20</h3>
        <h3 style="text-align: center">C++ 20/20</h3>

    </div>
</div>
</body>
</html>

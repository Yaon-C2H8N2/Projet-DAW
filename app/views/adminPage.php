<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/Utility.php';

$user = getUser();

if (!$user->isAdmin) {
    header('Location: /index.php?controller=user&action=notFound');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <title>Administration</title>
</head>

<body>
<?php require_once '../app/views/navBar.php'; ?>

<div class="bouton_retour">
        <a href="/index.php?controller=user&action=getUserProfilePage">
        <img width="25" height="25" draggable="false" onselect="false" style="margin-left: 20px; margin-top: 20px"
             alt="Retour" title="Retour"
             src="/img/backto.png"
             class="back_button">
    </a>
</div>

<div class="div_main_page_create">
    <div class="form_titre_page_login">
        <div class="img_profil_create_container">
            <?php
            if ($user->profilePicture == 'default.png' or $user->profilePicture == null or strlen($user->profilePicture) <= 0 or !file_exists($user->profilePicture)) {
                echo "<img width='128' height='128' src='/img/default_user.png' class='img-radius' draggable='false' alt='User-Profile-Image'>";
            } else {
                echo "<img width='128' height='128' src='/$user->profilePicture' class='img-radius' draggable='false' alt='User-Profile-Image'>";
            }
            ?>
        </div>
    </div>

    <div style="padding: 20px 40px 60px 30px;">

        <div class="form_champ_page_login">
            <h2 class="user_pseudo" title="Nom d'utilisateur"><?php echo $user->pseudo . "<br>";
                echo $user->id ?></h2>
        </div>

        <hr style="width: 80%; text-align: center;">

        <p style="text-align: center; margin-top: 5%">
            <button class="bouton_recherche_user" onclick="window.location.href = '/index.php?controller=admin&action=getSearchUserPage'">Rechercher un utilisateur</button>
        </p>

        <p style="text-align: center">
            <button class="bouton_recherche_user" onclick="window.location.href = '/index.php?controller=admin&action=getQCMCreationPage'">Crée un QCM</button>
        </p>

        <p style="text-align: center">
            <button class="bouton_recherche_user" onclick="window.location.href = '/index.php?controller=admin&action=getCourseCreationPage'">Crée un cours</button>
        </p>

        <p style="text-align: center">
            <a href="/index.php?controller=admin&action=getResourcesPage" style="text-decoration: none">
                <button class="bouton_recherche_user" onclick="window.location.href ='/index.php?controller=admin&action=getResourcesPage'">Liste des ressources</button>
            </a>

        <p style="text-align: center">
            <a href="/index.php?controller=admin&action=getSiteManagementPage" style="text-decoration: none">
                <button class="bouton_recherche_user">Gérer le site</button>
            </a>
        </p>

    </div>
</div>
<script src="/js/UI_Theme.js"></script>
</body>
</html>



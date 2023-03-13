<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/Utility.php';

$user = getUser();

if (!$user->isAdmin) {
    header('Location: /404');
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Administration</title>
</head>

<body>
<?php require 'navBar.php'; ?>

<div class="bouton_retour">
    <a href="/compte">
        <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" alt="Retour" title="Retour"
             src="/img/backto.png"
             class="back_button">
    </a>
</div>


<h2 style="text-align: center">Connecté en tant qu'admin : <?php echo $user->pseudo ?></h2>

<div style="margin-top: 5%">
    <p style="text-align: center">
        <button class="bouton_recherche_user" onclick="searchUserPage()">Rechercher un utilisateur</button>
    </p>

    <p style="text-align: center">
        <button class="bouton_recherche_user" onclick="QCMPage()">Crée un QCM</button>
    </p>
</div>


<script>
    function searchUserPage() {
        window.location.href = "/admin/searchUser";
    }

    function QCMPage() {
        window.location.href = "/admin/qcmCreation";
    }
</script>
<script src="/js/UI_Theme.js"></script>
</body>
</html>



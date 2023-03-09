<?php

include_once '../app/models/DBManage.php';
include_once '../app/models/Utility.php';

$user = getUser();

if (!$user->isAdmin) {
    header('Location: /');
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
    <link id="link" rel="stylesheet" type="text/css" href="css/UI_Theme.css"/>
    <!--    <link id="link" rel="stylesheet" type="text/css" href="css/adminPage.css"/>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Administration</title>
</head>

<body>
<?php require 'navBar.php'; ?>

<div>
    <button onclick="searchUserPage()">Recherche d'utilisateur</button>
</div>

<script>
    function searchUserPage() {
        window.location.href = "/admin/searchUser";
    }
</script>
</body>
</html>



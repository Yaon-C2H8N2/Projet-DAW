<?php

include_once '../app/models/Utility.php';

$admin = getUser()->isAdmin;

if (!$admin) {
    header('Location: /', true, 301);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <title>Creation de Cours</title>
</head>
<?php require '../app/views/navBar.php'; ?>

<body style="margin-top: 10vh;">

<div class="bouton_retour">
    <a href="/admPage">
        <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" alt="Retour" title="Retour"
             src="/img/backto.png" class="back_button" draggable="false">
    </a>
</div>

<div class="main_div">
    <div style="display: flex;align-content: center;align-items: center;flex-direction: column">
        <div class="name_course_div">
            <input style="text-align: center;transform: scale(1.9); border-radius: 50px; border: none" type="text"
                   id="courseName"
                   placeholder="Nom du Cours" title="Le nom du Cours" required>
        </div>

        <div id="course"
             style="margin-top: 2%; height: 75vh;width: 90vh; display: flex; align-items: center; flex-direction: column;">
        </div>

        <div>
            <p style="text-align: center">
                <button type="button" id="saveCourse">Crée le Cours</button>
            </p>
        </div>
    </div>
</div>

<script src="/js/UI_Theme.js"></script>
<script src="/js/courseCreation.js"></script>
<script src="/js/utility.js"></script>
</body>
</html>

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
    <title>Creation de Cours</title>
</head>
<?php require '../app/views/navBar.php'; ?>

<body style="margin-top: 10vh;">

<div class="main_div">

    <form id="courseForm" method="post" action="/saveCourseController">
        <span class="context-menu-one btn btn-neutral">right click me</span>


        <div style="display: flex;align-content: center;align-items: center;flex-direction: column">
            <div class="name_course_div">
                <input style="text-align: center;transform: scale(1.9); border-radius: 50px; border: none" type="text"
                       id="courseName" name="courseName"
                       placeholder="Nom du Cours" title="Le nom du Cours" required>
            </div>

            <div id="course" style="margin-top: 2%; height: 75vh;width: 90vh">
                <menu style="display: flex;flex-direction: column;align-items: center;justify-content: center;align-content: center; height: 100%">
                    <li style="list-style: none; margin-bottom: 10px">
                        <button type="button" id="addChapter">Ajouter un chapitre</button>
                    </li>
                    <li style="list-style: none">
                        <button type="button" id="addQuestion">Ajouter une question</button>
                    </li>

            </div>

            <div>
                <p style="text-align: center">
                    <button type="button" id="addQuestion">Ajouter une question</button>
                </p>

                <p style="text-align: center">
                    <button type="submit" id="saveCourse">Crée le Cours</button>
                </p>
            </div>
        </div>
    </form>

    <script src="/js/courseCreation.js"></script>
</body>
</html>

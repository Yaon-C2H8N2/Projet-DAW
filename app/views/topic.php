<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href=""/>
    <title>Forum</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<div style="margin-top: 10vh">
    <?php
    foreach ($messages as $message) {
        echo '<div style="background-color: darkseagreen">';
        echo '<p>' . $message['pseudo'] . '</p>';
        echo '<p>' . $message['image_profil'] . '</p>';
        echo '<p>' . $message['content'] . '</p>';
        echo '<p>' . $message['date'] . '</p>';
        echo '</div>';
    }
    if (isset($_SESSION['userInfo'])) {
        echo '<form action="/createPostController" method="post">';
        echo '<input type="hidden" name="idtopic" value="' . $topicid . '">';
        echo '<textarea name="content" id="content" cols="30" rows="10" required></textarea><br>';
        echo '<input type="submit" value="Envoyer">';
        echo '</form>';
    }
    ?>
</div>
<script src="/js/UI_Theme.js"></script>
</body>
</html>

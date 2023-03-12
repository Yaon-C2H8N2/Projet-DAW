<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/forum.css"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>Forum</title>
</head>
<body>
<?php require 'navBar.php'; ?>

<div style="margin-top: 10vh">
    <?php
    if (isset($_SESSION['userInfo'])) {
        include "../app/models/User.php";
        $user = unserialize($_SESSION['userInfo']);
        echo '
            <p style="text-align: center">
                <a href="/createTopic" style="text-decoration: none; color: white">
                <button title="Créer un topic dans le forum" class="bouton_creer_forum">
                Créer un topic
                </button>
                </a> 
            </p>';
    } else {
        echo '
            <p style="text-align: center">
                <a href="/userAuth" style="text-decoration: none; color: white">
                <button title="Se connecter" class="bouton_creer_forum">
                Se connecter
                </button>
                </a> 
            </p>';
    }
    ?>
</div>
<table>

    <tr>
        <th><h2>Titre</h2></th>
        <th><h2>Auteur</h2></th>
        <th><h2>Dernier message</h2></th>
    </tr>

    <?php
    //TODO : fix this
    include "../app/models/DBManage.php";
    $dbc = new DBManage();
    $topics = $dbc->getTopics();
    $i = 0;
    foreach ($topics as $topic) {

        //effet de style pour alterner entre les couleurs
        if ($i % 2 == 0) echo '<tr style="background-color: #00ffc5;font-weight: bolder;">';
        else echo '<tr style="background-color: #00e1ff;font-weight: bolder;">';

        echo '<td title="Nom du topic"><h3><a href="/forum/' . $topic['idtopic'] . '"><button class="button_lien_topic">' . $topic['nom_topic'] . '</button></a></h3></td>';
        echo '<td title="Nom du créateur"><h3>' . $topic['pseudo'] . '</h3></td>';
        echo '<td><h3>' . substr($topic['lastmessage'], 0, 19) . '</h3></td>';
        echo '</tr>';
        $i++;
    }
    ?>
</table>
<script src="/js/UI_Theme.js"></script>
</body>
</html>

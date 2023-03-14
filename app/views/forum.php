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

<h1 style="text-align: center">Bienvenue sur la partie forum de Neptune</h1>

<div style="margin-top: 10vh">
    <?php
    if (isset($_SESSION['userInfo'])) {
        include "../app/models/User.php";
        $user = unserialize($_SESSION['userInfo']);
        echo '
            <p style="text-align: center">
                <a href="/createTopic" style="text-decoration: none; color: white">
                <button title="Créer un topic dans le forum" class="bouton_creer_forum">Créer un topic</button>
                </a> 
            </p>';
    } else {
        echo '
            <p style="text-align: center">
                <a href="/userAuth" style="text-decoration: none; color: white">
                <button title="Se connecter" class="bouton_creer_forum">Se connecter</button>
                </a> 
            </p>';
    }
    ?>
</div>
<table>

    <tr>
        <th><h2>Titre</h2></th>
        <th><h2>Messages</h2></th>
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

        $topicid = $topic['idtopic'];
        $nb_reponses = $dbc->getNbReponseToTopic(intval($topicid));

        //effet de style pour alterner entre les couleurs
        if ($i % 2 == 0) echo '<tr style="background-color: #00ffc5;font-weight: bolder; width: 100%">';
        else echo '<tr style="background-color: #00e1ff;font-weight: bolder;width: 100%">';

        if (isset($user->id) and $topic['idauteur'] == $user->id or $user->isAdmin) {
            echo '<td title="Nom du topic" style="width: 70%">
            <h3 style="">
                <a href="/forum/' . $topic['idtopic'] . '">
                    <button class="button_lien_topic">' . $topic['nom_topic'] . '</button>
                </a>
                <button style="width: 40px;height: 40px;" title="Supprimer le topic" class="img_delete_topic" ></button>
                </h3>
            </td>';
        } else {
            echo '<td title="Nom du topic" style="width: 70%">
            <h3>
                <a href="/forum/' . $topic['idtopic'] . '">
                    <button class="button_lien_topic">' . $topic['nom_topic'] . '</button>
                </a>
                </h3>
            </td>';
        }

        echo "<td style='text-align: center; width: 7%'><h3>$nb_reponses</h3></td>";
        echo '<td title="Nom du créateur" style="width: 10%"><h3>' . $topic['pseudo'] . '</h3></td>';

        $date_formatee = date("d-m-Y", strtotime($topic['lastmessage']));
        $heure_formatee = date("H\hi:s", strtotime($topic['lastmessage']));

        echo '<td style="width: 13%"><h3> ' . $heure_formatee . ' le ' . $date_formatee . '</h3></td>';
        echo '</tr>';
        $i++;
    }
    ?>
</table>
<script src="/js/UI_Theme.js"></script>
</body>
</html>

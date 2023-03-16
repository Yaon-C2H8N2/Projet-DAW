<?php
include_once "../app/models/DBManage.php";
$dbc = new DBManage();
$topics = $dbc->getTopics();
$i = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/forum.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Forum</title>
</head>
<body>
<?php require '../app/views/navBar.php'; ?>
<h1 style="text-align: center">Bienvenue sur la partie forum de Neptune</h1>

<div style="margin-top: 10vh">
    <?php
    if (isset($_SESSION['userInfo'])) {
        include_once "../app/models/User.php";
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
        <th style="width: 70%"><h2>Titre</h2></th>
        <th style="width: 3%"><h2>Messages</h2></th>
        <th style="width: 10%"><h2>Auteur</h2></th>
        <th style="width: 13%"><h2>Dernier message</h2></th>
    </tr>

    <?php

    foreach ($topics as $topic) {

        $topicid = $topic['idtopic'];
        $nb_reponses = $dbc->getNbReponseToTopic(intval($topicid));

        //effet de style pour alterner entre les couleurs
        if ($i % 2 == 0) echo '<tr style="background-color: #00ffc5;font-weight: bolder; width: 100%">';
        else echo '<tr style="background-color: #00e1ff;font-weight: bolder;width: 100%">';

        if (isset($user->id) and $topic['idauteur'] == $user->id or isset($user->isAdmin) and $user->isAdmin) {
            echo '<td title="Nom du topic" style="width: 70%">
            <h3 style="">
                <a href="/forum/' . $topic['idtopic'] . '">
                    <button class="button_lien_topic">' . $topic['nom_topic'] . '</button>
                </a>
                <button type="submit" onclick="DeleteTopic(' . $topicid . ',' . $topic["idauteur"] . ')" style="width: 40px;height: 40px;" title="Supprimer le topic" class="img_delete_topic" ></button>
                </h3>
            </td>';
        } else {
            echo '<td title="Nom du topic" style="width: 70%">
            <h3>
                <a href="/forum/' . $topic['idtopic'] . '">
                    <button class="button_lien_topic">' . $topic['nom_topic'] . '</button>
                </a>
                <button  style="width: 40px;height: 40px; background: transparent; border: none" disabled ></button>
                </h3>
            </td>';
        }

        echo "<td style='text-align: center; width: 7%'><h3>$nb_reponses</h3></td>";
        echo '<td title="Nom du créateur" style="width: 10%"><h3>' . $topic['pseudo'] . '</h3></td>';

        $date_formatee = date("d/m/Y", strtotime($topic['lastmessage']));
        $heure_formatee = date("H\hi:s", strtotime($topic['lastmessage']));

        echo '<td style="width: 13%"><h3> ' . $heure_formatee . ' le ' . $date_formatee . '</h3></td>';
        echo '</tr>';
        $i++;
    }
    ?>
</table>

<script>
    function DeleteTopic(idtopicJS, idauteurJS) {

        <?php
        if (isset($user->isAdmin) and $user->isAdmin) {
            echo "const admin = true;";
        }
        echo "const id = $user->id;";
        ?>

        if (typeof admin != 'undefined' && admin == "true" || typeof id != 'undefined' && idauteurJS == id) {
            console.log(idtopicJS + " topic id real");
            console.log(id + " id real");
            if (typeof admin != 'undefined' && admin == "true") {
                console.log(admin);
            }
            console.log("ID AUTEUR " + idauteurJS);

            $.ajax({
                url: '/deleteTopic',
                type: 'POST',
                dataType: 'text',
                data: {
                    idtopic: idtopicJS,
                    idauteur: id,
                },
            })
            setTimeout(function () {
                location.reload();
            }, 20);
        } else {
            console.log("PAS LE BON ID");
            fetch('https://api.ipify.org/?format=json')
                .then(response => response.json())
                .then(data => console.log(data.ip))
                .catch(error => console.error(error));
        }

    }
</script>

<script src="/js/UI_Theme.js"></script>
</body>
</html>

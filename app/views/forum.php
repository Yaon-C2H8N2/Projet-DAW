<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
    echo '<a href="/createTopic">Créer topic</a>';
}
?>
</div>
<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Dernier message</th>
    </tr>
    <?php
    //TODO : fix this
    include "../app/models/DBManage.php";
    $dbc = new DBManage();
    $topics = $dbc->getTopics();
    foreach ($topics as $topic) {
        echo '<tr>';
        echo '<td><a href="/forum/' . $topic['idtopic'] . '">' . $topic['nom_topic'] . '</a></td>';
        echo '<td>' . $topic['pseudo'] . '</td>';
        echo '<td>' . $topic['lastmessage'] . '</td>';
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>

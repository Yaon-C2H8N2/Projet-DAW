<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/topic.css"/>
    <title>Forum</title>
</head>
<body>
<?php require 'navBar.php'; ?>

<div style="margin-top: 10vh">

    <div class="bouton_retour">
        <a href="/forum">
            <img width="25" height="25" alt="Retour" title="Retour" src="/img/backto.png"
                 class="back_button">
        </a>
    </div>

    <?php
    $i = 0;
    foreach ($messages as $message) {

        $nb_reponses = $db->getNbReponseToTopic(intval($topicid));
        $nb_reponses -= 1;

        $image_url = $message['image_profil'];
        $pseudo_user = $message['pseudo'];
        $message_user = $message['content'];

        if ($i == 0) {
            echo '<div class="message_topic" style="background-color: #f8ad15;">';
            echo "<h2 style='text-align: center'>$message_user</h2>";

            if ($nb_reponses > 1) echo "<h2 style='text-align: center'>$nb_reponses réponses à ce topic</h2>";
            else echo "<h2 style='text-align: center'>$nb_reponses réponse à ce topic</h2>";

            echo "<p title='Photo de $pseudo_user'  style='text-align: center;'><img class='img_profil_topic' src='/$image_url' alt='Image de profil'></p>";
            echo '<h3 title="Pseudo du posteur" style="text-align: center"> Crée par ' . $message['pseudo'] . '</h3>';

            $date_formatee = date("d-m-Y", strtotime($message['date']));
            $heure_formatee = date("H:i:s", strtotime($message['date']));

            echo '<p> Envoyé à : ' . $heure_formatee . ' le ' . $date_formatee . ' </p>';
            echo '</div>';
        } else {

            if ($i % 2 == 0) echo '<div class="message_topic" style="background-color: #df1067;">';
            else echo '<div class="message_topic" style="background-color: #04dcad">';

            echo "<p title='Photo de $pseudo_user'  style='text-align: center;'><img class='img_profil_topic' src='/$image_url' alt='Image de profil'></p>";
            echo '<h3 title="Pseudo du posteur" style="text-align: center">' . $message['pseudo'] . '</h3>';
            echo "<h4 title='Reponse de $pseudo_user'> $pseudo_user a répondu : $message_user </h4>";

            $date_formatee = date("d-m-Y", strtotime($message['date']));
            $heure_formatee = date("H:i:s", strtotime($message['date']));
            echo '<p> Envoyé à : ' . $heure_formatee . ' le ' . $date_formatee . ' </p>';
            echo '</div>';
        }
        $i++;
    }

    //Si l'utilisateur est connecté
    if (isset($_SESSION['userInfo'])) {
        echo '<form action="/createPostController" class="form_topic" method="post">';
        echo '<input type="hidden" name="idtopic" value="' . $topicid . '">';
        echo "<textarea name='content' id='content' placeholder='Votre réponse à $pseudo_user' cols='70' rows='10' required></textarea><br>";
        echo '<input type="submit" class="bouton_envoyer_message_topic" value="Envoyer">';
        echo '</form>';
    }
    ?>
</div>
<script src="/js/UI_Theme.js"></script>
</body>
</html>

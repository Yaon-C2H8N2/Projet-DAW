<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();

if (isset($_SESSION['userInfo'])) {
    include_once "../app/models/User.php";
    $user = unserialize($_SESSION['userInfo']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/topic.css"/>
    <title>Forum</title>
</head>
<body>
<?php require 'navBar.php'; ?>

<div style="margin-top: 10vh">

    <div class="bouton_retour">
        <a href="/forum">
            <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" alt="Retour" title="Retour"
                 src="/img/backto.png" class="back_button">
        </a>
    </div>

    <?php

    foreach ($messages as $message) {
        $image_url = $message['image_profil'];
        $pseudo_user = $message['pseudo'];
        $message_user = $message['content'];
        $idmessage = $message['idmessage'];

        echo '<table>';
        echo '<tr>';
        echo '<td class="left_td">';

        if ($image_url == 'default.png' or $image_url == null or strlen($image_url) <= 0 or !file_exists($image_url)) {
            $image_url = "img/default_user.png";
        }
        echo "<p title='Photo de $pseudo_user'  style='text-align: center;'><img class='img_profil_topic' src='/$image_url' alt='Image de profil'></p>";
        echo '<h3 title="Pseudo du posteur" style="text-align: center">' . $message['pseudo'] . '</h3>';
        $date_formatee = date("d-m-Y", strtotime($message['date']));
        $heure_formatee = date("H\hi:s", strtotime($message['date']));
        echo '<p style="text-align: center"> Envoyé à : ' . $heure_formatee . ' le ' . $date_formatee . ' </p>';
        echo '</td>';

        echo "<td class='right_td'>";
        echo '<h3 title="Pseudo du posteur" style="text-align: justify-all; margin-right: 5%; margin-left: 5%">' . $message_user . '</h3>';

        if (isset($user->id) and isset($message['idauteur']) and $message['idauteur'] == $user->id or isset($user->isAdmin) and $user->isAdmin) {
            echo "<button type='submit' onclick='DeleteMessage($idmessage)' style='width: 40px;height: 40px;' title='Supprimer le message' class='img_delete_topic' ></button>";
        }
        echo "</td>";
        echo '</tr>';
    }
    echo '</table>';
    //Si l'utilisateur est connecté
    if (isset($_SESSION['userInfo'])) {
        echo '<form action="/createPostController" class="form_topic" method="post">';
        echo '<input  type="hidden" name="idtopic" value="' . $topicid . '">';
        echo "<textarea name='content' minlength='1'  title='Entrer votre message de réponse à $pseudo_user' id='content' placeholder='Votre réponse à $pseudo_user' cols='70' rows='10' required></textarea><br>";
        echo '<input type="submit" class="bouton_envoyer_message_topic" value="Envoyer">';
        echo '</form>';
    }
    ?>
</div>
<div class="lien_page_login" style="padding-bottom: 15%;"></div>

<script>
    function DeleteMessage(idmessageJS) {
        console.log(idmessageJS + " supprimé");
        $.ajax({
            url: '/deleteMessage',
            type: 'POST',
            dataType: 'text',
            data: {
                idmessage: idmessageJS
            },
        })
        setTimeout(function() {
            location.reload();
        }, 20);
    }
</script>

<script src="/js/UI_Theme.js"></script>
</body>
</html>

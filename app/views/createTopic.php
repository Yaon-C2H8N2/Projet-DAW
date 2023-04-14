<?php
if (isset($_SESSION['userInfo'])) {
    include_once "../app/models/User.php";
    $user = unserialize($_SESSION['userInfo']);
    //echo var_dump($user);
} else {
    header('Location: /userAuth', true, 301);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/createTopic.css"/>
    <title>Créer Topic</title>
</head>
<body>
<?php require_once '../app/views/navBar.php'; ?>
<script src="/js/UI_Theme.js"></script>

<div class="div_login_all">

    <div class="div_main_page_login">
        <div class="form_titre_page_login">Creation d'un nouveau topic</div>

        <form action="/createTopicController" class="form_create_topic" method="post">

            <div class="form_champ_page_login">
                <label></label><input type="text" name="title" id="title" placeholder="Nom du topic"
                                      title="Nom du topic" minlength="1" maxlength="50" required>
            </div>

            <h2 style="text-align: center; margin-top: 5%">Contenu du topic</h2>
            <textarea name="content" id="content" title="Contenu du topic que vous êtes en train de créer" minlength="1"
                      maxlength="256" cols="30" rows="10" required></textarea>

            <input type="submit" class="form_champ_page_login bouton_creer_forum" value="Créer">

        </form>

    </div>
</div>

</body>
</html>

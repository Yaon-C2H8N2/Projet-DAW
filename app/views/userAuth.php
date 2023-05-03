<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/userAuth.css"/>
    <title>Se connecter</title>
</head>

<body>
<?php require_once '../app/views/navBar.php'; ?>
<div class="div_login_all">

    <div class="div_main_page_login">
        <div class="form_titre_page_login">Neptune</div>
        <form action="/index.php?controller=auth&action=login" method="post">
            <div class="form_champ_page_login">
                <label for="email"></label><input type="email" id="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="form_champ_page_login">
                <label for="password"></label><input type="password" id="password" name="password"
                                                     placeholder="Mot de passe" required>
            </div>
            <div class="form_champ_page_login">
                <input type="submit" value="Connexion">
            </div>
            <div class="lien_page_login">Pas encore membre ?<a href="/index.php?controller=auth&action=getRegisterForm">S'inscrire</a></div>
            <div class="lien_page_login">Mot de passe oublié ?<a href="/forgotPassword">Aide</a></div>

        </form>
    </div>

</div>


<script src="/js/UI_Theme.js"></script>
<script src="/js/utility.js"></script>
<script>
    $('form').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/index.php?controller=auth&action=login',
            type: 'POST',
            data: formData,
            async: true,
            processData: false,
            contentType: false,
            success: function (response) {
                let data = JSON.parse(response);
                dialogBox(function () {
                    if (data["success"] === false)
                        return "Erreur";
                    else
                        window.location.href = "/";
                }, data['message']);
            }
        });
    });
</script>

</body>
</html>
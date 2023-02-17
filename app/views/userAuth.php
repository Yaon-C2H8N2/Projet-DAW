<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="img/neptune_icon.png" />
    <link id="link" rel="stylesheet" type="text/css" href="css/dark_mode.css" />
    <title>Se connecter</title>
</head>

<body>
    <?php require 'navBar.php'; ?>

    <div class="div_login_all">

        <div class="div_main_page_login">
            <div class="form_titre_page_login">Neptune</div>
            <form action="/authController" method="post">
                <div class="form_champ_page_login">
                    <input type="email" id="email" placeholder="E-mail" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="password" id="password" placeholder="Mot de passe" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="submit" value="Connexion">
                </div>
                <div class="lien_page_login">Pas encore membre ?<a href="/userCreate"> S'inscrire</a></div>
                <div class="lien_page_login">Mot de passe oublié ?<a href="/forgotPassword"> Aide</a></div>

            </form>
        </div>

    </div>

    <!--ANCIENNE VERSION-->
    <!---->
    <!--<div class="form_container">-->
    <!--    <form action="/authController" method="post">-->
    <!--        <label for="mail">Adresse Mail</label>-->
    <!--        <input type="email" name="mail" id="mail" required>-->
    <!--        <label for="password">Mot de passe</label>-->
    <!--        <input type="password" name="password" id="password" required>-->
    <!--        <input type="submit" value="Connexion">-->
    <!--    </form>-->
    <!--    <br>-->
    <!--    <a href="/userCreate">S'inscrire</a><br>-->
    <!--    <a href="/forgotPassword">Mot de passe oublié</a>-->
    <!--</div>-->
</body>
<script src="js/UI_Theme.js"></script>

</html>
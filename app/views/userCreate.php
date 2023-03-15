<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/userCreate.css"/>
    <title>S'inscrire</title>
</head>

<body>
<?php require 'navBar.php'; ?>


<div class="div_main_page_create">
    <div class="form_titre_page_login">
        Votre profil
        <div class="img_profil_create_container">

            <input type="file" id="inputImg" accept="image/*" style="display: none" onchange="inputImgChange()">
            <img id="img_create_profil" src="/img/default_user.png" onclick="changeImg()"
                 class="img_profil_create"
                 alt="User-Profile-Image">
        </div>
    </div>

    <form action="/creationController" method="post">

        <div class="form_champ_page_login">
            <input type="text" name="username" id="username"
                   placeholder="Nom d'utilisateur" title="Entrez votre nom d'utilisateur" minlength="3"
                   maxlength="20" required>
        </div>
        <div class="form_champ_page_login">
            <input type="text" name="firstname" minlength="1" id="firstname" title="Entrez votre prénom"
                   pattern="[A-Za-z]+"
                   placeholder="Prénom" required>
        </div>

        <div class="form_champ_page_login">
            <input type="text" name="lastname" minlength="1" id="lastname" title="Entrez votre nom"
                   pattern="[A-Za-z]+"
                   placeholder="Nom" required>
        </div>

        <div class="form_champ_page_login double_input_on_inline">

            <input type="email" name="mail" id="mail" placeholder="E-mail" title="Entrez votre adresse mail"
                   pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$" oninput="TestEmailValidity()"
                   required>

            <input type="email" name="mail-confirm" id="mail-confirm" placeholder="Confirmer votre mail"
                   title="Vous devez confirmer votre mail"
                   pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$" required>
        </div>


        <div class="form_champ_page_login double_input_on_inline">

            <input type="password" name="password" id="password" minlength="8" size="8"
                   title="Le mot de passe n'est pas très solide"
                   placeholder="Mot de passe"
                   oninput="TestPasswordValidity()" required>


            <input type="password" name="password-confirm" id="password-confirm" minlength="8" size="8"
                   title="Le mot de passe n'est pas très solide"
                   placeholder="Confirmer le mot de passe"
                   required>
        </div>

        <div class="form_champ_page_login">
            <input type="date" name="birthdate" id="birthdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                   title="La date doit être sous la forme jour/mois/année" minlength="10" maxlength="10"
                   min="1900-01-01" max="2199-01-01" required>
        </div>

        <div class="form_champ_page_login">
            <input type="submit" value="Créer">
        </div>
    </form>
</div>


<div>

    <div class="lien_page_login" style="position: absolute;
    top: 120%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
padding-bottom: 5%;">
        <h3>
            Déjà membre ?
        </h3>
        <a href="/userAuth">
            Se connecter</a>
    </div>

</div>
<script src="js/userCreate.js"></script>
<script src="js/UI_Theme.js"></script>
<script src="/js/utility.js"></script>
</body>
</html>
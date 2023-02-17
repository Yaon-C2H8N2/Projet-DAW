<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="img/neptune_icon.png" />
    <link id="link" rel="stylesheet" type="text/css" href="css/dark_mode.css" />
    <title>S'inscrire</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <?php require 'navBar.php'; ?>

    <!-- AVANT -->
    <!-- <div class="form_container">
    <form action="/creationController" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required><br>
        <fieldset name="nomPrenom">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" required><br>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" required>
        </fieldset>
        <fieldset name="mail">
            <label for="mail">Adresse Mail</label>
            <input type="email" name="mail" id="mail" required><br>
            <label for="mail">Confirmer adresse Mail</label>
            <input type="email" name="mail-confirm" id="mail-confirm" required>
        </fieldset>
        <fieldset name="pass">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required><br>
            <label for="password">Confirmer mot de passe</label>
            <input type="password" name="password-confirm" id="password-confirm" required><br>
        </fieldset>
        <label for="birthdate">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</div> -->



    <div class="div_login_all">

        <div class="div_main_page_login">
            <div class="form_titre_page_login">Profil</div>
            <form action="/creationController" method="post">
                <div class="form_champ_page_login">
                    <input type="text" name="username" id="username" title="Entrez votre nom d'utilisateur" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="text" name="firstname" id="firstname" title="Entrez votre prénom" required pattern="[A-Za-z]+" placeholder="Prénom" required>
                </div>

                <div class="form_champ_page_login">
                    <input type="text" name="lastname" id="lastname" title="Entrez votre nom" required pattern="[A-Za-z]+" placeholder="Nom" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="email" name="mail" id="mail" placeholder="E-mail" title="Entrez votre adresse mail" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="email" name="mail-confirm" id="mail-confirm" placeholder="Confirmer votre mail" title="Vous devez confirmer votre mail" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$" required>
                </div>

                <div class="form_champ_page_login">
                    <input type="password" name="password" id="password" minlength="8" size="8" title="Doit contenir au moins 1 majuscule et minuscule, 1 nombre et 1 caractère spécial" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Mot de passe" required>
                </div>
                <div class="form_champ_page_login">
                    <input type="password" name="password-confirm" id="password-confirm" minlength="8" size="8" title="Doit contenir au moins 1 majuscule et minuscule, 1 nombre et 1 caractère spécial" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirmer le mot de passe" required>
                </div>

                <div class="form_champ_page_login">
                    <input type="date" name="birthdate" id="birthdate" required pattern="[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}" title="La date doit être sous la forme jour/mois/année" required>
                </div>

                <div class="form_champ_page_login">
                    <input type="submit" value="Créer">
                </div>

            </form>
        </div>

    </div>

</body>
<script src="js/userCreate.js"></script>
<script src="js/UI_Theme.js"></script>

</html>
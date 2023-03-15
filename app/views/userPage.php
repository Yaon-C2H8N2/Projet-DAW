<?php

include_once '../app/models/User.php';

if (!isset($_SESSION['userInfo'])) {
    header('Location: /userAuth', true, 301);
    exit();
}

include_once '../app/models/DBManage.php';

//print user id
$user = unserialize($_SESSION['userInfo']);
$db = new DBManage();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/userPage.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Modification du Compte</title>
</head>
<body>
<?php require 'navBar.php'; ?>

<form id="userForm">

    <div class="div_padding">
        <div class="card user-card-div">
            <div class="div_card_user user-profile">
                <div class="card-div ">
                    <a href="/compte">
                        <img width="25" height="25" alt="Retour" title="Retour" src="/img/backto.png"
                             class="back_button">
                    </a>

                    <div id="imgcontainer">
                        <input type="file" onchange="saveImg()" id="inputImg" accept="image/*" style="display: none">
                        <img id="imgUser" onclick="changeImg()" alt="Image de profil" src="<?php
                        if ($user->profilePicture == 'default.png' or $user->profilePicture == null or !file_exists($user->profilePicture)) {
                            echo "/img/default_user.png";
                        } else {
                            echo $user->profilePicture;
                        } ?>">
                    </div>

                    <p style="text-align: center;" title="Pseudo">
                        <input type="text" name="pseudo" id="pseudo" style="text-align: center" minlength="3"
                               maxlength="20"
                               value="<?php echo $user->pseudo; ?>" required><br>
                        <output id="pseudoOut" style="color: red"></output>
                    </p>
                </div>
            </div>

            <div class="card-div">
                <h2 class="titre_section">Informations</h2>

                <h3 class="titre_element">Identifiant</h3>
                <h5 class="text_element" title="Identifiant"><?php echo $user->id; ?></h5>

                <h3 class="titre_element">Nom</h3>
                <input type="text" placeholder="Entrer un nouveau nom" name="lastname" id="lastname" pattern="[A-Za-z]+"
                       value="<?php echo $user->lastName; ?>" required>

                <h3 class="titre_element">Prénom</h3>
                <input type="text" placeholder="Entrer un nouveau prénom" name="firstname" id="firstname"
                       pattern="[A-Za-z]+" minlength="1"
                       value="<?php echo $user->firstName; ?>" required>

                <h3 class="titre_element">Email</h3>
                <input type="email" placeholder="Entrer un nouvel email" name="email" id="email"
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$" minlength="1"
                       value="<?php echo $db->getLoginFromId($user->id)['login'] ?>" required>
                <output id="emailOut" style="color: red"></output>


                <h3 class="titre_element">Mot de passe</h3>
                <div class="element_inline" title="Mot de passe">

                    <div class="element_inline">
                        <h4>Ancien mot de passe</h4>
                        <input type="password" name="password" id="password" value="">
                    </div>

                    <div class="element_inline">
                        <h4>Nouveau mot de passe</h4>
                        <input type="password" minlength="8" name="newPassword" id="newPassword" value="">

                    </div>
                    <div class="element_inline">
                        <h4>Confirmer mot de passe</h4>
                        <input type="password" name="passwordConfirm" id="passwordConfirm" minlength="8" value="">
                    </div>
                </div>

                <h3 class="titre_element">Date de Naissance</h3>
                <input type="date" name="birthdate" id="birthdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                       title="La date doit être sous la forme jour/mois/année" minlength="10" maxlength="10"
                       min="1900-01-01" max="2199-01-01" value="<?php echo $user->birthDate; ?>" required>

                <div class="button_container_modifier">

                    <a href="/compte">
                        <input type="button" value="Quitter">
                    </a>

                    <input type="submit" value="Modifier">

                </div>
            </div>
        </div>
    </div>
</form>


<dialog id="dialogUser">
    <h3 id="dialogUserText"></h3>
    <button id="dialogUserBtn" title="Fermer la fenêtre">Fermer</button>
</dialog>

</body>
<script src="/js/UI_Theme.js"></script>
<script src="/js/userPage.js"></script>
<script src="/js/utility.js"></script>
</html>


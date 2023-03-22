<?php

include_once '../app/models/User.php';
include_once '../app/models/Utility.php';
include_once '../app/models/DBManage.php';

//print user id
$user = getUser();
$db = new DBManage();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/user_Profil_Page.css"/>
    <title>Compte</title>
</head>
<body>
<?php require '../app/views/navBar.php'; ?>
<div class="div_padding">
    <div class="card user-card-div">
        <div class="div_card_user user-profile">
            <div class="card-div ">
                <div id="userPage_img_container">
                    <a href="/userPage">
                        <img id="userPage_imgUser" title="Modifier le compte" src=<?php
                        if ($user->profilePicture == 'default.png' or $user->profilePicture == null or strlen($user->profilePicture) <= 0 or !file_exists($user->profilePicture)) {
                            echo "/img/default_user.png";
                        } else {
                            echo $user->profilePicture;
                        } ?>  class="img-radius" alt="User-Profile-Image">
                    </a>
                </div>
                <h2 style="text-align: center; font-weight: 900;" title="Pseudo"><?php echo $user->pseudo; ?>
                </h2>

                <a href='/userPage' class="bouton_edit_profile" title="Modifier le compte">
                    <img src="/img/edit-button.png" class="img_edit_profile">
                </a>
            </div>
        </div>

        <div class="container_info">


            <div>
                <h2 class="titre_section">Informations</h2>

                <h3 class="titre_element">Nom</h3>
                <h4 class="text_element" title="Nom"><?php echo $user->lastName; ?></h4>

                <h3 class="titre_element">Prénom</h3>
                <h4 class="text_element" title="Prénom"><?php echo $user->firstName; ?></h4>

                <h3 class="titre_element">Email</h3>
                <h4 class="text_element" title="Email"><?php echo $db->getLoginFromId($user->id)['login'] ?></h4>

                <h3 class="titre_element">Date de Naissance</h3>
                <h4 class="text_element"
                    title="Date de Naissance"><?php echo date("d/m/Y", strtotime($user->birthDate)); ?></h4>

                <h3 class="titre_element">Age</h3>
                <h4 class="text_element" title="Age">
                    <?php
                    /**
                     * @details Fonction qui calcul l'âge de l'utilisateur et qui l'affiche
                     * @param $date_naissance
                     * @return int
                     * @throws Exception
                     */
                    function calculer_age($date_naissance)
                    {
                        return date_diff(new DateTime($date_naissance), new DateTime())->y;
                    }

                    try {
                        echo calculer_age($user->birthDate);
                    } catch (Exception $e) {
                        echo "Impossible de calculer la date de naissance";
                    } ?>

                </h4>
            </div>

            <div>
                <h2 class="titre_section">Activités</h2>

                <p class="titre_element">Récent</p>
                <h6 class="text_element hidden_element_from_vue">C++</h6>

                <p class="titre_element">Dernière notes</p>
                <h6 class="text_element hidden_element_from_vue">20/20</h6>


                <h2 class="titre_section">Statistiques</h2>

                <p class="titre_element">Nombres de qcm réalisé</p>
                <h6 class="text_element hidden_element_from_vue"><?php echo $db->getNBQCMForUser($user->id) ?></h6>

                <p class="titre_element">Meilleure note obtenue</p>
                <h6 class="text_element hidden_element_from_vue"><?php echo $db->getMaxNoteForUser($user->id) ?></h6>

                <p class="titre_element">Dernière notes</p>
                <h6 class="text_element hidden_element_from_vue">20/20</h6>
            </div>
        </div>
    </div>
</div>

<p style="text-align: center">
    <button class="bouton bouton_rouge" onclick="Dialog_DEL_ON()">Supprimer le compte</button>
</p>

<div id="dialog_delete_compte" class="dialog">

    <div class="dialog_contenu">
        <h2 style="text-align: center; text-transform: uppercase; color: #4451dd">Êtes-vous sûr de vouloir supprimer
            votre compte ?</h2>
        <div class="button_container">
            <button class="button_choice yes_button" onclick="Oui()">Oui</button>
            <button class="button_choice no_button" onclick="Dialog_DEL_OFF()">Non</button>
        </div>
    </div>
</div>

<script src="/js/utility.js"></script>
<script>
    function Dialog_DEL_ON() {
        document.getElementById("dialog_delete_compte").style.display = "block";
    }

    function Oui() {
        let id = {id: <?php echo json_encode($user->id);?>};
        $.ajax({
            url: '/deleteUser',
            type: 'POST',
            data: {user: JSON.stringify(id, null, '\t')},
            success: function (data) {
                let json = JSON.parse(data);
                if (json.success === true)
                    dialogBox("Succès", "Votre compte a bien été supprimé", function () {
                        window.location.href = "/";
                    });
                else
                    dialogBox("Erreur", "Une erreur est survenue lors de la suppression de votre compte", function () {
                        window.location.href = "/";
                    });
            }
        })
        document.getElementById("dialog_delete_compte").style.display = "none";
    }

    function Dialog_DEL_OFF() {
        document.getElementById("dialog_delete_compte").style.display = "none";
    }
</script>

<?php
if ($user->isAdmin):?>
    <p style="text-align: center; margin-top: 3%">
        <button class="bouton_admin" title="Accéder à la page des admin" onclick="window.location.href = '/admPage'">
            ADMIN
        </button>
    </p>
<?php endif; ?>
<script src="/js/UI_Theme.js"></script>
<script src="/js/AnimationOnScroll.js"></script>
</body>
</html>
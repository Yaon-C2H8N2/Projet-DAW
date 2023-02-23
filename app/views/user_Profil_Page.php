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
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/light_mode.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/user_Profil_Page.css"/>
    <title>Compte</title>
</head>
<body>
<?php require 'navBar.php'; ?>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div id="userPage_img_container">
                                    <img id="userPage_imgUser" title="Votre photo de profil" src=<?php
                                    if ($user->profilePicture == 'default.png' or $user->profilePicture == null or strlen($user->profilePicture) <= 0 or !file_exists($user->profilePicture)) {
                                        echo "img/default_user.png";
                                    } else {
                                        echo $user->profilePicture;
                                    } ?>  onclick="" class="img-radius"
                                         alt="User-Profile-Image">
                                </div>
                                <h6 class="f-w-600" style="text-align: center"
                                    title="Pseudo"><?php echo $user->pseudo; ?></h6>
                                <!--                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>-->
                                <!--                                <p title="Identifiant"> -->
                                <?php //echo $user->id; ?><!--</p>-->

                                <a href='/userPage' class="bouton_edit_profile" title="Modifier le compte">
                                    <img src="/img/edit-button.png" title="Modifier le compte" class="img_edit_profile">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h2 class="m-b-20 p-b-5 b-b-default f-w-600">Informations</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Identifiant</p>
                                        <h6 class="text-muted f-w-400" title="Identifiant"><?php echo $user->id; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Nom</p>
                                        <h6 class="text-muted f-w-400" title="Nom"><?php echo $user->lastName; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Prénom</p>
                                        <h6 class="text-muted f-w-400"
                                            title="Prénom"><?php echo $user->firstName; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400"
                                            title="Email"><?php echo $db->getLoginFromId($user->id)['login'] ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Date de Naissance</p>
                                        <h6 class="text-muted f-w-400"
                                            title="Date de Naissance"><?php echo $user->birthDate; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Age</p>
                                        <h6 class="text-muted f-w-400" title="Age">
                                            <?php
                                            /**
                                             * @details Fonction qui calcul l'âge de l'utilisateur et qui l'affiche
                                             * @param $date_naissance
                                             * @return int
                                             * @throws Exception
                                             */
                                            function calculer_age($date_naissance)
                                            {
                                                $interval = date_diff(new DateTime($date_naissance), new DateTime());
                                                return $interval->y;
                                            }

                                            try {
                                                echo calculer_age($user->birthDate);
                                            } catch (Exception $e) {
                                                echo "Impossible de calculer la date de naissance";
                                            } ?>

                                        </h6>
                                    </div>
                                </div>
                                <h2 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Activités</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Récent</p>
                                        <h6 class="text-muted f-w-400">C++</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Dernière notes</p>
                                        <h6 class="text-muted f-w-400">20/20</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/UI_Theme.js"></script>

</body>


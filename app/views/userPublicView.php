<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?php echo $user->pseudo; ?></title>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/userPublicView.css"/>
    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
</head>
<body>

<?php require '../app/views/navBar.php'; ?>

<div class="bouton_retour">
    <img width="25" height="25" onclick="goBack()" style="margin-left: 20px; margin-top: 20px" draggable="false"
         onselect="false" alt="Retour" title="Retour"
         src="/img/backto.png" class="back_button">
</div>
<div class="div_main_page_create">
    <div class="form_titre_page_login">
        <div class="img_profil_create_container">
            <?php
            if ($user->profilePicture == 'default.png' or $user->profilePicture == null or strlen($user->profilePicture) <= 0 or !file_exists($user->profilePicture)) {
                echo "<img width='128' height='128' src='/img/default_user.png' class='img-radius' draggable='false' alt='Photo'>";
            } else {
                echo "<img width='128' height='128' src='/$user->profilePicture' class='img-radius' draggable='false' alt='Photo'>";
            }
            ?>
        </div>
    </div>

    <div style="padding: 20px 40px 60px 30px;">

        <div class="form_champ_page_login">
            <?php
            if ($user->isAdmin) echo "<h1 class='user_pseudo' title='Nom dutilisateur'>" . $user->pseudo . "<img width='25' height='25' src='/img/certification.png' style='vertical-align:middle; margin-left: 3px' title='Profil admin' draggable='false'> </h1>";
            else echo "<h1 class='user_pseudo' title='Nom dutilisateur'>" . $user->pseudo . "</h1>";
            ?>
        </div>

        <hr style="width: 80%; text-align: center">

        <div class="form_champ_page_login">
            <h2 style="text-align: center" title="Nom d'utilisateur">Activité</h2>
        </div>

        <div class="div_list_note">

            <div class="last_note">
                <h2 title="Note du dernier QCM"><?php echo $db->getLastNoteForUser($user->id) ?>/20</h2>
            </div>
            <div class="best_note">
                <h2 title="Meilleure note"><?php echo $db->getMaxNoteForUser($user->id) ?>/20</h2>
            </div>
            <div class="last_note">
                <h2 title="Nombre de QCM réalisé"><?php echo $db->getNBQCMForUser($user->id) ?></h2>
            </div>
        </div>

        <div class="div_list_note">

            <div>
                <img width="72" height="72" src="/img/history.png" title="Note du dernier QCM" alt="Image"
                     draggable="false">
            </div>
            <div>
                <img width="72" height="72" src="/img/trophy.png" title="Meilleure note" alt="Image" draggable="false">
            </div>
            <div>
                <img width="72" height="72" src="/img/qcm.png" title="Nombre de QCM réalisé" alt="Image"
                     draggable="false">
            </div>
        </div>

    </div>
</div>
<script src="/js/UI_Theme.js"></script>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<?php if ($admin) : ?>
    <script src="/js/utility.js"></script>
    <script src="/js/adminUtility.js"></script>
    <script>
        $(function () {
            $.contextMenu({
                selector: 'img',
                callback: function (key, options) {
                    if (key === 'delete') {
                        // create json object with user info
                        let data = {
                            'id': <?php echo json_encode($user->id); ?>,
                            'isAdmin': <?php echo json_encode($user->isAdmin); ?>,
                        };
                        // send json object to server
                        deleteUser(data);
                    }
                },
                items: {
                    'delete': {name: 'Delete', icon: 'delete'},
                }
            });
        });
    </script>
<?php endif; ?>
</body>
</html>

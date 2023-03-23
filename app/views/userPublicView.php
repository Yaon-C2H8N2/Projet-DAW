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
    <script src="/js/UI_Theme.js"></script>
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

            $photo = "";

            if ($user->profilePicture == 'default.png' or $user->profilePicture == null or strlen($user->profilePicture) <= 0 or !file_exists($user->profilePicture)) {

                $photo = "/img/default_user.png";
            }
            echo "<img width='128' height='128' src='$photo' class='img-radius' alt='Photo'>";
            ?>
        </div>
    </div>

    <div style="padding: 20px 40px 60px 30px;">

        <div class="form_champ_page_login">
            <h2 class="user_pseudo" title="Nom d'utilisateur"><?php echo $user->pseudo ?></h2>
        </div>

        <hr style="width: 80%; text-align: center">

        <div class="form_champ_page_login">
            <h2 style="text-align: center" title="Nom d'utilisateur">Activité</h2>
        </div>

        <h3 style="text-align: center">C++ 20/20</h3>
        <h3 style="text-align: center">C++ 20/20</h3>
        <h3 style="text-align: center">C++ 20/20</h3>

    </div>
</div>
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

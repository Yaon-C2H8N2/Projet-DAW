<?php
include_once "../app/models/DBManage.php";
$dbc = new DBManage();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Gestion des utilisateurs</title>
</head>
<body>
<?php require '../app/views/navBar.php'; ?>

<div class="bouton_retour">
    <img width="25" height="25" onclick="goBack()" style="margin-left: 20px; margin-top: 20px" draggable="false"
         onselect="false" alt="Retour" title="Retour"
         src="/img/backto.png" class="back_button">
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<h1 style="text-align: center">Page de gestion du site</h1>

<table>

    <tr>
        <th style="width: 70%"><h2>Info</h2></th>
        <th style="width: 30%"><h2>Stats</h2></th>
    </tr>

    <tr>
        <td>Nombre utilisateur</td>
        <td><?php echo $dbc->getNBUser() ?></td>
    </tr>

    <tr>
        <td>Nombre de QCM</td>
        <td><?php echo $dbc->getNBForumOnSite() ?></td>
    </tr>

    <tr>
        <td>Nombre de message</td>
        <td><?php echo $dbc->getNBMessage() ?></td>
    </tr>


    <tr>
        <td>Nombre de cours</td>
        <td><?php echo $dbc->getNbCours() ?></td>
    </tr>

    <tr>
        <td>QCM réalisé</td>
        <td><?php echo $dbc->getQCM_Done(); ?></td>
    </tr>

    <tr>
        <td>Ajouter des utilisateurs</td>
        <td>
            <input type="number" id="number_to_add" pattern="[1-9]+">
            <button class="bouton bouton_blanc" onclick="AddUser()">Ajouter un nombre de personne</button>
        </td>
    </tr>

</table>


<script src="/js/UI_Theme.js"></script>

<script>
    function AddUser() {
        var user_add = document.getElementById("number_to_add").value;
        if (user_add > 0) {

            <?php
            for ($i = 0; $i < 50; $i++) {
                $dbc->generateUser();
            }
            ?>

            setTimeout(function () {
                location.reload();
            }, 20);
            console.log("Ajout de " + user_add + " nouveaux utilisateurs aléatoire");

        } else console.log("Aucune valeur");
    }

</script>
</body>
</html>

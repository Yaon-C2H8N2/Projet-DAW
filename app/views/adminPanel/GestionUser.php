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
        <td>Ajouter des utilisateurs</td>
        <td>
            <button onclick="AddUser()">Ajouter 10 nouveaux</button>
        </td>
    </tr>

</table>


<script src="/js/UI_Theme.js"></script>

<script>
    function AddUser() {

        <?php
        for ($i = 0; $i < 10; $i++) {
            $dbc->generateUser();
        }
        ?>
        console.log("Ajout de nouveaux utilisateurs aléatoire");
        window.location.reload();
    }

</script>
</body>
</html>

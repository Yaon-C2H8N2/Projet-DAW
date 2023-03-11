<?php
include_once '../app/models/DBManage.php';
include_once '../app/models/User.php';
include_once '../app/models/Utility.php';

$user = getUser();
if (!$user->isAdmin) {
    header('Location: /', true, 301);
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/UI_Theme.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Recherche d'utilisateur</title>
</head>

<body style="margin-top: 10vh;">
<?php require '../app/views/navBar.php'; ?>

<div style="display: flex;align-content: center;justify-content: center">
    <input type="text" name="search" id="search" placeholder="Recherche"
           style="height: 2vh;border-radius: 1vh; width: 50%;font-size: 20px;padding: 5px;">
</div>

<div id="result" style="margin-top: 5vh; display: flex;flex-direction: row;flex-wrap: wrap;"></div>

<script>

    let userBox = (data) => {
        let box = $("<div></div>");
        box.append("<img src='../" + data.image_profil + "' style='width: 64px;height: 64px;'>");
        box.append("<p>Id : " + data.iduser + ", Pseudo : " + data.pseudo + "</p>");
        box.append("<p>Nom : " + data.nom + ", prénom : " + data.prenom + "</p>");
        box.append("<p>Date de naissance : " + data.date_naissance + "</p>");
        box.css({
            "border": "1px solid black", "border-radius": "5px",
            "padding": "5px", "margin": "5px", "cursor": "pointer",
            "display": "flex", "flex-direction": "column", "align-items": "center",
            "min-width": "fit-content"
        });
        box.hover(function () {
            box.css("background-color", "lightgrey");
        }, function () {
            box.css("background-color", "white");
        });
        box.bind("click", function () {
            // get to user profile
            window.location.href = "userProfile.php?id=" + data.iduser;
        });
        return box;
    }

    $("#search").on("input", async function () {
        $("#result").children().remove();
        let formData = new FormData();
        formData.append("pseudo", $(this).val());
        let res = await $.ajax({
            url: "/admin/searchUserController",
            type: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false
        });
        if (res === "" || res === "[]") {
            $("#result").append("<p>Aucun résultat</p>");
            return;
        }
        console.log(res);
        $.each(JSON.parse(res), function (key, value) {
            $("#result").append(userBox(value));
        });
    });
</script>

</body>
</html>


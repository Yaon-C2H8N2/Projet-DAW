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
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="css/adminPage.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Recherche d'utilisateur</title>
</head>

<body style="margin-top: 10vh;">
<?php require '../app/views/navBar.php'; ?>


<div class="bouton_retour">
    <a href="/admPage">
        <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" alt="Retour" title="Retour"
             src="/img/backto.png" class="back_button">
    </a>
</div>

<p style="text-align: center">
    <input type="text" name="search" id="search" placeholder="Rechercher un utilisateur"
           style="height: 2vh;border-radius: 1vh; width: 50%;font-size: 20px;padding: 5px;">
</p>

<h2 id="nb_trouve_search"></h2>

<div id="result" style="margin-top: 5vh; display: flex;flex-direction: row;flex-wrap: wrap;"></div>


<script>
    let userBox = (data) => {
        let box = $("<div'></div>");
        box.append("<img src='../" + data.image_profil + "' style='width: 64px;height: 64px; border: 1px solid white; padding: 5px; border-radius: 50px'>");
        box.append("<p>Id : " + data.iduser + ", Pseudo : " + data.pseudo + "</p>");
        box.append("<p>Nom : " + data.nom + ", Prénom : " + data.prenom + "</p>");
        box.append("<p>Date de naissance : " + data.date_naissance + "</p>");
        box.css({
            "background-color": "transparent",
            "color": "white",
            "border": "1px solid black",
            "border-radius": "5px",
            "margin-top": "15px",
            "cursor": "pointer",
            "display": "flex",
            "flex-direction": "column",
            "margin": "2vh",
            "padding": "2vh",
            "align-items": "center",
            "min-width": "fit-content"

        });
        box.hover(function () {
            box.css({
                "background-image": "linear-gradient(270deg, #ee7752, #e73c7e, #23a6d5, #23d5ab)",
            });
        }, function () {
            box.css({
                "background-image": "",
            });
        });

        box.bind("click", function () {
            window.location.href = "/userPublicView/" + data.iduser;
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
        $("#nb_trouve_search").children().remove();
        if (res === "" || res === "[]") {

            $("#nb_trouve_search").append("<h2 style='text-align: center; margin-top: 5%'>Aucun résultat</h2>");
            return;
        }
        let result = 0;

        // console.log(res);
        $.each(JSON.parse(res), function (key, value) {
            $("#result").append(userBox(value));
            result++;
        });
        let msg = $("<h2 style='text-align: center; margin-top: 2%'>Nombre de membres trouvés : " + result + "</h2>");
        $("#nb_trouve_search").append(msg);

    });

</script>
<script src="/js/UI_Theme.js"></script>
</body>
</html>


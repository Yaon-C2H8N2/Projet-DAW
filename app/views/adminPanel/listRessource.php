<?php
require_once '../app/models/DBManage.php';
require_once '../app/models/Utility.php';

$admin = getUser()->isAdmin;

if (!$admin) {
    header('Location: /unauthorized', true, 301);
    exit();
}

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
    <link rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <title>Creation d'un QCM</title>
</head>

<body>

<?php require '../app/views/navBar.php'; ?>

<div class="bouton_retour">
    <img width="25" height="25" onclick="goBack()" style="margin-left: 20px; margin-top: 20px" draggable="false"
         onselect="false" alt="Retour" title="Retour"
         src="/img/backto.png" class="back_button">
</div>

<div style="display: flex; justify-content:space-evenly; ">
    <button id="ressourceBtn" class="bouton bouton_vert">Afficher la liste</button>
</div>

<div id="ressources" style="display: flex; justify-content: center;flex-wrap: wrap">

</div>
</body>
<script src="/js/adminUtility.js"></script>
<script src="/js/utility.js"></script>
<script src="/js/UI_Theme.js"></script>
<script>
    var ressource = false;
    $('#ressourceBtn').click(afficherRessources);

    async function afficherRessources() {
        $('#ressources').empty();
        $.each(await (!ressource ? getAllQcm() : getAllCourse()), function (index, value) {
            let div = $('<div"></div>');
            div.css(
                {
                    width: '30vh',
                    height: 'fit-content',
                    padding: '2vh',
                    margin: '3vh',
                    border: '1px solid black',
                    borderRadius: '1vh',
                    display: 'flex',
                    alignItems: 'center',
                    flexDirection: 'column',
                }
            );
            div.hover(function () {
                div.css(
                    {
                        transform: 'scale(1.1)',
                        transition: 'transform 0.2s ease-in-out',
                        "background-color": "rgba(7,189,211,0.49)",
                        "box-shadow": "0 0 10px rgb(255, 255, 255)",
                    }
                );
            }, function () {
                div.css(
                    {transform: 'scale(1)', transition: 'transform 0.2s ease-in-out', "background-color": "transparent"}
                );
            });
            let id = $('<h2>Id : ' + value.id + '</h2>');
            let name = $('<h2>Nom : ' + value.path + '</h2>');
            let btnDiv = $('<div></div>');
            btnDiv.css(
                {
                    display: 'flex',
                    justifyContent: 'space-evenly',
                    width: '100%',
                }
            )
            let deleteBtn = $('<button class="bouton bouton_rouge">Supprimer</button>');
            deleteBtn.click(function () {
                ressource ? deleteQcm(value.id) : deleteCourse(value.id);
            });
            let showBtn = $('<button class="bouton bouton_bleu">Afficher</button>');
            showBtn.click(function () {
                let div = $('<div></div>');
                let iframe = $('<iframe></iframe>');
                iframe.css(
                    {width: '100%', height: '100%', border: 'none',}
                );
                iframe.attr('src', ressource ? '/qcm/' + value.id : '/cours/' + value.id);
                console.log(iframe.attr('src'));
                div.append(iframe);
                div.dialog({
                    title: 'QCM',
                    resizable: true,
                    position: {my: "center", at: "center", of: window},
                    width: window.innerHeight * 0.7,
                    height: window.innerHeight * 0.5,
                    modal: true,
                    close: function () {
                        $(this).dialog('close');
                    }
                });
            });
            div.append(id);
            div.append(name);
            btnDiv.append(showBtn);
            btnDiv.append(deleteBtn);
            div.append(btnDiv);
            $('#ressources').append(div);
        });
        ressource = !ressource;
        if (ressource) {
            $('#ressourceBtn').text('Afficher les QCM');
        } else {
            $('#ressourceBtn').text('Afficher les cours');
        }

    }
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>

<?php

if (!isset($_SESSION['userInfo'])) {
    header('Location: /index.php?controller=admin&action=unauthorized', true, 301);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/coursPanel.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Cours</title>
</head>
<body>

<?php require_once '../app/controllers/cours.php'; coursPanel(); ?>

<?php require_once '../app/views/navBar.php'; ?>

<div class="div_titre">
    <h1 class='gradient-border gradient-border-super'><p class='super' id="title_page"></p></h1>
</div>


<div id="ressources" style="margin-top: 5%;display: flex; justify-content: center;flex-wrap: wrap"></div>

<div style="margin-top: 10%;"></div>


<script src="/js/adminUtility.js"></script>
<script src="/js/utility.js"></script>
<script src="/js/UI_Theme.js"></script>
<script>
    afficherRessources();

    var ressource = true;
    $('#ressourceBtn').click(afficherRessources);
    $('#ressourceBtn').text('Afficher les cours');
    $("#title_page").text('Cours');

    async function afficherRessources() {
        $('#ressources').empty();
        $.each(await (!ressource ? getAllCourse() : getAllCourse()), function (index, value) {
            let div = $('<div></div>');
            div.css(
                {
                    width: '20%',
                    position: "relative",
                    minHeight: '20vh',
                    padding: '5vh',
                    margin: '3vh',
                    border: '1px solid black',
                    borderRadius: '1vh',
                    display: 'flex',
                    alignItems: 'center',
                    flexDirection: 'column',
                    "box-shadow": "0 0 10px rgb(255, 255, 255)",
                }
            );
            div.hover(function () {
                div.css(
                    {
                        transform: 'scale(1.1)',
                        transition: 'transform 0.2s ease-in-out',
                        "background-color": "rgba(7,189,211,0.84)",
                        "box-shadow": "0 0 10px rgb(255, 255, 255)",
                    }
                );
            }, function () {
                div.css(
                    {transform: 'scale(1)', transition: 'transform 0.2s ease-in-out', "background-color": "transparent"}
                );
            });

            let name = $('<h2>Nom du cours : ' + value.path.split(".")[0] + '</h2>');


            let btnDiv = $('<div></div>');
            btnDiv.css(
                {
                    display: 'grid',
                    "grid-template-columns": "repeat(2, 1fr)",
                    "grid-gap": "5%",
                    justifyContent: 'space-evenly',
                    width: '90%',
                    position: "absolute",
                    bottom: 10,
                    margin: "auto",
                }
            )
            let doBtn = $('<button class="bouton bouton_blanc" style="padding: 6px">Faire ce cours</button>');

            doBtn.click(function () {
                location.href = "/index.php?controller=cours&action=getCours&courseid=" + value.id;
            });

            let showBtn = $('<button class="bouton bouton_blanc">Afficher</button>');
            showBtn.click(function () {
                let div = $('<div></div>');
                let iframe = $('<iframe></iframe>');
                iframe.css(
                    {width: '100%', height: '100%', border: 'none',}
                );
                iframe.attr('src', ressource ? '/index.php?controller=qcm&action=getQCM&qcmid=' + value.id : '/index.php?controller=cours&action=getCours&courseid=' + value.id);
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
            div.append(name);
            btnDiv.append(showBtn);
            btnDiv.append(doBtn);
            div.append(btnDiv);
            $('#ressources').append(div);
        });
        ressource = !ressource;


    }
</script>

</body>
</html>
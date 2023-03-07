<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/home.css"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>Accueil</title>
</head>

<body>
<?php require 'navBar.php'; ?>
<div class="header">
    <h1>NEPTUNE</h1>
    <img src="img/neptune_512px.png" width="9%" height="9%" title="Logo de Neptune" alt="Logo"/>
    <blockquote>
        <p>"Le savoir est la seule chose qui s'accroît lorsqu'on le partage."</p>
    </blockquote>
</div>

<hr style="height: 2px; width: 50%; margin: auto"/>

<h2 style="text-align: center; margin-top: 2%">
    Voici les thématiques abordées sur Neptune
</h2>

<!-- PARTIE CONTENU -->
<div class="contenu">
    <div class="item">
        <a href="https://www.jetbrains.com/fr-fr/toolbox-app/" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
    <div class="item">
        <a href="https://www.jetbrains.com/fr-fr/toolbox-app/" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
    <div class="item">
        <a href="https://www.jetbrains.com/fr-fr/toolbox-app/" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>

    <div class="item">
        <a href="https://www.jetbrains.com/fr-fr/toolbox-app/" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
</div>

<div style="margin-top: 10%">

    <h2 style="text-align: center">Quelques stats provenant de Neptune</h2>
    <div class="contenu_stats_home hidden_element_from_vue">
        <div class="item_stats_home">
            <h2><?php echo $db->getNBUser(); ?></h2>
            <p>Nombre de membres sur le site</p>
        </div>
        <div class="item_stats_home">
            <h2><?php echo $db->getNBForumOnSite(); ?></h2>
            <p>Nombre de forums sur le site</p>
        </div>
        <div class="item_stats_home">
            <h2><?php echo $db->getNBMessage(); ?></h2>
            <p>Nombre de messages envoyés sur le site</p>
        </div>

        <div class="item_stats_home">
            <h2><?php echo $db->getQCM_Done(); ?></h2>
            <p>Nombre de QCM réalisé via notre site</p>
        </div>

    </div>

</div>

<div style="margin-top: 1%;">

    <div class="contenu_stats_home hidden_element_from_vue" style="grid-template-columns: repeat(3, 1fr);">
        <div class="item_stats_home" style="background: linear-gradient(150deg, #23d88f, #e33d8c, #049de0);">
            <h2><?php echo $db->getQCM_ToDo(); ?></h2>
            <p>Nombre de QCM à réaliser sur notre site</p>
        </div>

        <div class="item_stats_home" style="background: linear-gradient(150deg, #23d88f, #e33d8c, #049de0);">
            <h2>90%</h2>
            <p>Des personnes sont satisfaites par Neptune</p>
        </div>

        <div class="item_stats_home" style="background: linear-gradient(150deg, #23d88f, #e33d8c, #049de0);">
            <h2>100%</h2>
            <p>Des cours sont fait par des pro</p>
        </div>

    </div>

</div>


<!-- PARTIE FIN -->
<h2 style="text-align: center; margin-top: 5%">Inscrivez vous sur Neptune et bénéficiez de pleins d'avantages</h2>

<div class="fin_accueil">
    <div class="fin_accueil_liste hidden_element_from_vue" style="background-color: #00e1ff">

        <img src="img/Learn.png" width="50" height="50" alt="Image libre de droit"/>

        <h4 style="font-family: Arial, Helvetica, sans-serif">APPRENEZ</h4>

        <p style="font-style: italic; font-size: larger; padding: 2%">
            Apprenez sans limites avec des cours en ligne ! Avec un accès
            instantané à des experts dans leur domaine, vous pouvez développer
            vos compétences, explorer de nouvelles passions et atteindre vos
            objectifs à votre propre rythme, où que vous soyez avec nos vidéos
            et nos cours faciles à apprendre.
        </p>

    </div>
    <div class="fin_accueil_liste hidden_element_from_vue" style="background-color:  #00ffc5">

        <img src="img/Test_Yourself.png" width="50" height="50" alt="Image libre de droit"/>

        <h4 style="font-family: Arial, Helvetica, sans-serif">TESTEZ</h4>

        <p style="font-style: italic; font-size: larger;  padding: 2%">
            Testez vos connaissances et améliorez votre compréhension avec les
            QCM en ligne ! C'est un moyen rapide et efficace de mesurer votre
            progression, de découvrir vos points forts et de cibler vos domaines
            d'amélioration pour atteindre vos objectifs plus rapidement
        </p>
    </div>
    <div class="fin_accueil_liste hidden_element_from_vue" style="background-color:  #ff6a00">

        <img src="img/Conversation.png" width="50" height="50" alt="Image libre de droit"/>

        <h4 style="font-family: Arial, Helvetica, sans-serif">PARTAGEZ</h4>

        <p style="font-style: italic; font-size: larger;  padding: 2%">
            Partagez vos idées, posez des questions et découvrez les
            perspectives de milliers d'autres personnes en engageant la
            conversation sur les forums en ligne ! C'est une occasion unique de
            développer votre réseau, d'enrichir vos connaissances et de trouver
            des réponses à des questions qui vous tiennent à cœur.
        </p>

    </div>
</div>

<!-- BOUTON -->

<div style="margin-top: 3%">
    <p>
        <a href="/userCreate" class="accueil_lien_clic">
            <input type="button" value="EN SAVOIR PLUS" class="essayer"/>
        </a>
    </p>
</div>
<script src="/js/UI_Theme.js"></script>
<script src="/js/AnimationOnScroll.js"></script>


</body>
</html>
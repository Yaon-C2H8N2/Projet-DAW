<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>Accueil</title>
</head>

<body>
<?php require 'navBar.php'; ?>
<div class="header">
    <h1>NEPTUNE</h1>
    <img src="img/neptune_512px.png" width="9%" height="9%" alt="Logo"/>
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
        <a href="https://chat.openai.com/chat" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
    <div class="item">
        <a href="https://chat.openai.com/chat" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
    <div class="item">
        <a href="https://chat.openai.com/chat" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>

    <div class="item">
        <a href="https://chat.openai.com/chat" class="accueil_lien_clic">
            <div class="img_desc">
                <img src="img/neptune_icon.png" width="100%" height="100%" alt="Image"/>
            </div>
            <p>COURS</p>
        </a>
    </div>
</div>

<!-- BOUTON -->

<div style="margin-top: 10%">
    <p>
        <a href="../app/views/userCreate.php" class="accueil_lien_clic">
            <input type="button" value="EN SAVOIR PLUS" class="essayer"/>
        </a>
    </p>
</div>

<!-- PARTIE FIN -->

<div class="fin_accueil">
    <div class="fin_accueil_liste">
        <p style="
            background-color: #1dbeed;
            text-align: center;
            padding-bottom: 150px;
          ">
            <br/>
            <span>
                    <img src="img/Learn.png" width="50" height="50" alt="Image libre de droit"/>
                </span>
            <br/>
            <br/>
            <span style="font-family: Arial, Helvetica, sans-serif">APPRENEZ</span>
            <br/>
            <br/>
            <span style="font-style: italic; font-size: larger">
                    Apprenez sans limites avec des cours en ligne ! Avec un accès
                    instantané à des experts dans leur domaine, vous pouvez développer
                    vos compétences, explorer de nouvelles passions et atteindre vos
                    objectifs à votre propre rythme, où que vous soyez avec nos vidéos
                    et nos cours faciles à apprendre.
                </span>
        </p>
    </div>
    <div class="fin_accueil_liste">
        <p style="background-color: #ff6121; padding-bottom: 150px">
            <br/>
            <span>
                    <img src="img/Test_Yourself.png" width="50" height="50" alt="Image libre de droit"/>
                </span>
            <br/>
            <br/>
            <span style="font-family: Arial, Helvetica, sans-serif">TESTEZ</span>
            <br/>
            <br/>
            <span style="font-style: italic; font-size: larger">
                    Testez vos connaissances et améliorez votre compréhension avec les
                    QCM en ligne ! C'est un moyen rapide et efficace de mesurer votre
                    progression, de découvrir vos points forts et de cibler vos domaines
                    d'amélioration pour atteindre vos objectifs plus rapidement
                </span>
        </p>
    </div>
    <div class="fin_accueil_liste">
        <p style="background-color: #f9c026; padding-bottom: 150px">
            <br/>
            <span>
                    <img src="img/Conversation.png" width="50" height="50" alt="Image libre de droit"/>
                </span>
            <br/>
            <br/>
            <span style="font-family: Arial, Helvetica, sans-serif">PARTAGEZ</span>
            <br/>
            <br/>
            <span style="font-style: italic; font-size: larger">
                    Partagez vos idées, posez des questions et découvrez les
                    perspectives de milliers d'autres personnes en engageant la
                    conversation sur les forums en ligne ! C'est une occasion unique de
                    développer votre réseau, d'enrichir vos connaissances et de trouver
                    des réponses à des questions qui vous tiennent à cœur.
                </span>
        </p>
    </div>
</div>
<script src="/js/UI_Theme.js"></script>
</body>
</html>
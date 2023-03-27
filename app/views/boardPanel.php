<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();

if (!isset($_SESSION['userInfo'])) {
    header('Location: /unauthorized', true, 301);
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
    <link rel="stylesheet" type="text/css" href="/css/cours.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Cours</title>
</head>

<body>

<?php require '../app/views/navBar.php'; ?>
<link rel="stylesheet" type="text/css" href="/css/cours.css"/>
<script src="/js/BordPanel.js"></script>
<div style="text-align: center">
    <h1>Tableau de bord</h1>
</div>

<div class="container_cours">

    <div class="item_container_cours" title="Accéder au cours">

        <h2>DAW</h2>

        <div class="center_element">
            <div class="container">
                <div class="card">
                    <div class="box">
                        <div class="pourcentage">
                            <svg>
                                <circle cx="70" cy="70" r="70"></circle>
                                <circle cx="70" cy="70" r="70"></circle>
                                <svg>
                                    <div class="numero">
                                        <h2>0<span>%</span></h2>
                                    </div>
                        </div>
                        <h2 class="text">Html</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="item_container_cours" title="Accéder au cours">
        <h2>DAW</h2>
        <div class="center_element">
            <div class="container">
                <div class="card">
                    <div class="box">
                        <div class="pourcentage">
                            <svg>
                                <circle cx="70" cy="70" r="70"></circle>
                                <circle cx="70" cy="70" r="70"></circle>
                                <svg>
                                    <div class="numero">
                                        <h2>0<span>%</span></h2>
                                    </div>
                        </div>
                        <h2 class="text">CSS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item_container_cours" title="Accéder au cours">

        <h2>DAW</h2>

        <div class="center_element">
            <div class="container">
                <div class="card">
                    <div class="box">
                        <div class="pourcentage">
                            <svg>
                                <circle cx="70" cy="70" r="70"></circle>
                                <circle cx="70" cy="70" r="70"></circle>
                                <svg>
                                    <div class="numero">
                                        <h2>0<span>%</span></h2>
                                    </div>
                        </div>
                        <h2 class="text">JS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item_container_cours" title="Accéder au cours">

        <h2>DAW</h2>

        <div class="center_element">
            <div class="container">
                <div class="card">
                    <div class="box">
                        <div class="pourcentage">
                            <svg>
                                <circle cx="70" cy="70" r="70"></circle>
                                <circle cx="70" cy="70" r="70"></circle>
                                <svg>
                                    <div class="numero">
                                        <h2>0<span>%</span></h2>
                                    </div>
                        </div>
                        <h2 class="text">PHP</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//Affichage des cours avec les notes en %
for ($i = 0; $i < 4; $i++) {
    echo "<script>setProgress(" . $i . ", " . rand(0, 99) . ");</script>";
}
?>


<script src="/js/UI_Theme.js"></script>
<script src="/js/BordPanel.js"></script>

</body>
</html>
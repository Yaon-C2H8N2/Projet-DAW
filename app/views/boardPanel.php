<?php
include_once '../app/models/DBManage.php';
$db = new DBManage();

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
    <link rel="stylesheet" type="text/css" href="/css/boardPanel.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Cours</title>
</head>

<body>

<?php require_once '../app/views/navBar.php'; ?>
<script src="/js/BordPanel.js"></script>

<div class="container_cours">

    <div class="item_container_cours" title="Accéder au cours">

        <h2>Moyenne générale</h2>

        <div class="center_element">
            <div class="container">
                <div class="item">
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
                        <h2 class="text"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="item_container_cours" title="Accéder au cours">
        <h2>Meilleure note</h2>
        <div class="center_element">
            <div class="container">
                <div class="item">
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
                        <h2 class="text"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item_container_cours" title="Accéder au cours">

        <h2>Dernière note</h2>

        <div class="center_element">
            <div class="container">
                <div class="item">
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
                        <h2 class="text"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    <div class="item_container_cours" title="Accéder au cours">-->
    <!---->
    <!--        <h2>DAW</h2>-->
    <!---->
    <!--        <div class="center_element">-->
    <!--            <div class="container">-->
    <!--                <div class="item">-->
    <!--                    <div class="box">-->
    <!--                        <div class="pourcentage">-->
    <!--                            <svg>-->
    <!--                                <circle cx="70" cy="70" r="70"></circle>-->
    <!--                                <circle cx="70" cy="70" r="70"></circle>-->
    <!--                                <svg>-->
    <!--                                    <div class="numero">-->
    <!--                                        <h2>0<span>%</span></h2>-->
    <!--                                    </div>-->
    <!--                        </div>-->
    <!--                        <h2 class="text">PHP</h2>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

</div>


<?php


if ($db->getNBQCMForUser($user->id) > 0) {

    $avg = intval($db->getMoyenneUserId($user->id) * 5);
    $best = intval($db->getMaxNoteForUser($user->id) * 5);
    $last = intval($db->getLastNoteForUser($user->id) * 5);

    echo "<script>setProgress(" . 0 . ", " . $avg . ")</script>";
    echo "<script>setProgress(" . 1 . ", " . $best . ")</script>";
    echo "<script>setProgress(" . 2 . ", " . $last . ")</script>";

} else {
    //Affichage des cours avec les notes en %
    for ($i = 0; $i < 3; $i++) {
//        echo "<script>setProgress(" . $i . ", " . rand(0, 99) . ")</script>";
        echo "<script>setProgress(" . $i . ", " . 0 . ")</script>";
    }
}


?>


<script src="/js/UI_Theme.js"></script>

</body>
</html>
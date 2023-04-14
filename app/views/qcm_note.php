<?php
include_once '../app/models/DBManage.php';

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
    <link rel="stylesheet" type="text/css" href="/css/qcm.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>Note</title>
</head>

<body>

<?php require_once '../app/views/navBar.php'; ?>

<h1 style="text-align: center;">Vous obtenez la note de </h1>

<div class="fade-in div_note">
    <!--Couleur en fonction de la note-->
    <?php
    if ($score > 15 && $score <= 19) {
        echo "<h1 class='gradient-border gradient-border-super'><p class='super'>" . $score . "/20</p></h1>";
    } else if ($score > 10 && $score <= 15) {
        echo "<h1 class='gradient-border gradient-border-moyen'><p class='moyen'>" . $score . "/20</p></h1>";
    } else if ($score >= 20) {
        echo "<h1 class='gradient-border gradient-border-max'><p class='max'>" . $score . "/20</p></h1>";
    } else {
        echo "<h1 class='gradient-border gradient-border-mauvais'><p class='mauvais'>" . $score . "/20</p></h1>";
    }
    ?>
</div>


<!--Bouton de retour vers la page des cours-->
<p style="text-align: center">
    <button class="bouton bouton_vert" style="margin-top: 15%" onclick="Cours()">Retourner à la liste des cours</button>
</p>

<script src="/js/UI_Theme.js"></script>
<script>
    function Cours() {
        location.href = "/coursPanel"
    }

    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function (event) {
        history.pushState(null, null, document.URL);
        alert("Vous ne pouvez pas revenir en arrière");
    });
</script>
</body>
</html>
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

<?php require 'navBar.php'; ?>
<?php require 'bordPanel.php'; ?>

<script src="/js/UI_Theme.js"></script>
<script src="/js/BordPanel.js"></script>


</body>
</html>
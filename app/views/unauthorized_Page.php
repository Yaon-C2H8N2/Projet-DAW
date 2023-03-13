<head>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
</head>
<?php
http_response_code(404);
require 'navBar.php';
echo "<h1 style='text-align: center;'>Vous n'avez pas accès à cette page</h1>";
echo "<a href='/userAuth' style='color: #00ffc5'><h2 style='text-align: center;'>Se connecter</h2></a>";
echo "<p style='text-align: center; margin-top: 3%'><img src='/img/unauthorized.png' draggable='false' onselect='false'></p>";
echo "<script src=\"/js/UI_Theme.js\"></script>";
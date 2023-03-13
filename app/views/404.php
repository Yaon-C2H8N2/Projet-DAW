<head>
    <link id="link" rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
</head>
<?php
http_response_code(404);
require 'navBar.php';
echo "<h1 style='text-align: center;'>404 - Page not found</h1>";
echo "<a href='/' style='color: #00ffc5'><h2 style='text-align: center;'>Revenir au point de depart</h2></a>";
echo "<p style='text-align: center; margin-top: 10%'><img draggable='false' onselect='false' src='/img/404_error_img.png'></p>";
echo "<script src=\"/js/UI_Theme.js\"></script>";
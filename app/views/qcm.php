<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="img/neptune_icon.png"/>
    <title>QCM</title>
</head>
<body>
<?php require 'navBar.php'; ?>
<div style="margin-top: 10vh">
    <?php
    for ($i = 0; $i < count($questions); $i++) {
        echo $questions[$i] . '<br>';
        for ($j = 0; $j < count($answers[$i]); $j++) {
            echo '<input type="radio" name="qcm' . $i . '" value="' . $answers[$i][$j] . '">' . $answers[$i][$j]->text . '<br>';
        }
        echo $expected_answers[$i] . '<br>';
    }
    ?>
</div>
</body>
</html>

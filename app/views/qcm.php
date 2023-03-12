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
<form action="/qcmValidationController" method="post" style="margin-top: 10vh">
    <?php
    for ($i = 0; $i < count($questions); $i++) {
        echo $questions[$i] . '<br>';
        for ($j = 0; $j < count($answers[$i]); $j++) {
            echo '<input type="radio" name="qcm' . $i . '" value="' . $j . '" required>' . $answers[$i][$j]->text . '<br>';
        }
    }
    ?>
    <input type="hidden" name="qcmid" value="<?php echo $qcmid; ?>">
    <input type="submit" value="Valider">
</form>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/qcm.css"/>
    <link rel="stylesheet" type="text/css" href="/css/courseView.css"/>

    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
    <title>Cours : <?php echo htmlentities($id) ?></title>
</head>
<body>

<?php require_once '../app/views/navBar.php'; ?>

<div class="bouton_retour">
    <a href="/index.php?controller=cours&action=getCoursPanel">
        <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" alt="Retour" title="Retour"
             src="/img/backto.png" class="back_button" draggable="false">
    </a>
</div>

<div style="display: flex; flex-direction: column; align-items: center">

    <?php

    foreach ($data['elements'] as $key => $val) {
        switch ($val['type']) {
            case 'titre':
                echo "<" . $val['balise'] . ">{$val['val']}</" . $val['balise'] . ">";
                break;
            case 'paragraphe':
                echo "<p>{$val['val']}</p>";
                break;
            case 'video':
                echo "<" . $val['balise'] . " src='{$val['val']}'></" . $val['balise'] . ">";
                break;
            case 'image':
                echo "<img src='{$val['val']}' alt='image' width='100%'>";
                break;
            case 'qcm':
                echo "
                <form action='/index.php?controller=qcm&action=getQCM&qcmid={$val['val']}' method='post'>
                    <input type='submit' value='QCM'>
                </form>";
        }
    }
    ?>
</div>
<?php if ($admin): ?>
    <div style="display: flex; justify-content: center;margin-top: 10vh">
        <button class="bouton bouton_rouge" onclick="deleteCourse(<?php echo json_encode($id) ?>)">Supprimer le Cours
        </button>
    </div>
    <script src="/js/adminUtility.js"></script>
<?php endif; ?>
<script src="/js/UI_Theme.js"></script>
<script src="/js/utility.js"></script>

</body>
</html>

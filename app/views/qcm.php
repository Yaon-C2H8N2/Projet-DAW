<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/qcm.css"/>
    <link rel="icon" type="image/png" href="/img/neptune_icon.png"/>
    <title>QCM : <?php echo htmlentities($qcmid) ?></title>
</head>
<body onload="startTimer()">

<h1 style="text-align: center; text-decoration: underline">QCM</h1>

<h1 style="text-align: center" id="timer">0:00</h1>

<form action="/qcmValidationController" method="post" style="margin-top: 5vh">

    <h2 id="QCM" style="text-align: center"></h2>

    <?php
    $liste_caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    for ($i = 0; $i < count($questions); $i++) {
        if (substr($questions[$i], -1) != '?') echo "<h3>" . $i + 1 . ". " . $questions[$i] . ' ?</h3>';
        else  echo "<h3>" . $i + 1 . ". " . $questions[$i] . '</h3>';

        echo "<div class='div_question'>";

        for ($j = 0; $j < count($answers[$i]); $j++) {
            echo '<input type="radio" name="qcm' . $i . '" value="' . $j . '" required>' . $liste_caracteres[$j] . ". " . $answers[$i][$j]->text . '
            <br>';
        }
        echo "</div>";

    }
    ?>
    <input type="hidden" name="qcmid" value="<?php echo $qcmid; ?>">
    <p style="text-align: center"><input type="submit" class="bouton bouton_vert" value="Valider"></p>
</form>

<script src="/js/UI_Theme.js"></script>

<script>
    let secondes = 0;
    let minutes = 0;

    function startTimer() {
        setInterval(updateTimer, 1000);
    }

    function updateTimer() {
        secondes++;
        if (secondes == 60) {
            secondes = 0;
            minutes++;
        }
        document.getElementById("timer").innerHTML = minutes + ":" + (secondes < 10 ? "0" + secondes : secondes);
    }

    function getQCM_Name() {
        let point, slash, path = "<?php echo $path; ?>";
        for (let i = path.length; i >= 0; i--) {
            if (path.charAt(i) == '.') point = i;
            if (path.charAt(i) == '/') {
                slash = i;
                break;
            }
        }
        document.getElementById("QCM").innerText = path.slice(slash + 1, point);
    }

    getQCM_Name();
</script>
<?php if ($admin): ?>
    <div style="display: flex; justify-content: center;margin-top: 10vh">
        <button class="bouton bouton_rouge" onclick="deleteQcm(<?php echo json_encode($qcmid) ?>)">Supprimer le QCM
        </button>
    </div>
    <script src="/js/adminUtility.js"></script>
<?php endif; ?>
<script src="/js/utility.js"></script>

<script>
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function (event) {
        history.pushState(null, null, document.URL);
    });
</script>

</body>
</html>

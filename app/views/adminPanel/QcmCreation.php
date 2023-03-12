<?php

include_once '../app/models/Utility.php';

$admin = getUser()->isAdmin;

if (!$admin) {
    header('Location: /', true, 301);
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="../img/neptune_icon.png"/>
    <!--    <link id="link" rel="stylesheet" type="text/css" href="css/UI_Theme.css"/>-->
    <!--    <link id="link" rel="stylesheet" type="text/css" href="css/adminPage.css"/>-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <title>Creation QCM</title>
</head>

<?php require '../app/views/navBar.php'; ?>

<body style="margin-top: 10vh;">

<form id="qcmForm" method="post" action="/saveQcmController">
    <div>
        <label for="qcmName">Nom du QCM : </label>
        <input type="text" id="qcmName" name="qcmName" placeholder="Nom du QCM" required>
    </div>

    <div id="qcm">

    </div>

    <div>
        <button type="button" id="addQuestion">Ajouter une question</button>
    </div>

    <div>
        <button type="submit" id="saveQCM">Crée le QCM</button>
    </div>

    <button type="button" id="test" onclick="getData()">Test</button>

</form>

<script>
    let nbQuestion = 1;

    const question = () => {
        let nbAnswer = 1;
        let nbQuestionTmp = nbQuestion;

        let $fieldset = $('<fieldset></fieldset>');
        let $div = $('<div></div>');
        $fieldset.append('<legend>Question ' + nbQuestion + '</legend>');
        $div.append('<label for="question' + nbQuestion + '">Question : </label>');
        $div.append('<input type="text" name="question' + nbQuestion + '" placeholder="Qu\'est-ce qu\'un pointeur en C?"  required>');
        $fieldset.append($div);

        let $divAnswers = $('<div></div>');
        $fieldset.append($divAnswers);

        let $button = $('<button type="button"></button>');
        $button.text('Ajouter une réponse');
        $fieldset.append($button);

        if (nbQuestion > 1) {
            let $deleteQuestion = $('<button type="button"></button>');
            $deleteQuestion.text('Supprimer la question');
            $fieldset.append($deleteQuestion);
            $deleteQuestion.click(() => {
                if (nbQuestion > 2) {
                    $fieldset.remove();
                    nbQuestion--;
                }
            });
        }

        $button.click(() => {
            let $div = $('<div></div>');
            let $label = $('<label>Réponse :  ' + nbAnswer + '</label>');
            $div.append($label);
            $label.append('<input type="text" placeholder="Un pointeur est une variable qui contient une adresse mémoire" required >');
            $label.append('<input type="radio" name="answer' + nbQuestionTmp + '" value="' + nbAnswer + '" required >');
            $divAnswers.append($div);
            nbAnswer++;
        });
        $button.click();
        $button.click();
        nbQuestion++;
        $('#qcm').append($fieldset);
    };
    question();
    $('#addQuestion').click(question);

    const getData = () => {
        let qcm = {};

        qcm.name = $('#qcmName').val();
        qcm.questions = [];

        let $form = $('#qcmForm');
        // get all fieldsets in form
        let $fieldsets = $form.find('fieldset');
        // for each fieldset
        $fieldsets.each((i, fieldset) => {
            // get all inputs in fieldset
            // add question to qcm
            qcm.questions[i] = {};
            // get all inputs in fieldset
            let $inputs = $(fieldset).find('input[type=text]');
            // get which radio is checked
            let $radio = $(fieldset).find('input[type=radio]:checked');
            // get which radio is checked
            qcm.questions[i].answer = $radio.val();

            // for each input
            $inputs.each((j, input) => {
                // add to data
                qcm.questions[i][j] = $(input).val();
            });
        });
        return qcm;
    };

    $("#qcmForm").submit(function (e) {
        e.preventDefault();
        //bloc submit


        let fromData = new FormData();
        fromData.append('qcm', JSON.stringify(getData(), null, '\t'));
        $.ajax({
            type: "POST",
            url: "/admin/saveQcmController",
            data: fromData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                // crete dialog box and display message
                alert(data);
            },
        });
    });
</script>

</body>
</html>

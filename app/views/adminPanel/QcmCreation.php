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
    <link rel="stylesheet" type="text/css" href="/css/UI_Theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/adminPage.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <title>Creation d'un QCM</title>
</head>

<?php require '../app/views/navBar.php'; ?>

<body style="margin-top: 10vh;">

<div class="bouton_retour">
    <a href="/admPage">
        <img width="25" height="25" style="margin-left: 20px; margin-top: 20px" draggable="false" onselect="false"
             alt="Retour" title="Retour"
             src="/img/backto.png" class="back_button">
    </a>
</div>

<div class="main_div">

    <form id="qcmForm" method="post" action="/saveQcmController"
          style="box-shadow: 0 0 10px white; width: 50%">

        <div class="name_qcm_div">
            <input style="text-align: center; transform: scale(1.9); border-radius: 50px; border: none" type="text"
                   id="qcmName" name="qcmName"
                   placeholder="Nom du QCM" title="Le nom du QCM" required>
        </div>

        <div id="qcm" style="margin-top: 2%;">

        </div>

        <p style="text-align: center">
            <button type="button" class="bouton bouton_orange" id="addQuestion">Ajouter une question</button>
        </p>

        <p style="text-align: center">
            <button class="bouton bouton_vert" type="submit" id="saveQCM">Crée le QCM</button>
        </p>
    </form>
</div>

<script>
    let nbQuestion = 1;

    const question = () => {
        let nbAnswer = 1;
        let nbQuestionTmp = nbQuestion;

        let $fieldset = $('<fieldset></fieldset>');
        let $div = $('<div style="display: flex;justify-content: center;align-items: center; padding-bottom: 2%"></div>');
        $fieldset.append('<legend style="font-size: 24px" ">Question ' + nbQuestion + '</legend>');
        $div.append('<input class="input_title" type="text" name="question' + nbQuestion + '" placeholder="Question"  required>');
        $fieldset.append($div);

        let $divAnswers = $('<div class="div_question"></div>');
        $fieldset.append($divAnswers);

        let $div_bouton = $('<div style="display: flex;align-items: center;justify-content: center; grid-gap: 3%"></div>');
        let $button = $('<button class="bouton bouton_bleu" type="button"></button>');
        $button.text('Ajouter une réponse');
        $div_bouton.append($button)
        $fieldset.append($div_bouton);

        if (nbQuestion > 1) {

            let $deleteQuestion = $('<button class="bouton bouton_rouge" type="button"></button>');
            $deleteQuestion.text('Supprimer la question');
            $div_bouton.append($deleteQuestion)
            $fieldset.append($div_bouton);

            $deleteQuestion.click(() => {
                if (nbQuestion > 2) {
                    $fieldset.remove();
                    nbQuestion--;
                    $('fieldset').each((i, fieldset) => {
                        $(fieldset).find('legend').text('Question ' + (i + 1));
                    });
                }
            });
        }

        $button.click(() => {
            let $div = $('<div></div>');
            let $label = $('<label style="width: 10%">Réponse :  <output> ' + nbAnswer + '</output></label>');
            $label.append('<input type="radio" class="radio"  name="answer' + nbQuestionTmp + '" value="' + nbAnswer + '" required >');
            $label.append('<input type="text" class="input_question" placeholder="Un pointeur est une variable qui contient une adresse mémoire" required >');

            $div.append($label);
            $divAnswers.append($div);
            // double click to delete answer
            $div.dblclick(() => {
                if (nbAnswer > 2) {
                    $div.remove();
                    nbAnswer--;
                    $fieldset.find('output').each((i, output) => {
                        $(output).text(i + 1);
                    });
                }
            });
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
            qcm.questions[i].title = $(fieldset).find('input[class=input_title]').val();
            // get all inputs in fieldset
            let $inputs = $(fieldset).find('input[class=input_question]');
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
                dialogBox("Succes", data);
            },
        });
    });
</script>

<script src="/js/UI_Theme.js"></script>
</body>
</html>

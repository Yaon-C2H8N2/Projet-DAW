const divcss = () => {
    let div = $('<div></div>');
    div.css({
        width: '100%',
        height: 'fit-content',
        resize: 'none',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        margin: '1vh',
        padding: '1vh',
    });
    return div;
}

const divButton = () => {
    let div = $('<div></div>');
    div.css({
        width: '100%',
        height: 'fit-content',
        display: 'flex',
        flexDirection: 'row',
        justifyContent: 'space-evenly',
    });
    return div;
}

const paragraph = () => {
    let div = divcss();
    let divBtn = divButton();
    let text = $('<textarea rows="1" wrap="soft"></textarea>');
    text.css({
        width: '100%', height: 'fit-content', margin: '1vh', padding: '.3vh', borderRadius: '.8vh', resize: 'none',
    });
    div.append(text);
    div.append(divBtn);
    let valider = $('<button class="bouton bouton_bleu">Valider</button>');
    divBtn.append(valider);
    valider.on('click', function (e) {
        let p = $('<p class="val"></p>');
        p.text(text.val());
        div.replaceWith(p);
        p.bind('dblclick', function (e) {
            // replace with input
            let newinput = paragraph();
            p.replaceWith(newinput);
            newinput.find('textarea').val(p.text());
            return false;
        });
    });

    /**
     * Magick regex pour resize la textarea automatiquement en fonction du nombre de lignes du contenu
     * @author Yoan
     */
    text.on('input', function (e) {
        $(this)[0].rows = $(this)[0].value.split(/\r\n|\r|\n/).length;
    });
    let supprimer = $('<button class="bouton bouton_rouge">Supprimer</button>');
    divBtn.append(supprimer);
    supprimer.on('click', function (e) {
        div.remove();
    });
    return div;
}

const input = (retour) => {
    let div = divcss();
    let divBtn = divButton();
    let text = $('<input type="text">');
    text.css({
        width: '100%', height: 'fit-content', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',
    });
    div.append(text);
    div.append(divBtn);
    let valider = $('<button class="bouton bouton_bleu">Valider</button>');
    divBtn.append(valider);
    valider.on('click', function (e) {
        let titre = $('<' + retour + ' class="val"></' + retour + '>');
        titre.text(text.val());
        div.replaceWith(titre);
        titre.bind('dblclick', function (e) {
            // replace with input
            let newinput = input(retour);
            titre.replaceWith(newinput);
            newinput.find('input').val(titre.text());
            return false;
        });
    });
    let supprimer = $('<button class="bouton bouton_rouge">Supprimer</button>');
    divBtn.append(supprimer);
    supprimer.on('click', function (e) {
        div.remove();
    });
    return div;
}

const image = () => {
    let div = divcss();
    let divBtn = divButton();
    let text = $('<input type="text">');
    text.css({
        width: '100%', height: 'fit-content', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',
    });
    div.append(text);
    div.append(divBtn);
    let valider = $('<button class="bouton bouton_bleu">Valider</button>');
    divBtn.append(valider);
    valider.on('click', function (e) {
        let img = $('<img class="val">');
        img.css({
            width: '50vh', height: 'auto', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',
        });
        img.attr('src', text.val());
        div.replaceWith(img);
        img.bind('dblclick', function (e) {
            // replace with input
            let newinput = image();
            img.replaceWith(newinput);
            newinput.find('input').val(img.attr('src'));
            return false;
        });
    });
    let supprimer = $('<button class="bouton bouton_rouge">Supprimer</button>');
    divBtn.append(supprimer);
    supprimer.on('click', function (e) {
        div.remove();
    });
    return div;
}

const video = () => {
    let div = divcss();
    let divBtn = divButton();
    let text = $('<input type="text">');
    text.css({
        width: '100%', height: 'fit-content', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',
    });
    div.append(text);
    div.append(divBtn);
    let valider = $('<button class="bouton bouton_bleu">Valider</button>');
    divBtn.append(valider);
    valider.on('click', function (e) {
        let frameDiv = $('<div></div>');
        frameDiv.css({
            // width: '50vh',
            // height: '30vh',
            // margin: '1vh',
            position: 'relative',
        });
        let frame = $('<iframe class="val" allowfullscreen></iframe>');
        frame.css({
            width: '50vh', height: '30vh', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',

        });
        frameDiv.append(frame);
        frame.attr('src', ytUrl(text.val()));
        div.replaceWith(frameDiv);
        let modif = $('<i class="fa-solid fa-circle-info fa-2x"></i>');
        modif.css({
            width: '3vh',
            height: '3vh',
            padding: '.3vh',
            borderRadius: '50%',
            position: 'absolute',
            top: '0',
            right: '0',
            left: 'auto',
            bottom: 'auto',
            zIndex: '1',
        });
        modif.hover(function () {
            $(this).css({
                scale: '1.3',
            });
        }, function () {
            $(this).css({
                scale: '1',
            });
        });
        modif.click(function (e) {
            let newinput = video();
            frameDiv.replaceWith(newinput);
            newinput.find('input').val(frame.attr('src'));
            $(this).remove();
            return false;
        });
        frameDiv.append(modif);
    });
    let supprimer = $('<button class="bouton bouton_rouge">Supprimer</button>');
    divBtn.append(supprimer);
    supprimer.on('click', function (e) {
        div.remove();
    });
    return div;
}

jQuery(function () {
    $.contextMenu({
        selector: 'div#course', callback: function (key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m);
        }, items: {
            // add items in items object
            "Titre": {
                name: "Titre", items: {
                    "H1": {
                        name: "H1", icon: "edit", callback: function (key, options) {
                            let div = input('h1');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    }, "H2": {
                        name: "H2", icon: "edit", callback: function (key, options) {
                            let div = input('h2');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    }, "H3": {
                        name: "H3", icon: "edit", callback: function (key, options) {
                            let div = input('h3');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    }, "H4": {
                        name: "H4", icon: "edit", callback: function (key, options) {
                            let div = input('h4');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    }, "H5": {
                        name: "H5", icon: "edit", callback: function (key, options) {
                            let div = input('h5');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    }, "H6": {
                        name: "H6", icon: "edit", callback: function (key, options) {
                            let div = input('h6');
                            $('#course').append(div);
                            div.find('input').focus();
                        }
                    },
                }
            }, "video": {
                name: "Vidéo", icon: "edit", callback: function (key, options) {
                    let div = video();
                    $('#course').append(div);
                    div.find('input').focus();
                }
            }, "Paragraphe": {
                name: "paragraphe", icon: "edit", callback: function (key, options) {
                    let div = paragraph();
                    $('#course').append(div);
                    div.find('textarea').focus();
                }
            }, "QCM": {
                name: "QCM", icon: "edit", callback: async function (key, options) {
                    let div = await AllQcm();
                    $('#course').append(div);
                    div.find('select').focus();
                }
            }, "Image": {
                name: "Image", icon: "edit", callback: function (key, options) {
                    let div = image();
                    $('#course').append(div);
                    div.find('input').focus();
                }
            }
        },
    });
});

const AllQcm = async () => {
    let qcms = await getAllQcm();
    let div = divcss();
    let divBtn = divButton();
    let choix = $('<select class="val"></select>');
    div.append(choix);
    div.append(divBtn);
    choix.css({
        width: '100%', height: 'fit-content', margin: '1vh', padding: '.3vh', borderRadius: '.8vh',
    });
    let supprimer = $('<button class="bouton bouton_rouge">Supprimer</button>');
    supprimer.on('click', function (e) {
        div.remove();
    });
    $.each(qcms, function (index, value) {
        choix.append('<option value="' + value.id + '">' + value.path + '</option>');
    });
    let afficher = $('<button class="bouton bouton_vert">Afficher</button>');
    divBtn.append(afficher);
    divBtn.append(supprimer);
    afficher.on('click', function (e) {
        let qcmDiv = $('<div></div>');
        let frame = $('<iframe></iframe>');
        frame.css({
            width: '100%', height: '100%', border: 'none',
        });
        qcmDiv.append(frame);
        frame.attr('src', '/qcm/' + choix.val());
        qcmDiv.dialog({
            autoOpen: true,
            modal: true,
            title: 'QCM : ' + choix.find('option:selected').text(),
            resizable: true,
            position: {my: "center", at: "center", of: window},
            width: window.innerHeight * 0.7,
            height: window.innerHeight * 0.5,
            buttons: {
                "Fermer": function () {
                    $(this).dialog('close');
                }
            }
        });
    });
    return div;
}

const getAllData = () => {
    let data = {};
    data['title'] = $('#courseName').val();
    data['elements'] = [];
    let index = 0;
    $('#course .val').each(function () {
        let value;
        switch ($(this).prop('tagName')) {
            case 'H1':
                value = {type: 'titre', balise: 'h1', val: $(this).text()};
                break;
            case 'H2':
                value = {type: 'titre', balise: 'h2', val: $(this).text()};
                break;
            case 'H3':
                value = {type: 'titre', balise: 'h3', val: $(this).text()};
                break;
            case 'H4':
                value = {type: 'titre', balise: 'h4', val: $(this).text()};
                break;
            case 'H5':
                value = {type: 'titre', balise: 'h5', val: $(this).text()};
                break;
            case 'H6':
                value = {type: 'titre', balise: 'h6', val: $(this).text()};
                break;
            case 'P':
                value = {type: 'paragraphe', val: $(this).text()};
                break;
            case 'IFRAME':
                value = {type: 'video', balise: 'iframe', val: $(this).attr('src')};
                break;
            case 'SELECT':
                value = {type: 'qcm', val: $(this).val()};
                break;
            case 'IMG':
                value = {type: 'image', val: $(this).attr('src')};
        }
        data['elements'][index] = value;
        index++;
    });
    return data;
}

const checkTitle = () => {
    let title = $('#courseName').val();
    if (title === '') {
        dialogBox('Erreur', 'Le titre du cours est vide');
        return false;
    }
    return true;
}
$("#saveCourse").click(function (e) {
    e.preventDefault();
    if (!checkTitle())
        return;
    let data = getAllData();
    console.log(data);
    $.ajax({
        url: '/admin/addCourse',
        type: 'POST',
        data: {cours: JSON.stringify(data, null, '\t')},
        async: true,
        success: function (response) {
            let result = JSON.parse(response);
            if (result.success) {
                dialogBox('Succes', result.message, btn('OK', function () {
                    window.location.href = '/';
                }));
            } else
                dialogBox('Erreur', result.message);
        },
        error: function (data) {
            alert(data);
        }
    });
});

//fonction pour parser un lien youtube en iframe
const ytUrl = (url) => {
    //check if url is youtube url
    if (url.indexOf('youtube') === -1) {
        return url;
    }
    let id = url.split('v=')[1];
    let ampersandPosition = id.indexOf('&');
    if (ampersandPosition !== -1) {
        id = id.substring(0, ampersandPosition);
    }
    return 'https://www.youtube.com/embed/' + id;
}
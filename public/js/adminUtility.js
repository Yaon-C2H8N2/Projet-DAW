function deleteUser(jsonData) {
    console.log(jsonData);
    $.ajax({
        url: '/deleteUser',
        type: 'POST',
        data: {user: JSON.stringify(jsonData, null, '\t')},
        success: function (data) {
            let json = JSON.parse(data);
            if (json.success) {
                dialogBox('Suppression', 'L\'utilisateur a bien été supprimé', btn());
            } else {
                dialogBox('Suppression', 'Une erreur est survenue');
            }
        },
        error: function (data) {
            alert('Une erreur est survenue');
        }
    });
}

function deleteCourse(id) {
    console.log(name);
    $.ajax({
        url: '/adm/deleteCourse/'+id,
        type: 'POST',
        async: true,
        success: function (data) {
            let json = JSON.parse(data);
            if (json.success) {
                dialogBox('Suppression', json.message, btn(function (){
                    window.location.href = '/';
                }));
            } else {
                dialogBox('Suppression', json.message);
            }
        },
        error: function (data) {
            alert('Une erreur est survenue');
        }
    });
}


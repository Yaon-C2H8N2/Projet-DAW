/**
 * Delete a user from the database and display a dialog box to confirm the deletion or not
 * @param jsonData
 */
function deleteUser(jsonData) {
    console.log(jsonData);
    $.ajax({
        url: '/index.php?controller=user&action=deleteUser',
        type: 'POST',
        data: {user: JSON.stringify(jsonData, null, '\t')},
        success: function (data) {
            let json = JSON.parse(data);
            if (json.success) {
                dialogBox('Suppression', 'L\'utilisateur a bien été supprimé', btn("OK", function () {
                    window.location.href = '/';
                }));
            } else {
                dialogBox('Suppression', 'Une erreur est survenue');
            }
        },
        error: function (data) {
            alert('Une erreur est survenue');
        }
    });
}

/**
 *
 * @param id id of the course to delete
 */
function deleteCourse(id) {
    $.ajax({
        url: '/index.php?controller=admin&action=deleteCourse&courseid=' + id,
        type: 'POST',
        async: true,
        success: function (data) {
            let json = JSON.parse(data);
            if (json.success) {
                dialogBox('Suppression', json.message, btn('OK', function () {
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

/**
 * Delete a QCM
 * @param id
 */
function deleteQcm(id) {
    $.ajax({
        url: '/index.php?controller=admin&action=deleteQCM&qcmid=' + id,
        type: 'POST',
        async: true,
        success: function (data) {
            let json = JSON.parse(data);
            if (json.success) {
                dialogBox('Suppression', json.message, btn('OK', function () {
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

/**
 * Get all QCM from the database
 * @returns {Promise<null>}
 */
async function getAllQcm() {
    let json = null;
    await $.ajax({
        url: '/index.php?controller=admin&action=searchQCM',
        type: 'POST',
        async: true,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            json = $.parseJSON(data);
        }
    });
    return json;
}

/**
 * Get all course from the database
 * @returns {Promise<null>}
 */
async function getAllCourse() {
    let json = null;
    await $.ajax({
        url: '/index.php?controller=admin&action=searchCourse',
        type: 'POST',
        async: true,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            json = $.parseJSON(data);
        }
    });
    return json;
}
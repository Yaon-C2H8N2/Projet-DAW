$("form").submit(function (e) {
    e.preventDefault();
    if (isFormValid()) {
        this.submit();
    }
});

function isPasswordStrong() {
    //TODO : vérifier que le mot de passe est assez fort
    return true;
}

function isFormValid() {
    var isValid = true;
    /**
     * Vérification mail
     */
    if ($("#mail")[0].value != $("#mail-confirm")[0].value) {
        isValid = false;
        //TODO : afficher erreur mail non confirmé
        console.log("Confirmation du mail invalide");
    }
    /**
     * Vérification mot de passe
     */
    if (!isPasswordStrong()) {
        isValid = false;
        //TODO : mot de passe pas assez fort
        console.log("Mot de passe pas assez fort");
    } else if ($("#password")[0].value != $("#password-confirm")[0].value) {
        isValid = false;
        //TODO : afficher erreur mot de passe non confirmé
        console.log("Confirmation du mot de passe invalide");
    }
    /**
     * Vérification pseudo
     */
    if ($("#username")[0].value.length <= 3 || $("#username")[0].value.length >= 20) {
        isValid = false;
        //TODO : afficher erreur pseudo trop court
        console.log("Pseudo trop court ou trop long");
    }
    /**
     * Vérification nom, prénom & date de naissance
     */
    if ($("#firstname")[0].value.length <= 1) {
        isValid = false;
        //TODO : afficher erreur prénom trop court
        console.log("Prénom trop court");
    }
    if ($("#lastname")[0].value.length <= 1) {
        isValid = false;
        //TODO : afficher erreur nom trop court
        console.log("Nom trop court");
    }
    //TODO : vérification validité date de naissance
    return isValid;
}
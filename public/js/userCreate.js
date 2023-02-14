$("form").submit(function (e) {
    e.preventDefault();
    if (isFormValid()) {
        this.submit();
    }
});

/**
 * @details Fonction qui vérifie que le mot de passe entré par l'utilisateur vérifie les critères à la création d'un mot de passe
 * @returns {boolean}
 */
function isPasswordStrong() {
    if ($("#password")[0].value.length < 8){
        console.log("Mot de passe trop court");
        return false;
    }
    //TODO : Reprendre la regex du mot de passe car elle ne fonctionne pas
    //var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // Doit contenir moins 1 lettre maj et min, un nombre et un char special
    //return regex.test($("#password")[0].value);
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

    //DATE DE NAISSANCE : verifie si l'utilisateur n'est pas trop vieux ni trop jeune et si la date entrée est bien correcte
    if (!($("#birthdate")[0].value.length <= 1)) {
        var DateDeNaissance = new Date(Date.parse($("#birthdate")[0].value)); //Conversion de la date de naissance pour créer une date de naissance valide ou pas
        if (!(isNaN(DateDeNaissance))) { //Si conversion est ok
            if (Date.now() <= DateDeNaissance) {
                console.log("Date de naissance non valide, cette date n'est pas encore arrivée");
                isValid = false;
            } else {
                var diff = Date.now() - DateDeNaissance.getTime();
                var age = new Date(diff);
                var User_Age = Math.abs(age.getUTCFullYear() - 1970);//Donne l'age de l'utilisateur
                if (User_Age > 110 || User_Age < 6) {
                    console.log("Vous êtes trop jeune ou trop vieux pour notre site");
                    console.log(User_Age);
                    isValid = false;
                } else {
                    console.log("Date de Naissance valide age --> " + User_Age);
                    //isValid = true; //fait crash le site si on ne le met pas en commentaire
                }
            }
        } else {
            console.log("Date de Naissance non valide");
            isValid = false;
        }
    }
    return isValid;
}
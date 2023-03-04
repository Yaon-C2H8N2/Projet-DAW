const form = {
    mail: false,
    username: false,
    isok: () => {
        return form.mail && form.username;
    }
};
$("form").submit(function (e) {
    e.preventDefault();
    if (!form.isok()) {
        let text = "";
        if (!form.mail) {
            text += "L'adresse mail n'est pas valide ou déjà utilisée";
        }
        if (!form.username) {
            text += "\nLe pseudo n'est pas valide ou déjà utilisé";
        }
        alert(text);
        return;
    }
    if (isFormValid()) {
        fromData = new FormData(this);
        if ($('#inputImg')[0].files[0] != undefined)
            fromData.append('img', $('#inputImg')[0].files[0]);
        $.ajax({
            url: "/creationController",
            type: "POST",
            data: fromData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log("utilisateur créé");
                window.location.href = "/";
            }
        });
        console.log("%cFormulaire accepté", "color: green");
    }
});

/**
 * @details Fonction qui vérifie que le mot de passe entré par l'utilisateur vérifie les critères à la création d'un mot de passe
 * @returns {boolean}
 */
function isPasswordStrong() {

    //Ancienne version du mdp
    // return new RegExp(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/).test(document.getElementById("password").value);
    return document.getElementById("password").value.length > 8;
}

/**
 * @brief Fonction d'affichage quand l'utilisateur rentre un mdp pour indiquer quand le mdp est bon
 */
function TestPasswordValidity() {
    if (document.getElementById("password").value.length > 8) {
        document.getElementById("password").style.boxShadow = "none";
    } else {
        document.getElementById("password").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
    }
}

/**
 * @brief Fonction d'affichage quand l'utilisateur rentre un mdp pour indiquer quand le mdp est bon
 */
function TestEmailValidity() {
    if (new RegExp(/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,8}$/).test(document.getElementById("mail").value)) document.getElementById("mail").style.boxShadow = "none"; else document.getElementById("mail").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
}

function isFormValid() {
    var isValid = true;

    /**
     * Vérification mail
     */
    if ($("#mail")[0].value != $("#mail-confirm")[0].value) {
        isValid = false;
        console.log("Confirmation du mail invalide");
        document.getElementById("mail-confirm").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
    } else {
        document.getElementById("mail-confirm").style.boxShadow = "none";
    }
    /**
     * Vérification mot de passe
     */
    if (!isPasswordStrong()) {
        isValid = false;
        console.log("Mot de passe pas assez fort");
    } else if ($("#password")[0].value != $("#password-confirm")[0].value) {
        isValid = false;
        console.log("Confirmation du mot de passe invalide");
        console.log("Mdp 1 entrée : " + $("#password")[0].value);
        console.log("Mdp 2 entrée : " + $("#password-confirm")[0].value);
        document.getElementById("password-confirm").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
    } else {
        document.getElementById("password-confirm").style.boxShadow = "none"; // Enlève l'ombre de l'élément si mdp est bon
    }
    /**
     * Vérification pseudo
     */
    if ($("#username")[0].value.length <= 3 || $("#username")[0].value.length >= 20) {
        isValid = false;
        console.log("Pseudo trop court ou trop long");
    }
    /**
     * Vérification nom, prénom & date de naissance
     */
    if ($("#firstname")[0].value.length <= 1) {
        isValid = false;
        console.log("Prénom trop court");
    }
    if ($("#lastname")[0].value.length <= 1) {
        isValid = false;
        console.log("Nom trop court");
    }

    //DATE DE NAISSANCE : verifie si l'utilisateur n'est pas trop vieux ni trop jeune et si la date entrée est bien correcte
    if (($("#birthdate")[0].value.length >= 1)) { //Une date est sous la forme yyyy-mm-dd
        let DateDeNaissance = new Date(Date.parse($("#birthdate")[0].value)); //Conversion de la date de naissance pour créer une date de naissance valide ou pas
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
                    document.getElementById("birthdate").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
                } else {
                    // console.log("Date de Naissance valide AGE --> [" + User_Age + "]");
                    document.getElementById("birthdate").style.boxShadow = "none";
                    //isValid = true; //fait crash le site si on ne le met pas en commentaire, car cas pas encore géré quand tout est bon
                }
            }
        } else {
            document.getElementById("birthdate").style.boxShadow = "0 0 10px rgb(255, 0, 0)";
            isValid = false;
        }
    }
    return isValid;
}

function changeImg() {
    $("#inputImg").click();
}

function inputImgChange() {
    let img = $("#inputImg")[0].files[0];
    if (img == null) return;
    if (img.size > 5000000) {
        alert("L'image est trop lourde");
        return;
    }
    let reader = new FileReader();
    reader.readAsDataURL(img);
    reader.onload = function (e) {
        let imgUser = $("#img_create_profil");
        imgUser.attr("src", e.target.result);
    }
}

$("#mail").bind("focusout", async function () {

    var result = await emailExist($(this).val());
    if (result) {
        $(this).css("box-shadow", "0 0 10px red");
        form.mail = false;
    } else {
        $(this).css("box-shadow", "none");
        form.mail = true;
    }
});

$("#username").bind("focusout", async function () {

    var result = await pseudoExist($(this).val());
    if (result) {
        $(this).css("box-shadow", "0 0 10px red");
        form.username = false;
    } else {
        $(this).css("box-shadow", "none");
        form.username = true;
    }
});
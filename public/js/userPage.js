const form = {
    mail: true,
    pseudo: true,
    mailPseudoOk: () => {
        return form.mail && form.pseudo;
    },
    passwordOk: () => {
        let password = $("#newPassword").val();
        if (password === "" && $("#passwordConfirm").val() === "" && $("#password").val() === "") {
            return true;
        }
        return password === $("#passwordConfirm").val() && password !== "" &&
            $("#password").val() !== "";
    },
};

function changeImg() {
    $("#inputImg").click();
}

async function saveImg() {
    if ($("#inputImg")[0].files.length === 0) {
        return;
    }
    let img = $("#inputImg")[0].files[0];
    if (img.size > 5000000) {
        $("#dialogUserText").text("L'image depasse les 5Mo");
        $("#dialogUser").show("slow", function () {
        });
        return;
    }
    data = await AjaxImg(img);
    $("#dialogUserText").text(data);
    $("#dialogUser").show("slow", function () {
    });
    let reader = new FileReader();
    reader.readAsDataURL(img);
    reader.onload = function (e) {
        let imgUser = $("#imgUser");
        imgUser.attr("src", e.target.result);
    }
}

$("#dialogUserBtn").click(function () {
    $("#dialogUser").hide("slow", function () {
    });
    $("#dialogUserText").css("color", "black");
});

$("#pseudo").bind("focusout", async function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
        form.pseudo = false;
    } else {
        const result = await pseudoExist($(this).val());
        if (result) {
            {
                $("#pseudoOut").text("Ce pseudo est déjà utilisé");
                form.pseudo = false;
            }
        } else {
            $("#pseudoOut").text("");
            form.pseudo = true;
        }
    }
});

$("#email").bind("focusout", async function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
        form.mail = false;
    } else {
        const result = await emailExist($(this).val());
        if (result) {
            {
                $("#emailOut").text("Cette email est déjà utilisé");
                form.mail = false;
            }
        } else {
            $("#emailOut").text("");
            form.mail = true;
        }
    }
});

$("#firstname").bind("change paste keyup", function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
    }
});

$("#lastname").bind("change paste keyup", function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
    }
});

$("form").submit(function (e) {
    e.preventDefault();
    let dialog = $("#dialogUser");
    if (!form.mailPseudoOk()) {
        $("#dialogUserText").text("Erreur dans le mail ou le pseudo.");
        dialog.css("color", "red");
        dialog.show("slow", function () {
        });
        return;
    }
    if (!form.passwordOk()) {
        $("#dialogUserText").text("Erreur dans les champs de mot de passe.");
        dialog.css("color", "red");
        dialog.show("slow", function () {
        });
        return;
    }
    $.ajax({
        type: "POST",
        url: "/updateUserInfoController",
        data: $(this).serialize(),
        success: function (data) {
            $("#dialogUserText").text(data);
            dialog.css("color", "black");
            dialog.show("slow", function () {});
        }
    });
});

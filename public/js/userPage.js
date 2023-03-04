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
    $("#dialogUser").show("slow", function () {});
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
});

$("#pseudo").bind("change paste keyup", async function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
    } else {
        const result = await pseudoExist($(this).val());
        if (result === "true") {
            {
                $("#pseudoOut").text("Ce pseudo est déjà utilisé");
            }
        } else {
            $("#pseudoOut").text("");
        }
    }
});

$("#email").bind("change paste keyup", async function () {
    if ($(this).val() === "") {
        $(this).css("border", "2px solid red");
    } else {
        const result = await emailExist($(this).val());
        console.log(result);
        if (result === "true") {
            {
                $("#emailOut").text("Cette email est déjà utilisé");
            }
        } else {
            $("#emailOut").text("");
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

function changeUserData() {
    let pseudo = $("#pseudo").val();
    let email = $("#email").val();
    let prenom = $("#firstname").val();
    let nom = $("#lastname").val();

    switch (true) {
        case pseudo === "":
            $("#pseudo").css("border", "1px solid red");
            break;
        case email === "":
            $("#email").css("border", "1px solid red");
            break;
        case prenom === "":
            $("#firstname").css("border", "1px solid red");
            break;
        case nom === "":
            $("#lastname").css("border", "1px solid red");
            break;
    }

    $("#userForm").submit();

}

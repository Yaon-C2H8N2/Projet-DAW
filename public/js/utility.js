function pseudoExist(pseudo) {
    fromData = new FormData();
    fromData.append("pseudo", pseudo);
    return $.ajax({
        url: "/checkValidValue",
        type: "POST",
        async: true,
        data: fromData,
        cache: false,
        contentType: false,
        processData: false,
    });
}

function emailExist(email) {
    fromData = new FormData();
    fromData.append("email", email);
    return $.ajax({
        url: "/checkValidValue",
        type: "POST",
        async: true,
        data: fromData,
        cache: false,
        contentType: false,
        processData: false,
    });
}

function AjaxImg(img, url = "/changeImg") {
    let formData = new FormData();
    formData.append("img", img);
    return $.ajax({
        url: url,
        type: "POST",
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    });
}

//create a button with a name and a function in parameter
const btn = (name = 'OK', func = function () {
    $(this).dialog("close");
}) => {
    let btn = {};
    btn[name] = func;
    return btn;

}

function dialogBox(title, text, bt = btn("Ok")) {
    let div = $('<div>' + text + '</div>');
    div.css({
        textAlign: "center",
        fontsize: "20px",
        fontWeight: "bold",
        backgroundColor: "white",
        padding: "10px",
        borderRadius: "10px",
        color: "red",
        width: "fit-content",
        height: "fit-content",
    });
    div.dialog({
        title: title,
        modal: true,
        //not resizable
        resizable: false,
        show: {
            effect: "slide",
            duration: 300,
            direction: "up"
        },
        buttons: bt,
    });
}




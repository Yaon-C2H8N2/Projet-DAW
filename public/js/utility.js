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
        success: function (data) {
            if (data === "true") {
                return true;
            }
            return false;
        }
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
        success: function (data) {
            if (data === "true") {
                return true;
            }
            return false;
        }
    });
}




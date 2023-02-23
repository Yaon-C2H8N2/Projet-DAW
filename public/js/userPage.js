function changeImg() {
    let img = $("#inputImg");
    img.click();
}

function saveImg() {
    if ($("#inputImg")[0].files.length === 0) {
        return;
    }
    let img = $("#inputImg")[0].files[0];
    let formData = new FormData();
    formData.append("img", img);
    $.ajax({
        url: "/changeImg",
        type: "POST",
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let diag = $("<dialog></dialog>");
            diag.append("<p>" + data + "</p>");
            let btn = $("<button></button>");
            btn.text("OK");
            btn.css({
                "width": "50px",
                "height": "30px",
                "border-radius": "5px",
                "border": "1px solid black",
                "background-color": "white",
                "margin-top": "5px"
            });
            btn.click(function () {
                diag.remove();
            });
            diag.append(btn);
            $("body").append(diag);
            //css
            diag.css({
                "min-width": "200px",
                "min-height": "100px",
                "font-size": "15px",
                "background-color": "white",
                "border": "1px solid black",
                "border-radius": "10px",
                "position": "absolute",
                "top": "30%",
                "text-align": "center",
                "padding": "10px"
            });
            diag.show( "slow", function() {});
        }
    });
   // change img in the imgUser with the new img in imgInput
   let reader = new FileReader();
    reader.readAsDataURL(img);
    reader.onload = function (e) {
        let imgUser = $("#imgUser");
        imgUser.attr("src", e.target.result);
    }
}

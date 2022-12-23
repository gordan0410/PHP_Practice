$(function () {
    $(".register_submit").click(function () {
        var currentRow = $(this).closest(".modal-footer").siblings(".table").find("tbody");
        var name = currentRow.find(".register_name").val();
        var user = currentRow.find(".register_username").val(); // get current row 1st TD value
        var password = currentRow.find(".register_password").val(); // get current row 2nd TD
        var param = name + "," + user + "," + password;
        $.ajax({
            url: "index.php?data=user/register/" + param,
            method: "GET",
            success: function (res) {
                jdata = JSON.parse(res);
                if (jdata["error"]) {
                    alert(jdata["msg"]);
                    currentRow.find(".register_name").val("");
                    currentRow.find(".register_username")
                        .val(""); // get current row 1st TD value
                    currentRow.find(".register_password")
                        .val(""); // get current row 2nd TD
                    return
                }
                document.cookie = "token=" + jdata["msg"];
                location.reload();
            },
            error: function (err) {
                alert(err)
            },
        });
    });
    $(".submit").click(function () {
        var currentRow = $(this).closest("tr");
        var username = currentRow.find(".username").val();
        var password = currentRow.find(".password").val(); // get current row 1st TD value
        var param = username + "," + password;
        $.ajax({
            url: "index.php?data=user/login/" + param,
            method: "GET",
            success: function (res) {
                jdata = JSON.parse(res);
                if (jdata["error"]) {
                    alert(jdata["msg"]);
                    currentRow.find(".username").val("");
                    currentRow.find(".password").val("");
                    return
                }
                document.cookie = "token=" + jdata["msg"];
                location.reload();
            },
            error: function (err) {
                alert(err)
            },
        });
    })
})
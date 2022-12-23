$(function () {
    $(".new_msg_btn").click(function () {
        var useid = $(this).attr("id");
        var msg = $(this).parent().siblings("input").val();
        var param = useid + "," + msg;
        console.log(param);
        var currentRow = $(this).parent().parent().siblings("table").children("tbody");
        $.ajax({
            url: "index.php?data=board/createData/" + param,
            method: "GET",
            success: function (res) {
                res = JSON.parse(res);
                if (res["error"]) {
                    alert(res["msg"]);
                }
                newData = res["msg"];
                currentRow.append("<tr><th>" + newData['id'] + "</th><td>" + newData['msg'] +
                    '</td><td><input type="text"></td><td><button class="btn btn-primary edit" type="reset">edit</button><button class="btn btn-primary" type="delete">delete</button></td></tr>'
                );
                location.reload();
            },
            error: function (err) {
                console.log(err)
            },
        });
    })
    $(".edit").click(function () {
        var currentRow = $(this).closest("tr");

        var id = currentRow.find("th:eq(0)").text(); // get current row 1st TD value
        var msg = currentRow.find("td:eq(0)").text(); // get current row 2nd TD
        var newMsg = currentRow.find("td:eq(1)").find("input").val()
        var param = id + "," + newMsg;
        $.ajax({
            url: "index.php?data=board/updatedata/" + param,
            method: "GET",
            success: function (res) {
                res = JSON.parse(res);
                if (res["error"]) {
                    alert(res["msg"]);
                }
                newData = res["msg"];
                currentRow.find("td:eq(1)").find("input").val("");
                currentRow.find("td:eq(0)").text(newData.msg);
                console.log(newData.msg)
            },
            error: function (err) {
                console.log(err)
            },
        });
    })
    $(".delete").click(function () {
        var currentRow = $(this).closest("tr");

        var id = currentRow.find("th:eq(0)").text(); // get current row 1st TD value
        $.ajax({
            url: "index.php?data=board/deleteData/" + id,
            method: "GET",
            success: function (res) {
                res = JSON.parse(res);
                if (res["error"]) {
                    alert(res["msg"]);
                }
                currentRow.remove();
            },
            error: function (err) {
                console.log(err)
            },
        });
    })
    $(".logout").click(function () {
        $.ajax({
            url: "index.php?data=user/logout/",
            method: "GET",
            success: function (res) {
                res = JSON.parse(res);
                if (res["error"]) {
                    alert(res["msg"]);
                }
                location.reload();
            },
            error: function (err) {
                console.log(err)
            },
        });
    })
})
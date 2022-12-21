<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>

<body>
    <p><?php if ($_sParm["isLogin"]){?>
        <script>
        location.href = 'http://127.0.0.1/web/public/index.php?data=board/index/' + <?php echo $_sParm["userID"];?>
        </script>
        <?php }else{ ?>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th>帳號</th>
                <th>密碼</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="username">

                </td>
                <td><input type="password" class="password">

                </td>
                <td>
                    <button class="btn btn-primary submit" type="submit">Submit</button>
                    <button class="btn btn-success register" type="register" data-toggle="modal"
                        data-target="#registerModal">Register</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Regiser</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <div class="modal-body"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>帳號</th>
                            <th>密碼</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="register_name">

                            </td>
                            <td><input type="text" class="register_username">

                            </td>
                            <td><input type="password" class="register_password">

                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary register_submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php }; ?>
</body>
<script>
$(".register_submit").click(function() {
    var currentRow = $(this).closest(".modal-footer").siblings(".table").find("tbody");
    var name = currentRow.find(".register_name").val();
    var user = currentRow.find(".register_username").val(); // get current row 1st TD value
    var password = currentRow.find(".register_password").val(); // get current row 2nd TD
    var param = name + "," + user + "," + password;
    $.ajax({
        url: "index.php?data=user/register/" + param,
        method: "GET",
        success: function(data) {
            jdata = JSON.parse(data);
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
        error: function(err) {
            alert(err)
        },
    });
})
$(".submit").click(function() {
    var currentRow = $(this).closest("tr");
    var username = currentRow.find(".username").val();
    var password = currentRow.find(".password").val(); // get current row 1st TD value
    var param = username + "," + password;
    $.ajax({
        url: "index.php?data=user/login/" + param,
        method: "GET",
        success: function(data) {
            jdata = JSON.parse(data);
            if (jdata["error"]) {
                alert(jdata["msg"]);
                currentRow.find(".username").val("");
                currentRow.find(".password").val("");
                return
            }
            document.cookie = "token=" + jdata["msg"];
            location.reload();
        },
        error: function(err) {
            alert(err)
        },
    });
})
</script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <title>首頁</title>
</head>

<body>
    <?php if (!$_sParm["isLogin"]){?>
    <script>
    location.href = 'http://127.0.0.1/web/public/index.php?data=user/index/'
    </script>
    <?php }else{ ?>

    <table class="table">
        <thead>
            <tr>
                <th>流水號</th>
                <th>留言</th>
                <th>欲修改留言</th>
                <th><button class="btn btn-secondary logout">logout</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_sParm['Board'] as $iKey => $aStudent) {?>
            <tr>
                <!-- 印出:內容一-->
                <th><?php echo $aStudent['id']; ?></th>
                <td><?php echo $aStudent['msg']; ?></td>
                <td><input type="text">

                </td>
                <td>
                    <button class="btn btn-primary edit" type="reset">edit</button>
                    <button class="btn btn-danger delete" type="delete">delete</button>
                </td>
            </tr>
            <?php };?>
        </tbody>
    </table>

    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="New Message" aria-label="New Message"
            aria-describedby="new_msg" id="new_msg">
        <div class="input-group-append">
            <button class="btn btn-success new_msg_btn" type="button" id="new_msg">Submit</button>
        </div>
    </div>
    <?php }; ?>
</body>
<script>
$(".new_msg_btn").click(function() {
    var useid = <?php echo $_sParm['userID'] ?>;
    var msg = $(this).parent().siblings("input").val();
    var param = useid + "," + msg;
    var currentRow = $(this).parent().parent().siblings("table").children("tbody");
    $.ajax({
        url: "index.php?data=board/createData/" + param,
        method: "GET",
        success: function(data) {
            newData = JSON.parse(data);
            currentRow.append("<tr><th>" + newData['id'] + "</th><td>" + newData['msg'] +
                '</td><td><input type="text"></td><td><button class="btn btn-primary edit" type="reset">edit</button><button class="btn btn-primary" type="delete">delete</button></td></tr>'
            );
        },
        error: function(err) {
            console.log(err)
        },
    });
})
$(".edit").click(function() {
    var currentRow = $(this).closest("tr");

    var id = currentRow.find("th:eq(0)").text(); // get current row 1st TD value
    var msg = currentRow.find("td:eq(0)").text(); // get current row 2nd TD
    var newMsg = currentRow.find("td:eq(1)").find("input").val()
    var param = id + "," + newMsg;
    $.ajax({
        url: "index.php?data=board/updatedata/" + param,
        method: "GET",
        success: function(data) {
            newData = JSON.parse(data);
            currentRow.find("td:eq(1)").find("input").val("");
            currentRow.find("td:eq(0)").text(newData.msg);
        },
        error: function(err) {
            console.log(err)
        },
    });
})
$(".delete").click(function() {
    var currentRow = $(this).closest("tr");

    var id = currentRow.find("th:eq(0)").text(); // get current row 1st TD value
    $.ajax({
        url: "index.php?data=board/deleteData/" + id,
        method: "GET",
        success: function(data) {
            currentRow.remove();
            console.log(data)
        },
        error: function(err) {
            console.log(err)
        },
    });
})
$(".logout").click(function() {
    $.ajax({
        url: "index.php?data=user/logout/",
        method: "GET",
        success: function(data) {
            console.log(data)
        },
        error: function(err) {
            console.log(err)
        },
    });
})
$(document).ajaxStop(function() {
    window.location.reload();
});
</script>

</html>
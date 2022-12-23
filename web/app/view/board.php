<!DOCTYPE html>
<html lang="en">

<head>
    <?php require '../app/view/layout/head.php';?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>

<body>
    <?php if (!$_sParm["isLogin"]) {?>
    <script>
    location.href = 'http://127.0.0.1/web/public/index.php?data=user/index/'
    </script>
    <?php } else {?>

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
            <?php foreach ($_sParm['board'] as $iKey => $aBoard) {?>
            <tr>
                <!-- 印出:內容一-->
                <th><?php echo $aBoard['id']; ?></th>
                <td><?php echo $aBoard['msg']; ?></td>
                <td><input type="text">

                </td>
                <td>
                    <button class="btn btn-primary edit" type="reset">edit</button>
                    <button class="btn btn-danger delete" type="delete">delete</button>
                </td>
            </tr>
            <?php }
    ;?>
        </tbody>
    </table>

    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="New Message" aria-label="New Message"
            aria-describedby="new_msg" id="new_msg">
        <div class="input-group-append">
            <button class="btn btn-success new_msg_btn" type="button"
                id="<?php echo $_sParm['userID']; ?>">Submit</button>
        </div>
    </div>
    <?php }
;?>
</body>

</html>
<?php require "../app/view/layout/script.php"?>
<script src="./js/board.js"></script>
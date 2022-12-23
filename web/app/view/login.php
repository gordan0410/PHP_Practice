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
    <p><?php if ($_sParm["isLogin"]) {?>
        <script>
        location.href = 'http://127.0.0.1/web/public/index.php?data=board/index/' + <?php echo $_sParm["userID"]; ?>
        </script>
        <?php } else {?>
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

    <?php }
;?>
</body>

</html>
<?php require "../app/view/layout/script.php"?>
<script src="./js/login.js"></script>
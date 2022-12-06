<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../app/view/layout/head.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>
<body>
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>流水號</th>
                <th>姓名</th>
                <th>生日</th>
                <th>性別</th>
                <th>動作</th>
            </tr>
        </thead>
        <tbody class="hide_tbody">
            <?php foreach ($_sParm['Student'] as $iKey => $aStudent) {?>
            <tr>
                <!-- 印出:內容一-->
                <td><?php echo $aStudent['student_id']; ?></td>
                <td><?php echo $aStudent['student_name']; ?></td>
                <td><?php echo $aStudent['student_birth']; ?></td>
                <td><?php echo $aStudent['student_sex']; ?></td>
                <td><button id="<?php echo $aStudent['student_id']; ?>" type="button" class="btn btn-danger delete_btn">刪除</button></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <form id="add" action="index.php" method="get">
        <input type="hidden" name="data" value="home/insert">
        <input type="submit" class="btn btn-primary" value="新增資料">
    </form>
    <button type="button" class="btn btn-primary hide_btn">隱藏表格</button>
</div>
</body>
</html>
<?php require '../app/view/layout/script.php'; ?>
<script src="../public/js/student.js"></script>
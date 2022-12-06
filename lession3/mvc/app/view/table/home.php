<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>
<body>
<table class="table_border">
    <thead>
        <tr>
            <th>流水號</th>
            <th>姓名</th>
            <th>生日</th>
            <th>性別</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_sParm['Student'] as $iKey => $aStudent) {?>
        <tr>
            <!-- 印出:內容一-->
            <td><?php echo $aStudent['student_id']; ?></td>
            <td><?php echo $aStudent['student_name']; ?></td>
            <td><?php echo $aStudent['student_birth']; ?></td>
            <td><?php echo $aStudent['student_sex']; ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
</body>
</html>
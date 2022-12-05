<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習 - php+html</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>欄位一</th>
            <th>欄位二</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!-- 印出:內容一-->
            <td><?php echo "內容一";?></td>
            <td>內容二</td>
        </tr>
    </tbody>
</table>
<!-- 宣告陣列：[A=10, B=15]-->
<?php $aNumber = ['A' => 10, 'B' => 15]?>
<hr>
<!-- 如果A>B 顯示送出按鈕，否則顯示連結按鈕-->
<?php if ($aNumber['A'] > $aNumber['B']){?>
    <button type="button">送出按鈕</button>
<?php }else{ ?>
    <input type="button" value="連結按鈕" onclick="location.href='http://127.0.0.1/lession1/html_js_css/home.php'">
<?php } ?>
</body>
</html>
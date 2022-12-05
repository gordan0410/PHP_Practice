<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 載入css方式: head css，對單頁產生作用 -->
    <style>
        .div_border {
            border: 3px solid red;
        }
    </style>
    <!-- 載入css方式: 外部連結css，對單頁或多頁產生作用 -->
    <link rel="stylesheet" type="text/css" href="home.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習 - php + html + js + css</title>
</head>
<body>
<!-- 載入css方式: 標籤中使用css，只對標籤單獨產生作用 -->
<div style="border: 1px solid black;">div內容一</div>
<div class="div_border">div內容二</div>
<table class="table_border">
    <thead>
        <tr>
            <th>欄位一</th>
            <th>欄位二</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!-- 印出:內容一-->
            <td><?php echo "內容一"; ?></td>
            <td>內容二</td>
        </tr>
    </tbody>
</table>
<!-- 宣告陣列：[A=10, B=15]-->
<?php
//取網址 get a 參數值
$aNumber['A'] = (empty($_GET['a']) ? 10 : $_GET['a']);
//取網址 get b 參數值
if (empty($_GET['b'])) {
    $iB = 5;
} else {
    $iB = $_GET['b'];
}
$aNumber['B'] = $iB;
?>
<hr>
<!-- 如果A>B 顯示送出按鈕，否則顯示連結按鈕-->
<?php if ($aNumber['A'] > $aNumber['B']) {?>
    <button type="button" id="submit-button">送出按鈕</button>
<?php } else {?>
    <input type="button" value="連結按鈕" onclick="location.href='http://127.0.0.1/lession1/html_js_css/home.php?a=20'">
<?php }?>
</body>
</html>
<!-- 載入js方式: 外部連結js，對單頁或多頁產生作用 -->
<script src="home.js"></script>
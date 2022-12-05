<?php
$sServername   = "mysql";
$sUsername     = "root";
$sPassword     = "admin";
$sDatabasename = "myDB";

// 建立連線
$oConn = new mysqli($sServername, $sUsername, $sPassword, $sDatabasename);

// 檢查連線
if ($oConn->connect_error) {
    die("連線失敗: " . $oConn->connect_error);
}
echo "連線成功";
echo "<br>";
//解決中文亂碼問題
$oConn->query("SET NAMES utf8");

$sql     = "SELECT student_id, student_name, student_birth, student_sex FROM student";
$oResult = $oConn->query($sql);

if ($oResult->num_rows > 0) {
    echo '<br>';
    echo '<table>';
    echo '<thead><tr><th>編號</th><th>姓名</th><th>性別</th><th>生日</th></tr><tbody>';
    while ($aRow = $oResult->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $aRow['student_id'] . '</td>';
        echo '<td>' . $aRow['student_name'] . '</td>';
        echo '<td>' . $aRow['student_sex'] . '</td>';
        echo '<td>' . $aRow['student_birth'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody><table>';
} else {
    echo "0筆";
}
$oConn->close();

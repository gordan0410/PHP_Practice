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

$sSQL = "UPDATE student SET student_name='Peter', student_birth='1992-11-11' WHERE student_id=1";

if ($oConn->query($sSQL) === TRUE) {
  echo "更新資料成功";
} else {
  echo "更新資料失敗: " . $oConn->error;
}
$oConn->close();

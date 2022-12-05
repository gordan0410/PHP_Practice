<?php
$sServername = "mysql";
$sUsername = "root";
$sPassword = "admin";

// 建立連線
$oConn = new mysqli($sServername, $sUsername, $sPassword);

// 檢查連線
if ($oConn->connect_error) {
  die("連線失敗: " . $oConn->connect_error);
}
echo "連線成功";
echo "<br>";

//建立資料庫
$sSQL = "CREATE DATABASE myDB";
if ($oConn->query($sSQL) === TRUE) {
  echo "建立資料庫成功";
} else {
  echo "建立資料庫失敗: " . $oConn->error;
}

$oConn->close();
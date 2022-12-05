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
$oConn->close();
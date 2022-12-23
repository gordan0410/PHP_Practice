<?php

namespace Web\App\Core;

use mysqli_stmt;

/**
 * MysqlStmt mysql statement操作
 */
class MysqlStmt
{
    private $oStmt;
    private $oConn;

    /**
     * __construct  建立query statement
     *
     * @param  object $_oConn mysql連線
     * @param  string $_sSQL 欲格式化的sql語法
     * @return void
     */
    public function __construct($_oConn, $_sSQL)
    {
        $this->oConn = $_oConn;
        $this->oStmt = new mysqli_stmt($this->oConn, $_sSQL);
    }

    /**
     * __destruct 關閉statement
     *
     * @return void
     */
    public function __destruct()
    {
        $this->oStmt->close();
    }

    /**
     * bindParam 綁定參數, 根據sql語法內"?"數量進行綁定$_sTypes數量與$_mVars數量需一致
     *
     * @param  string $_sTypes s=string, i=int, d=float, b=bool
     * @param  string|int $_mVars
     * @return bool 是否成功
     */
    public function bindParam($_sTypes, &...$_mVars)
    {
        return $this->oStmt->bind_param($_sTypes, ...$_mVars);
    }

    /**
     * doQuery 執行statement, 並返回結果
     *
     * @return object mysqli_result query結果
     */
    public function doQuery()
    {
        $this->oStmt->execute();
        return $this->oStmt->get_result();
    }

}
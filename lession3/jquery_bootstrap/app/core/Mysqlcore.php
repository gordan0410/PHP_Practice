<?php
namespace Lessoion3\Jquery_bootstrap\App\Core;

use mysqli;

class Mysqlcore
{
    private $sServername;
    private $sUsername;
    private $sPassword;
    private $sDatabaseName;
    private $oConn;
    private $oResult;

    public function __construct()
    {
        $this->sServername   = DB_HOST;
        $this->sUsername     = DB_USER;
        $this->sPassword     = DB_PASS;
        $this->sDatabaseName = DB_DBNAME;
    }

    public function __destruct()
    {
        $this->oConn->close();
    }

    public function connenct()
    {
        $oConn = new mysqli($this->sServername, $this->sUsername, $this->sPassword, $this->sDatabaseName);
        if ($oConn->connect_error) {
            die("連線失敗: " . $oConn->connect_error);
        }
        $oConn->query("SET NAMES utf8");
        $this->oConn = $oConn;
    }

    public function checkError()
    {
        if ($this->oResult !== true) {
            echo $this->oConn->error;
        }
    }

    public function query($_sSQL)
    {
        $this->connenct();
        $this->oResult = $this->oConn->query($_sSQL);
        $this->checkError($this->oResult);
        return $this->oResult;
    }

    public function lastId()
    {
        return $this->oConn->insert_id;
    }

    public function fetch()
    {
        return $this->oResult->fetch_assoc();
    }

    public function fetch_all()
    {
        $aResult = [];
        while ($aRow = $this->oResult->fetch_assoc()) {
            $aResult[] = $aRow;
        }
        return $aResult;
    }
}

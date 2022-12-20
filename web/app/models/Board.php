<?php

namespace Web\App\Models;

use Web\App\Core\Mysqlcore;

class Board
{
    private $oMySQL;

    public function __construct()
    {
        $this->oMySQL = new Mysqlcore();
    }
    public function getAll($_iOwnerID)
    {
        $sSQL = "SELECT id, owner_id, msg FROM board Where owner_id=$_iOwnerID";
        $this->oMySQL->query($sSQL);
        $aResult = $this->oMySQL->getAll();
        return $aResult;
    }

    public function createTable()
    {
        $sSQL = "CREATE TABLE IF NOT EXISTS board (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    owner_id INT(6) NOT NULL,
    msg VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        return $this->oMySQL->query($sSQL);
    }

    public function createData($_iOwnerID, $_sMsg)
    {
        $sSQL = "INSERT board(owner_id, msg) Values($_iOwnerID,'$_sMsg')";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->lastId();
    }

    public function getData($_iID)
    {
        $sSQL = "SELECT id, msg FROM board WHERE id=$_iID";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getSingle();
    }

    public function updateData($_iID , $_sMsg)
    {
        $sSQL = "UPDATE board SET msg='$_sMsg' WHERE id=$_iID";
        $this->oMySQL->query($sSQL);
        return $_iID;
    }

    public function deleteData($_iID)
    {
        $sSQL = "DELETE FROM board WHERE id=$_iID";
        return $this->oMySQL->query($sSQL);
    }
    
}
<?php

namespace Web\App\Models;

use Web\App\Core\Mysqlcore;

/**
 * Board 留言板DB相關
 */
class Board
{
    private $oMySQL;

    public function __construct()
    {
        $this->oMySQL = new Mysqlcore();
    }

    /**
     * createTable database沒table則建立
     *
     * @return void
     */
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

    /**
     * getAll 取得該會員所有留言
     *
     * @param  int $_iOwnerID 會員ID
     * @return array 該會員所有留言
     */
    public function getAll($_iOwnerID)
    {
        $sSQL = "SELECT id, owner_id, msg FROM board Where owner_id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("i", $_iOwnerID);
        $oResult = $oStmt->doQuery();
        return $this->oMySQL->getAll($oResult);
    }

    /**
     * createData 建立新留言
     *
     * @param  int $_iOwnerID 會員ID
     * @param  string $_sMsg 新留言
     * @return int 該筆留言的ID
     */
    public function createData($_iOwnerID, $_sMsg)
    {
        $sSQL = "INSERT board(owner_id, msg) Values(?,?)";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("is", $_iOwnerID, $_sMsg);
        $oStmt->doQuery();
        return $this->oMySQL->lastId();
    }

    /**
     * getData 取得留言資料
     *
     * @param  int $_iID
     * @return array 取得該留言資料
     */
    public function getData($_iID)
    {
        $sSQL = "SELECT id, msg FROM board WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("i", $_iID);
        $oResult = $oStmt->doQuery();
        return $this->oMySQL->getSingle($oResult);
    }

    /**
     * updateData 更新留言
     *
     * @param  int $_iID 留言ID
     * @param  string $_sMsg 新留言內容
     * @return int 留言ID
     */
    public function updateData($_iID, $_sMsg)
    {
        $sSQL = "UPDATE board SET msg=? WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("si", $_sMsg, $_iID);
        $oStmt->doQuery();
        return $_iID;
    }

    /**
     * deleteData
     *
     * @param  int $_iID 留言ID
     * @return bool 是否移除成功
     */
    public function deleteData($_iID)
    {
        $sSQL = "DELETE FROM board WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("i", $_iID);
        return (bool) $oStmt->doQuery();

    }

}

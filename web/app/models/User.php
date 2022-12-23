<?php

namespace Web\App\Models;

use Web\App\Core\Mysqlcore;

/**
 * User 使用者DB相關
 */
class User
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
        $sSQL = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(10)  NOT NULL,
    username VARCHAR(10) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        return $this->oMySQL->query($sSQL);
    }

    /**
     * createData 新增使用者
     *
     * @param  string $_sName 使用者姓名
     * @param  string $_sUsername 使用者帳號
     * @param  string $_sPassword 使用者密碼
     * @param  string $_sToken 使用者token
     * @return int 該使用者ID
     */
    public function createData($_sName, $_sUsername, $_sPassword, $_sToken)
    {
        $sSQL = "INSERT user(name, username, password, token) Values(?, ?, ?, ?)";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("ssss", $_sName, $_sUsername, $_sPassword, $_sToken);
        $oStmt->doQuery();
        return $this->oMySQL->lastId();
    }

    /**
     * getDataByID 取得使用者資料byID
     *
     * @param  int $_iID 使用者ID
     * @return array 使用者資料
     */
    public function getDataByID($_iID)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("i", $_iID);
        $oResult = $oStmt->doQuery();
        return $this->oMySQL->getSingle($oResult);
    }

    /**
     * getDataByUserName  取得使用者資料by帳號
     *
     * @param  string $_sUsername 使用者帳號
     * @return array 使用者資料
     */
    public function getDataByUserName($_sUsername)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE username=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("s", $_sUsername);
        $oResult = $oStmt->doQuery();
        return $this->oMySQL->getSingle($oResult);
    }

    /**
     * checkUserExist 確認使用者是否存在
     *
     * @param  string $_sUsername 使用者帳號
     * @return int >0 = 有資料
     */
    public function checkUserExist($_sUsername)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE username=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("s", $_sUsername);
        $oStmt->doQuery();
        return $this->oMySQL->getAffectedRow();
    }

    /**
     * getDataByToken 取得使用者資料by token
     *
     * @param  string $_sToken 使用者token
     * @return array 使用者資料
     */
    public function getDataByToken($_sToken)
    {
        $sSQL = "SELECT id,name, username, password FROM user WHERE token=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("s", $_sToken);
        $oResult = $oStmt->doQuery();
        return $this->oMySQL->getSingle($oResult);
    }

    /**
     * editUserName 編輯使用者姓名
     *
     * @param  int $_iID 使用者ID
     * @param  string $_sName 新使用者姓名
     * @return bool 是否成功
     */
    public function editUserName($_iID, $_sName)
    {
        $sSQL = "UPDATE user SET name=? WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("is", $_iID, $_sName);
        return (bool) $oStmt->doQuery();

    }

    /**
     * editPassword 編輯使用者密碼
     *
     * @param  int $_iID 使用者ID
     * @param  string $_sNewPassword 新使用者密碼
     * @return bool 是否成功
     */
    public function editPassword($_iID, $_sNewPassword)
    {
        $sSQL = "UPDATE user SET password=? WHERE id=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("is", $_iID, $_sNewPassword);
        return (bool) $oStmt->doQuery();
    }

    /**
     * deleteData 刪除使用者
     *
     * @param  string $_sUsername 使用者帳號
     * @return bool 是否成功
     */
    public function deleteData($_sUsername)
    {
        $sSQL = "DELETE FROM student WHERE username=?";
        $oStmt = $this->oMySQL->newQueryStmt($sSQL);
        $oStmt->bindParam("s", $_sUsername);
        return (bool) $oStmt->doQuery();
    }

}
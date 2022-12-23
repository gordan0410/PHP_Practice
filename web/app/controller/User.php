<?php

namespace Web\App\Controller;

use Exception;
use Web\App\Core\Controller;

/**
 * User 會員頁面及資料增刪查改
 */
class User extends Controller
{
    /**
     * __construct 實例化model, 並建立相應資料表
     *
     * @return void
     */
    public function __construct()
    {
        $this->postModel = $this->model('User');
        $this->postModel->createTable();
    }

    /**
     * index 檢查cookie是否有token並驗證token, 並顯示前端頁面
     *
     * @return void echo array['isLogin' => booln 是否成功登入, 'userID' => int 用戶ID]
     */
    public function index()
    {
        $bLogin = false;
        $aUser = array("id" => 0);
        if (isset($_COOKIE["token"])) {
            $sToken = $_COOKIE["token"];
            $aUser = $this->postModel->getDataByToken($sToken);
            if (!empty($aUser)) {
                $bLogin = true;
            } else {
                $aUser["id"] = 0;
            }
        };
        $aData = [
            'isLogin' => $bLogin,
            'userID' => $aUser["id"],
        ];

        $this->view('login', $aData);
    }

    /**
     * register 註冊功能, 完成後回傳token
     *
     * @param  string $_sparam 註冊資料[使用者姓名, username, password]
     * @return void echo 使用者的token json [error, msg], msg[token]
     */
    public function register($_sparam)
    {
        $aData = explode(",", $_sparam);
        $sName = $aData[0];
        $sUsername = $aData[1];
        $sPassword = $aData[2];
        if (empty($sName) || empty($sUsername) || empty($sPassword)) {
            throw new Exception("register data error");
        };
        $iUserCount = $this->postModel->checkUserExist($sUsername);
        if ($iUserCount != 0) {
            throw new Exception("user exist");
        };
        $sToken = password_hash($sPassword, 1);
        $sHashPassword = password_hash($sPassword, null);
        $iID = $this->postModel->createData($sName, $sUsername, $sHashPassword, $sToken);
        $aUser = $this->postModel->getDataByID($iID);

        $aResult = array(
            "error" => false,
            "msg" => $aUser["token"],
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * login 登入功能, 完成後回傳token
     *
     * @param  string $_sparam 登入資料[username, password]
     * @return void echo 使用者的token json [error, msg], msg[token]
     */
    public function login($_sparam)
    {
        $aData = explode(",", $_sparam);
        $sUsername = $aData[0];
        $sPassword = $aData[1];
        $aUser = $this->postModel->getDataByUserName($sUsername);
        if (empty($aUser)) {
            throw new Exception("user not exist");
        };
        if (!password_verify($sPassword, $aUser["password"])) {
            throw new Exception("wrong password");
        };
        $aResult = array(
            "error" => false,
            "msg" => $aUser["token"],
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * logout 登出功能, unset對方的token cookie
     *
     * @return void echo 是否登出成功 json [error, msg], msg[bool]
     */
    public function logout()
    {
        setcookie("token", "", time() - 3600);
        $aResult = array(
            "error" => false,
            "msg" => true,
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * editUserName 修改使用者姓名
     *
     * @param  string $_token 使用者token
     * @param  string $_sName 新使用者姓名
     * @return void echo 是否修改成功 json [error, msg], msg[bool]
     */
    public function editUserName($_token, $_sName)
    {
        $aUser = $this->postModel->getDataByToken($_token);
        if (is_null($aUser)) {
            throw new Exception("user not found.");
        };
        $bOK = $this->postModel->editUserName($aUser["id"], $_sName);
        $aResult = array(
            "error" => false,
            "msg" => $bOK,
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * editPassword 修改密碼
     *
     * @param  string $_token 使用者token
     * @param  string $_sOldPassword 舊密碼
     * @param  string $_sNewPassword 新密碼
     * @return void echo 是否修改成功 json [error, msg], msg[bool]
     */
    public function editPassword($_token, $_sOldPassword, $_sNewPassword)
    {
        $aUser = $this->postModel->getDataByToken($_token);
        if (empty($aUser)) {
            throw new Exception("no token found");
        };
        $sHashOldPassword = password_hash($_sOldPassword, null);
        if ($aUser["password"] != $sHashOldPassword) {
            throw new Exception("password error");
        };
        $sHashNewPassword = password_hash($_sNewPassword, null);
        return $this->postModel->editPassword($aUser["id"], $sHashNewPassword);
    }
}
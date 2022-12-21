<?php

namespace Web\App\Controller;

use Web\App\Core\Controller;
use Exception;

class User extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('User');
        $this->postModel->createTable();
    }

    public function index()
    {   
        $bLogin = false;
        $aUser = array("id"=>0);
        if (isset($_COOKIE["token"])){
            $sToken = $_COOKIE["token"];
            $aUser = $this->postModel->getDataByToken($sToken);
            if (!empty($aUser)){
                $bLogin = true;
            }else{
                $aUser["id"]= 0;
            }
        };
        $aData = [
            'isLogin' => $bLogin,
            'userID' => $aUser["id"],     
        ];
        
        $this->view('login', $aData);
    }

    public function register($_sparam)
    {   
        $aData = explode(",", $_sparam);
        $sName = $aData[0];
        $sUsername = $aData[1];
        $sPassword = $aData[2];
        if (empty($sName) || empty($sUsername) || empty($sPassword)){
            $msg = "data error";
            $aResult = array(
                "error" => true,
                "msg" => $msg,
            );
            $json = json_encode($aResult);
            echo $json;
            return;
        };
        $iUserCount = $this->postModel->checkUserExist($sUsername);
        if ($iUserCount != 0){
            $msg = "user exist";
            $aResult = array(
                "error" => true,
                "msg" => $msg,
            );
            $json = json_encode($aResult);
            echo $json;
            return;
        };
        $sToken = password_hash($sPassword, 1);
        $sHashPassword = password_hash($sPassword, null);
        $iID =  $this->postModel->createData($sName, $sUsername, $sHashPassword, $sToken);
        $aUser = $this->postModel->getDataByID($iID);

        $msg =  $aUser["token"];
        $aResult = array(
                "error" => false,
                "msg" => $msg,
            );
        $json = json_encode($aResult);
        echo $json;
        return;
    }

    public function login($_sparam)
    {
        $aData = explode(",", $_sparam);
        $sUsername = $aData[0];
        $sPassword = $aData[1];
        $aUser = $this->postModel->getDataByUserName($sUsername);
        if (empty($aUser)){
            $msg = "user not exist";
            $aResult = array(
                "error" => true,
                "msg" => $msg,
            );
            $json = json_encode($aResult);
            echo $json;
            return;
        };
        if (!password_verify($sPassword, $aUser["password"])){
              $msg = "wrong password";
            $aResult = array(
                "error" => true,
                "msg" => $msg,
            );
            $json = json_encode($aResult);
            echo $json;
            return;
        };
        $msg =  $aUser["token"];
        $aResult = array(
                "error" => false,
                "msg" => $msg,
            );
        $json = json_encode($aResult);
        echo $json;
        return;
    }

    public function logout()
    {
       setcookie("token","", time() - 3600);
    }

    public function editUserName($_token, $_sName)
    {
        $aUser = $this->postModel->getDataByToken($_token);
        return $this->postModel->editUserName($aUser["id"], $_sName);
    }

    public function editPassword($_token, $_sOldPassword, $_sNewPassword)
    {
        $aUser = $this->postModel->getDataByToken($_token);
        if (empty($aUser)){
            throw new Exception("no token found");
        };
        $sHashOldPassword = password_hash($_sOldPassword, null);
        if ($aUser["password"] != $sHashOldPassword){
             throw new Exception("password error");
        };
        $sHashNewPassword = password_hash($_sNewPassword, null);
        return $this->postModel->editPassword($aUser["id"], $sHashNewPassword);
    }
}
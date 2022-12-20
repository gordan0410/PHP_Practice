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

    public function index($_username)
    {   
        $bLogin = false;
        if (!empty($_iID)){   
            $aUser = $this->postModel->getData($_iID);
        }
        if (!empty($aUser)){
            $bLogin = true;
        }
        
        $aData = [
            'IsLogin' => $bLogin,
        ];
        
        $this->view('login', $aData);
    }

    public function regiser($_sparam)
    {   
        $aData = explode(",", $_sparam);
        $sName = $aData[0];
        $sUsername = $aData[1];
        $sPassword = $aData[2];
        if (empty($sName) || empty($sUsername) || empty($sPassword)){
            throw new Exception("data error");
        };
        return $this->postModel->createData($sName, $sUsername, $sPassword);
    }

    public function login($_sparam)
    {
        $aData = explode(",", $_sparam);
        $sUsername = $aData[0];
        $sPassword = $aData[1];
        $aUser = $this->postModel->getData($sUsername);
        if (empty($aUser)){
            throw new Exception("username error");
        }
        if ($aUser["password"] != $sPassword){
            throw new Exception("password error");
        };
        return true;
    }

    public function editUser($_sparam)
    {
        $bOk = $this->login($_sparam);
        if (!$bOk){
            throw new Exception("login error");
        };
        $aData = explode(",", $_sparam);
        $sUsername = $aData[0];
        $sNewPassowrd = $aData[2];
        $sNewName = $aData[3];
        return $this->postModel->updateData($sUsername, $sNewName, $sNewPassowrd);
    }
}
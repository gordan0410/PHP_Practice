<?php
namespace Web\App\Controller;

use Web\App\Core\Controller;

class Board extends Controller
{
    private $postModel;
    private $userModel;

    public function __construct()
    {
        $this->postModel = $this->model('Board');
        $this->userModel = $this->model('User');
        $this->postModel->createTable();
    }

    public function index()
    {
        $bLogin = false;
        $aUser = array("id"=>0);
        if (isset($_COOKIE["token"])){
            $sToken = $_COOKIE["token"];
            $aUser = $this->userModel->getDataByToken($sToken);
            if (!empty($aUser)){
                $bLogin = true;
            }
        };
        $result = array("nodata");
        if ($aUser["id"] != 0){
            $result = $this->postModel->getAll($aUser["id"]);
        };
        $aData = [
            'isLogin' => $bLogin,
            'userID' => $aUser['id'],
            'Board' => $result,
        ];
        $this->view('board', $aData);
    }

    public function createData($_sparam)
    {   
        $aData = explode(",", $_sparam);
        $iOwnerID = $aData[0];
        $sMsg = $aData[1];
        $iID = $this->postModel->createData($iOwnerID, $sMsg);
        $result = $this->postModel->getData($iID);
        $json = json_encode($result);
        echo $json;
    }

    public function updateData($_sparam)
    {
        $aData = explode(",", $_sparam);
        $iID = $aData[0];
        $sMsg = $aData[1];
        $iID = $this->postModel->updateData($iID, $sMsg);
        $result = $this->postModel->getData($iID);
        $json = json_encode($result);
        echo $json;
    }

    public function deleteData($_iID)
    {
        echo $this->postModel->deleteData($_iID);
    }
}
<?php
namespace Web\App\Controller;

use Web\App\Core\Controller;

class Board extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Board');
        $this->postModel->createTable();
    }

    public function index($_iOwnerID)
    {
        $aData = [
            'Board' => $this->postModel->getAll($_iOwnerID),
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
<?php
namespace Web\App\Controller;

use Web\App\Core\Controller;

/**
 * Board 留言板頁面及增刪查改功能
 */
class Board extends Controller
{
    /**
     * __construct 建構子: 實例化兩個model, 並建立相應資料表
     *
     * @return void
     */
    public function __construct()
    {
        $this->oPostModel = $this->model('Board');
        $this->oUserModel = $this->model('User');
        $this->oPostModel->createTable();
        $this->oUserModel->createTable();
    }

    /**
     * index 首頁: 檢查cookie是否有token並驗證token, 並顯示前端頁面
     *
     * @return void echo array['isLogin' => booln 是否成功登入, 'userID' => int 用戶ID, 'board' => array 會員留言板結果[id, owner_id, msg] ]
     */
    public function index()
    {
        $bLogin = false;
        $iUserID = 0;
        if (isset($_COOKIE["token"])) {
            $sToken = $_COOKIE["token"];
            $aUser = $this->oUserModel->getDataByToken($sToken);
            if (isset($aUser)) {
                $bLogin = true;
                $iUserID = $aUser['id'];
            }
        };

        $aResult = $this->oPostModel->getAll($iUserID);

        $aData = [
            'isLogin' => $bLogin,
            'userID' => $iUserID,
            'board' => $aResult,
        ];
        $this->view('board', $aData);
    }

    /**
     * createData 建立留言
     *
     * @param  string $_sParam 留言資料[iOwnerID, sMsg] ex."1234,我是留言"
     * @return void echo 新增的留言資料 json [error, msg], msg[id, msg]
     */
    public function createData($_sParam)
    {
        $aData = explode(",", $_sParam);
        $sOwnerID = $aData[0];
        $sMsg = $aData[1];
        $iID = $this->oPostModel->createData($sOwnerID, $sMsg);
        $aData = $this->oPostModel->getData($iID);
        $aResult = array(
            "error" => false,
            "msg" => $aData,
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * updateData 變更留言內容
     *
     * @param  string $_sParam 變更資料[留言ID, 新留言內容]
     * @return void echo 變更的留言資料 json [error, msg], msg[id, msg]
     */
    public function updateData($_sParam)
    {
        $aData = explode(",", $_sParam);
        $sID = $aData[0];
        $sMsg = $aData[1];
        $sID = $this->oPostModel->updateData($sID, $sMsg);
        $aData = $this->oPostModel->getData($sID);
        $aResult = array(
            "error" => false,
            "msg" => $aData,
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }

    /**
     * deleteData 刪除資料
     *
     * @param  string $_sID
     * @return void  echo 留言是否刪除成功 json [error, msg], msg[bool]
     */
    public function deleteData($_sID)
    {
        $bOK = $this->oPostModel->deleteData($_sID);
        $aResult = array(
            "error" => false,
            "msg" => $bOK,
        );
        $sJson = json_encode($aResult);
        echo $sJson;
    }
}

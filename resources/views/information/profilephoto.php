<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RunQuery
{

        public function Query()
        {
              $Image = $_FILES['Image'];
              $FileName = $_FILES['Image']['name'];
              $ext = substr(strrchr($FileName,"."),1);	//확장자앞 .을 제거하기 위하여 substr()함수를 이용
              $ext = strtolower($ext);
              if(!is_uploaded_file($_FILES['Image']['tmp_name'])){
                     die("0");
              }else if(300*1024 < $_FILES['Image']['size']){
                    die("1");
              }else if(preg_match("/jpg|jpeg|png|gif|bmp/",$ext)==false){
                        die("2");
              }else{
                  $uploadImage = "./uploads/".microtime(true)."ab".$_SESSION['userPK'];
                  move_uploaded_file($_FILES['Image']['tmp_name'],$uploadImage);
                  $PreventProfilePhotoes = DB::select("select ProfilePhotoURL from userinfo where userPK = ?",[$_SESSION['userPK']]);
                  foreach($PreventProfilePhotoes as $URL){
                    $GLOBALS['PreURL'] = $URL->ProfilePhotoURL;
                    break;
                  }
                  if(is_file($GLOBALS['PreURL'])==true){
                    unlink($GLOBALS['PreURL']);
                  }
                  DB::update("update userinfo set ProfilePhotoURL = ? where userPK = ?",[$uploadImage,$_SESSION['userPK']]);
                  echo $uploadImage;
              }
        }

}

    $A = new RunQuery();
    $A->Query();

?>

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class msgSendDBClass extends Controller
{

  public function msgSendDB()
  {
    $artNumber = NULL;

        //Inserting msgInfo
    $Sentence = "insert into msgInfo (creatorPK, Title, Detail)
    values ('".$_SESSION['userPK']."' , '".$_POST['msgTitle']."', '".$_POST['msgDetail']."')";
    $DBRun = DB::insert(DB::raw($Sentence));

        //getting msgPK
    $msgPK1 = "";
    $Sentence = "select msgPK from msgInfo order by create_date desc limit 1";
    $DBResult = DB::select(DB::raw($Sentence));
    foreach ($DBResult as $result) {
      $msgPK1 = $result->msgPK;
    }

    //getting bridge userPK
    $GLOBALS['userPKArray']=array();
    $Sentence2 = "select artPK from workDB where userPK = ".$_SESSION['userPK'];
    $items = DB::select(DB::raw($Sentence2));
    foreach($items as $item){
      $Sentence3 = "select userPK from workDB where artPK = ".$item->artPK;
      $V = DB::select(DB::raw($Sentence3));
      foreach($V as $v1){ //$v1 is userPK
        if($v1->userPK != $_SESSION['userPK']){ //자신의 userPK 는 걸러진다.
          array_push($GLOBALS['userPKArray'],$v1->userPK);
        }
      }
    }
    
    $GLOBALS['userPKArray']=array_unique($GLOBALS['userPKArray']);

        ///insert info to msg [msgPK,PasserPK,ReceiverPK] <- PasserPK는 최초의 전달이 아닐경우에는 다른 userPK 가 들어가야 한다. ReceiverPK 는 user를 List 에서 고르기 시작한다면 바뀔듯.
    if(sizeof($GLOBALS['userPKArray'])>0){  //메시지 받는사람이 없거나, 자기 자신한테 보내면 안보내지게 할 수 있다.
      foreach($GLOBALS['userPKArray'] as $k){
        DB::insert('insert into msgDeliverInfo (msgPK, PasserPK, ReceiverPK) values (?, ?, ?)',array($msgPK1, $_SESSION['userPK'], $k));
      }
    }


  }

}

$A = new msgSendDBClass();
$A->msgSendDB();

die("Upload Success");

?>

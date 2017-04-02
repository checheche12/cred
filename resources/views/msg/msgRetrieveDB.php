<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class msgRetrieveDBClass extends Controller
{

  public function msgRetrieveDB()
  {

        //Inserting msgInfo
    $msgInfoArr = array();
    $Sentence = "select * from msgDeliverInfo where ReceiverPK = ".$_SESSION['userPK'];
    $msgDeliverInfo = DB::select(DB::raw($Sentence));
    foreach ($msgDeliverInfo as $item1) {
      $Sentence2 = "select * from msgInfo where msgPK = ".$item1->msgPK;
      $msgInfo = DB::select(DB::raw($Sentence2));
      foreach ($msgInfo as $item2) {
        $temp = array();
        //0 msgPK, 1 creatorPK, 2 PasserPK, 3 Title, 4 Detail, 5 create_date, 6 expiry_date
        $temp = array($item1->msgPK,$item2->creatorPK,$item1->PasserPK,$item2->Title,$item2->Detail,$item2->create_date,$item2->expiry_date);
        array_push($msgInfoArr,$temp);
      }
    }
    die(json_encode($msgInfoArr));
  }
}

$A = new msgRetrieveDBClass();
$A->msgRetrieveDB();


?>

<?php

  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;


  class makeNewArtClass extends Controller
  {
      public function fixed(){
        /*
          $Sentence = "update totalart set description = '".$_POST['Description']."', title = '".$_POST['Title']."', ArtURL = '".$_POST['ArtURL']."' where artPK = '".$_POST['artPK']."'";
          $users = DB::update(DB::raw($Sentence));
        */
          DB::update("update totalart set description = ? , title = ? , ArtURL = ? where artPK = ?", [$_POST['Description'],$_POST['Title'],$_POST['ArtURL'],$_POST['artPK']]);

          $GLOBALS['creditAdder'] = array();
          $Sentence = DB::select("select * from workDB where artPK = ?",[$_POST['artPK']]);
          foreach($Sentence as $v){
            if($v->checkCredit == '1'){
              array_push($GLOBALS['creditAdder'],$v->userPK);
            }
          }

          $Sentence = "delete from workDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from artDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from TagNotUser where ArtPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Array = $_POST['main'];

          foreach($Array as $v1){
              DB::insert('insert into workDB (userPK, position, artPK)
              values (?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK']));
              DB::insert('insert into artDB (artPK,userPK)
              values (?,?)',array($_POST['artPK'],$v1[0]));
              if($v1[0]!=$_SESSION['userPK']){

                if(in_array($v1[0],$GLOBALS['creditAdder'])){

                  DB::update('update workDB set checkCredit = 1 where userPK = ?',[$v1[0]]);

                }else{
                  DB::insert('insert into notification (senderuserPK,recieveruserPK,notificationKind,notificationPlacePK
                  ,uploaddate) values (?,?,?,?,?)',[$_SESSION['userPK'],$v1[0],"3",$_POST['artPK'],date("Y-m-d H:i:s")]);
                }
              }else{
                DB::update('update workDB set checkCredit = 1 where userPK = ?',[$_SESSION['userPK']]);
              }
          }

          if(isset($_POST['Notuser'])){

            $Array = $_POST['Notuser'];
            foreach($Array as $v1){
                DB::insert('insert into TagNotUser (tagUser, position, artPK)
                values (?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK']));
            }
          }

      }
  }


  $A = new makeNewArtClass();
  $A->fixed();
?>

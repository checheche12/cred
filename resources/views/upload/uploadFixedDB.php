<?php

  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  session_start();

  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }

  class makeNewArtClass extends Controller
  {
      public function fixed(){
          $Sentence = "update totalart set description = '".$_POST['Description']."', title = '".$_POST['Title']."', ArtURL = '".$_POST['ArtURL']."' where artPK = '".$_POST['artPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "delete from workDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from artDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Array = $_POST['main'];

          foreach($Array as $v1){
              DB::insert('insert into workDB (userPK, position, artPK)
              values (?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK']));
              DB::insert('insert into artDB (artPK,userPK)
              values (?,?)',array($_POST['artPK'],$v1[0]));
          }

      }
  }


  $A = new makeNewArtClass();
  $A->fixed();
?>
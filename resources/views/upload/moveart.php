<?php

  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  session_start();

  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }

  class moveartclass extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function moveart()
      {

          DB::insert('insert into workDB (position, userPK, artPK)
          values (?, ?, ?)',array($_GET['art'][3],$_SESSION['userPK'],$_GET['art'][2]));

          $Sentence3 = "delete from TagNotUser where tagPK = ".$_GET['art'][0];
          $users3 = DB::delete(DB::raw($Sentence3));
      }
  }

  $A = new moveartclass();
  $A->moveart();
?>

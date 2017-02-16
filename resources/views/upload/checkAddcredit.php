<?php

  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  session_start();

  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }

  class checkAddCredit extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function checkEmailCredit()
      {
          $Sentence = "select Name,userPK from userinfo where Email = '".$_POST['email']."'";
          $users = DB::select(DB::raw($Sentence));
          if($users==NULL){
            echo 'There is no Email';
          }else{

              $imshi = array();

              foreach($users as $user){
                    array_push($imshi,$user->Name);
                    array_push($imshi,$user->userPK);
                    die(json_encode($imshi));
              }

          }
      }

  }

  $A = new checkAddCredit();
  $A->checkEmailCredit();

?>

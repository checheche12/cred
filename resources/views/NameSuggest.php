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
            $userSuggest = array();
            $Sentence = 'select * from userinfo where Name like "%'.$_GET['email'].'%"';
            $users = DB::select(DB::raw($Sentence));
            foreach($users as $user){
                  $imshi = array();
                  $imshi = array($user->Name,$user->Email);
                  array_push($userSuggest,$imshi);
            }

            die(json_encode($userSuggest));
        }
    }

    $A = new checkAddCredit();
    $A->checkEmailCredit();
?>

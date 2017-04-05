<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class searchProcess extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function searchFunction()
        {
          $userSuggest = array();
          $Sentence = 'select * from userinfo LEFT OUTER JOIN keywordDB ON userinfo.userPK=keywordDB.userPK where Name like "%'.$_GET['inputValue'].'%" OR Career like "%'.$_GET['inputValue'].'%" OR education like "%'.$_GET['inputValue'].'%" OR belong like "%'.$_GET['inputValue'].'%" OR location like "%'.$_GET['inputValue'].'%" OR keyword like "%'.$_GET['inputValue'].'%"';
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
            $imshi = array();
            $imshi = array($user->Email,$user->Name,$user->ProfilePhotoURL,$user->userPK,$user->Career,$user->education,$user->belong,$user->location);
            array_push($userSuggest,$imshi);
          }
          die(json_encode($userSuggest));
        }
      }

      $A = new searchProcess();
      $A->searchFunction();
      ?>

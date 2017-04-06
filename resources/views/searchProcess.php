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
          $Sentence = "";

          // select A.userPK, Name, Email, Career, education, belong, keyword, Organization from keywordDB as A JOIN userExperience as B ON A.userPK=B.userPK JOIN userinfo as C ON A.userPK=C.userPK;

          $Sentence = ' select DISTINCT A.userPK, Name, Email,ProfilePhotoURL, Career, education, belong,location from keywordDB as A JOIN userExperience as B ON A.userPK=B.userPK JOIN userinfo as C ON A.userPK=C.userPK where Name like "%'.$_GET['inputValue'].'%" OR Career like "%'.$_GET['inputValue'].'%" OR education like "%'.$_GET['inputValue'].'%" OR belong like "%'.$_GET['inputValue'].'%" OR location like "%'.$_GET['inputValue'].'%" OR keyword like "%'.$_GET['inputValue'].'%"';
           // select name, GROUP_CONCAT(keyword),GROUP_CONCAT(Organization) from userinfo as A JOIN keywordDB as B ON A.userPK=B.userPK JOIN userExperience as C ON A.userPK=C.userPK GROUP BY name

          // select * from userinfo as A JOIN keywordDB as B ON A.userPK=B.userPK JOIN userExperience as C ON A.userPK=C.userPK
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

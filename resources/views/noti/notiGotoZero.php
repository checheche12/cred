<?php

class notiaddClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function notiadd()
      {
            DB::update('update userinfo set eventCheck = 0 where userPK = ?',[$_SESSION['userPK']]);
      }
}


$dmaddDetailMake = new notiaddClass();
$dmaddDetailMake->notiadd();

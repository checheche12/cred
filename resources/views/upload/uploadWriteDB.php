<?php

  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;


  class makeNewArtClass extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function makeNewArt()
      {
          $artNumber = NULL;
          DB::insert('insert into totalart (title, ArtURL, Description,uploaddate,lastloaddate) values (?, ?, ?, ?, ?)',array($_POST['Title'],$_POST['ArtURL'],$_POST['Description'],date("Y-m-d H:i:s"),date("Y-m-d H:i:s")));

          $Sentence3 = "select * from totalart order by artPK desc limit 1";

          $users3 = DB::select(DB::raw($Sentence3));
          foreach($users3 as $user){
              $artNumber=$user->artPK;
          }

            $Array = $_POST['main'];

            foreach($Array as $v1){
                DB::insert('insert into workDB (userPK, position, artPK)
                values (?, ?, ?)',array($v1[0],$v1[1],$artNumber));
                DB::insert('insert into artDB (artPK,userPK)
                values (?,?)',array($artNumber,$v1[0]));
            }
            if(isset($_POST['Notuser'])){

                  $Array = $_POST['Notuser'];
                  foreach($Array as $v1){
                      DB::insert('insert into TagNotUser (tagUser, position, artPK)
                      values (?, ?, ?)',array($v1[0],$v1[1],$artNumber));

                  }
            }

      }
  }

  $A = new makeNewArtClass();
  $A->makeNewArt();

?>

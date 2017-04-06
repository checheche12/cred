<?php
  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  class DeleteArtClass extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function DeleteArt()
      {
          $Sentence = "delete from totalart where ArtPK = ".$_GET['int'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from workDB where ArtPK = ".$_GET['int'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from artDB where ArtPK = ".$_GET['int'];
          $users = DB::delete(DB::raw($Sentence));
      }

  }
  $A = new DeleteArtClass();
  $A->DeleteArt();

?>

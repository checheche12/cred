<?php
  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  session_start();

  $Sentence = "select userPK from workDB where artPK = ".$_GET['ArtPK'];
  $users = DB::select(DB::raw($Sentence));
  $checkInfo = false;
  foreach($users as $user){
      if($user->userPK == $_SESSION['userPK']){
        $checkInfo = true;
      }
  }
  if($checkInfo==false){
    header('Location: ./main');
    exit;
  }

  class DeleteArtClass extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function DeleteArt()
      {
          $Sentence = "delete from totalart where ArtPK = ".$_GET['ArtPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from workDB where ArtPK = ".$_GET['ArtPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from artDB where ArtPK = ".$_GET['ArtPK'];
          $users = DB::delete(DB::raw($Sentence));
      }

  }
  $A = new DeleteArtClass();
  $A->DeleteArt();

?>

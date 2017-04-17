<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class updateInformation extends Controller
{
      /**
       * Show a list of all of the application's users.
       * $_POST['start_date']."   ".$_POST['end_date'];
       * @return Response
       */
      public function updateInformationData()
      {
        $Sentence = "insert into userExperience (userPK, Organization, Position, Explainn)
          values ('".$_SESSION['userPK']."' , '".$_POST['exOrganization']."', '".$_POST['exPosition']."' , '".$_POST['explain']."')";

          $DBRun = DB::insert(DB::raw($Sentence));
      }
}
  $A = new updateInformation();
  $A->updateInformationData();
?>

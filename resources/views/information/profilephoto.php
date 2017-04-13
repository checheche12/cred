<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RunQuery
{

        public function Query()
        {
              echo $_FILES['Image'][0];
        }

}

    $A = new RunQuery();
    $A->Query();

?>

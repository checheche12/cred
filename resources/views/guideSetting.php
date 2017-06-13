<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class guideSettingClass
{
  public function guideSetting()
  {
      DB::update('update userinfo set eventStatus = eventStatus | ? where userPK = ?',[$_GET['number'],$_SESSION['userPK']]);
  }
}

  $A = new guideSettingClass();
  $A->guideSetting();

?>

<?php

class acceptCreditClass
{
  public function acceptCredit()
  {
    //
      DB::update('update workDB set checkCredit = 1 where userPK = ? and artPK = ?',[$_SESSION['userPK'],$_GET['artPK']]);
      DB::update('update notification set notificationKind = "5" where notificationPK = ?',[$_GET['notificationPK']]);
  }
}

$Accept = new acceptCreditClass();
$Accept->acceptCredit();

?>

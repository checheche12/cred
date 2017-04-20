<?php

class deleteCreditClass
{
  public function deleteCredit()
  {
      DB::delete('delete from workDB where userPK = ? and artPK = ?',[$_SESSION['userPK'],$_GET['artPK']]);
      DB::update('update notification set notificationKind = "6" where notificationPK = ?',[$_GET['notificationPK']]);
  }
}

$Accept = new deleteCreditClass();
$Accept->deleteCredit();

?>

<?php

class acceptCreditClass
{
	public function acceptCredit()
	{
    //이하 내용은 크레딧 요청의 종류를 확인하기 위해 확인하는 절차
		$users = DB::select(DB::raw("select senderuserPK, notificationKind from notification where notificationPK = ".$_GET['notificationPK']));
		$GLOBALS['notificationKind']='';
		$GLOBALS['senderuserPK']='';
		foreach($users as $user){
			$GLOBALS['notificationKind'] = $user->notificationKind;
			$GLOBALS['senderuserPK'] = $user->senderuserPK;
		}


		echo "notificationKind:".$GLOBALS['notificationKind']."|| senderuserPK:".$GLOBALS['senderuserPK']."|| artPK:".$_GET['artPK']." ||myUserPK:".$_SESSION['userPK'];

		if($GLOBALS['notificationKind'] == '3'){ //포스트 작성자가 크레딧을 주는 형식
			DB::update('update workDB set checkCredit = 1 where userPK = ? and artPK = ?',[$_SESSION['userPK'],$_GET['artPK']]);
			DB::update('update notification set notificationKind = "5" where notificationPK = ?',[$_GET['notificationPK']]);
		}else{	//자신 또한 크레딧을 주라고 요구하는 경우
			echo "자신 또한 크레딧을 주라고 요구하는 경우";
			DB::update('update workDB set checkCredit = 1 where userPK = ? and artPK = ?',[$GLOBALS['senderuserPK'],$_GET['artPK']]);
			DB::update('update notification set notificationKind = "5" where notificationPK = ?',[$_GET['notificationPK']]);
		}
	}
}

$Accept = new acceptCreditClass();
$Accept->acceptCredit();

?>

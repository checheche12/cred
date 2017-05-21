<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class bugSendClass extends Controller
{
	public function bugSend()
	{
		$GLOBALS['userPK'] = 0;
		$GLOBALS['name'] = "";
		$GLOBALS['issue'] = "";
		$GLOBALS['title'] = "";
		$GLOBALS['description'] = "";
		$GLOBALS['browser'] = "";

		$Sentence = "select Name from userinfo where userPK = ".$_SESSION['userPK'];
		$users = DB::select(DB::raw($Sentence));
		foreach($users as $user){
			// $GLOBALS['name'] = $user->Name;
			$GLOBALS['userPK'] = $_SESSION['userPK'];
		}

		$GLOBALS['issue'] = $_POST['issue'];
		$GLOBALS['title'] = $_POST['title'];
		$GLOBALS['description'] = $_POST['description'];
		$GLOBALS['browser'] = $_POST['browser'];

		DB::insert('insert into bugReport (userPK, userName, issueType, title, description, browserType, uploadTime)
			values (?, ?, ?, ?, ?, ?, ?)',array($GLOBALS['userPK'], $GLOBALS['name'], $GLOBALS['issue'], $GLOBALS['title'], $GLOBALS['description'], $GLOBALS['browser'], date("Y-m-d H:i:s"),));

		echo "<script type='text/javascript'>document.location.href='/';
		alert('제출 성공');
	</script>";

}
}

$A = new bugSendClass();
$A->bugSend();

?>

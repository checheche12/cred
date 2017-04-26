<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Mainpost extends Controller
{
	public function post()
	{

		$sentence = "select * from indexMain order by indexPK desc limit 1";
		$a = DB::select($sentence);
		$GLOBALS['artURL'] = "";
		$GLOBALS['artText'] = "";
		foreach($a as $b){
			$GLOBALS['artURL'] = $b->url;
			$GLOBALS['artText'] = $b->artText;
		}

		//Intro page 에 X 버튼 눌렀나 안 눌렀나 확인하는 장치
		if($_SESSION['is_login'] == true){
			$checkFactor = DB::select(DB::raw("select userPK, eventCheck from userinfo where userPK=".$_SESSION['userPK']));
			$GLOBALS['eventCheck'] = "";
			foreach($checkFactor as $check){
				$GLOBALS['eventCheck'] = $check->eventCheck;
			}
		}
	}
}
$A = new Mainpost();
$A->post();

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
	<link rel="stylesheet" type ="text/css" href="css/intro.css?v=1">
</head>
<body>
	<div id ='header'>
		<?php
		include_once('../resources/views/header.php');
		?>
	</div>
	<div id="ContentWidth">
		<div id="MainContent_Frame">
			<?php
			if(($_SESSION['is_login'] == true and $GLOBALS['eventCheck']==0) or $_SESSION['is_login'] == false){
				echo'<div id="MainContent">
				<img id="MainImage" src="'.$GLOBALS['artURL'].'">';
				if($_SESSION['is_login'] == true){
					echo'<button id="xBt">X</button>';
				}
				echo'<div id="quoteBox">'.$GLOBALS['artText'].'
			</div>
		</div>
		';
	}
	?>
</div>
</div>

<?php
if($_SESSION['is_login'] == true){
	echo'<p class="title">Spotlight</p>
	<div id="RecentWorks_Frame">';

		include_once('../resources/views/administrator/getspotlight.php');

		echo'</div>


		<p class="title">Recent Works</p>
		<div id="RecentWorks_Frame">';


			include_once('../resources/views/administrator/getrecent.php');


			echo '</div>';
		}
		?>

		<div id="jobPosting_Frame">
			<?php
			include_once('../resources/views/jobposting.php');
			?>
		</div>
		<div id ='footer'>
			<?php
			include_once('../resources/views/footer.php');
			?>
		</div>
		<script type = "text/javascript" src = "js/intro.js"></script>
		<script type="text/javascript"></script>
	</body>
	</html>

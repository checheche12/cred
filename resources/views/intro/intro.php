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
			$checkFactor = DB::select(DB::raw("select userPK, eventStatus from userinfo where userPK=".$_SESSION['userPK']));
			$GLOBALS['eventStatus'] = "";
			foreach($checkFactor as $check){
				$GLOBALS['eventStatus'] = $check->eventStatus;
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
			<?php
			if(($_SESSION['is_login'] == true and (($GLOBALS['eventStatus'] & 1)==0)) or $_SESSION['is_login'] == false){
				echo'
				<div id="ContentWidth">
				<div id="MainContent_Frame">
				<div id="MainContent">
				<img id="MainImage" src="mainImage/credberryindexartwork.png">';
				echo'<div id="featureImage1"><img class="featureImage" src="mainImage/credberryindex_feature1.png"></div>';
				echo'<div id="featureImage2"><img class="featureImage" src="mainImage/credberryindex_feature2.png"></div>';
				echo'<div id="featureImage3"><img class="featureImage" src="mainImage/credberryindex_feature3.png"></div>';
				if($_SESSION['is_login'] == true){
					echo'<button id="xBt">X</button>';
				}
				echo'<div id="quoteBox">'.$GLOBALS['artText'].'
			</div>
		</div>
	</div>
</div>
		';
	}
	?>

<?php
if($_SESSION['is_login'] == true){
	// echo'<p class="title">Spotlight</p>

	echo '<div class="Newest_Frame"> ';
	// echo'<p class="title">Newest Project</p>
	// <div id="workFrame">
	// 	<div id="RecentWorks_Frame">';

			include_once('../resources/views/administrator/getspotlight.php');

			// echo'</div>';

			// echo'<div id="RecentWorks_Frame">';


			include_once('../resources/views/administrator/getrecent.php');


			// echo '</div></div>';
			echo "</div>"; /*end Newest_Frame*/
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

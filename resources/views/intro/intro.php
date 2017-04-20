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
			<div id="MainContent">
				<img id="MainImage" src=<?=$GLOBALS['artURL']?>>
				<div id="quoteBox">
					<?php
					echo $GLOBALS['artText'];
					?>
				</div>
			</div>
		</a>
	</div>


	<p class="title">Spotlight</p>
	<div id="RecentWorks_Frame">
		<?php
		include_once('../resources/views/administrator/getspotlight.php');
		?>
	</div>


	<p class="title">Recent Works</p>
	<div id="RecentWorks_Frame">

		<?php
		include_once('../resources/views/administrator/getrecent.php');
		?>

	</div>

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
	<script type="text/javascript">
		$('img').on('error',function(){
			$(this).attr('src', '/mainImage/noimage.png');
		});
	</script>
</body>
</html>

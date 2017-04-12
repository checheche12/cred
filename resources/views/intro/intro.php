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

		<<?php
		include_once('../resources/views/administrator/getrecent.php');
		?>

	</div>

	<script type="text/javascript">
		$('img').on('error',function(){
			$(this).attr('src', '/mainImage/noimage.png');
		});
	</script>
</body>
</html>

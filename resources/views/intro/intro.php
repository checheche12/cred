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
	<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
			$("#header").load("/header");
			// $("#MainImage").attr('src','http://cfile10.uf.tistory.com/image/265C6045564DAED91C5478');
		});
		$('img').on('error',function(){
			$(this).attr('src', 'http://cfile10.uf.tistory.com/image/265C6045564DAED91C5478');
		});

		// document.addEventListener("DOMContentLoaded", function(event) {
		// 	document.querySelectorAll('img').forEach(function(img){
		// 		img.onerror = function(){this.attr("src","https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg")
		// 	};
		// })
		// });
	</script>
</body>
</html>

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
			<div class="RecentWork">
				<a href="">
					<img class="RecentWorkPic" src="https://i.mdel.net/i/mdx/50247-265x224.jpg">
					<p class="workReference">- Huan Lim's participated work</p>
					<div class="credit">
						<div class="position_Frame">
							<p class="position"> Director</p>
							<p class="position">Photographer</p>
							<p class="position">Model</p>
						</div>
						<div class="splitter">
						</div>
						<div class="name_Frame">
							<p class="name">The Boss</p>
							<p class="name">Shooter</p>
							<p class="name">Target</p>
						</div>
					</div>
				</a>
			</div>
			<div class="RecentWork">
				<a href="">
					<img class="RecentWorkPic" src="https://i.mdel.net/i/mdx/50600-265x224.jpg">
					<p class="workReference">- Ive Lee's participated work</p>
					<div class="credit">
						<div class="position_Frame">
							<p class="position"> Director</p>
							<p class="position">Photographer</p>
							<p class="position">Model</p>
						</div>
						<div class="splitter">
						</div>
						<div class="name_Frame">
							<p class="name">The Boss</p>
							<p class="name">Shooter</p>
							<p class="name">Target</p>
						</div>
					</div>
				</a>
			</div>
			<div class="RecentWork">
				<a href="">
					<img class="RecentWorkPic" src="https://i.mdel.net/i/mdx/50375-265x224.jpg">
					<p class="workReference">- HwaLang Kim's participated work</p>
					<div class="credit">
						<div class="position_Frame">
							<p class="position"> Director</p>
							<p class="position">Photographer</p>
							<p class="position">Model</p>
						</div>
						<div class="splitter">
						</div>
						<div class="name_Frame">
							<p class="name">The Boss</p>
							<p class="name">Shooter</p>
							<p class="name">Target</p>
							<p class="name">The Boss</p>
							<p class="name">Shooter</p>
							<p class="name">Target</p>
						</div>
					</div>
				</a>
			</div>
			<div class="RecentWork">
				<a href="">
					<img class="RecentWorkPic" src="https://i.mdel.net/i/mdx/50388-265x224.jpg">
					<p class="workReference">- David Choi's participated work</p>
					<div class="credit">
						<div class="position_Frame">
							<p class="position"> Director</p>
							<p class="position">Photographer</p>
							<p class="position">Model</p>
						</div>
						<div class="splitter">
						</div>
						<div class="name_Frame">
							<p class="name">The Boss</p>
							<p class="name">Shooter</p>
							<p class="name">Target</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
			$("#header").load("/header");
		});
	</script>
</body>
</html>

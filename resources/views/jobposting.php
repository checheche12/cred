<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobPostClass extends Controller
{
	public function JobPost()
	{

		$Sentence = "select * from jobPostDB";
		$list = DB::select(DB::raw($Sentence));


		$GLOBALS['jobInfoArr']=array();
		foreach($list as $item){
			$Sentence2 = "select * from qualSkillDB where jobPostPK=".$item->jobPostPK;
			$list2 = DB::select(DB::raw($Sentence2));
			$GLOBALS['qualSkillArr']=array();
			foreach($list2 as $item2){
				array_push($GLOBALS['qualSkillArr'],$item2->skill);
			}
			//0 jobPostPK, 1 userPK, 2 postPurpose, 3 jobType, 4 workLocation, 5 workField, 6 position, 7 jobDesc, 8 jobPeriod, 9 benefits, 10 earning, 11 companyInfo, 12 experience, 13 education, 14 extraDesc, 15 postDate, 16 updateDate, 17 expiryDate, 18 recruiterName, 19 $GLOBALS['qualSkillArr']
			array_push($GLOBALS['jobInfoArr'],array($item->jobPostPK,$item->userPK,$item->postPurpose,$item->jobType,$item->workLocation,$item->workField,$item->position,$item->jobDesc,$item->jobPeriod,$item->benefits,$item->earning,$item->companyInfo,$item->experience,$item->education,$item->extraDesc,$item->postDate,$item->updateDate,$item->expiryDate,$item->recruiterName,$GLOBALS['qualSkillArr']));
		}

		$temp = DB::select(DB::raw("select jobPostPK FROM qualSkillDB ORDER BY jobPostPK DESC LIMIT 1"));
		$GLOBALS['lastJobPK'] = 0;
		foreach($temp as $v1){
			foreach($v1 as $v2){
				$GLOBALS['lastJobPK'] = $v2;
				break;
			}
			break;
		}


	}
}
$A = new JobPostClass();
$A->JobPost();

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
<link rel="stylesheet" type ="text/css" href="css/jobPosting.css">
<body>
	<p class="title">On the Street</p>
	<div id="ContentWrapper">
		<div id="postHeader">
			<button id="post">글쓰기</button>
		</div>

		<!-- Input Page -->
		<div id="projectInputFrame">
		</div>

		<div id="jobTypeSelector">
			<button id="allOptions" class="postBt">All</button>
			<button id="fullTime" class="postBt">풀타임</button>
			<button id="freeLancer" class="postBt">프리렌서</button>
			<button id="noPay" class="postBt">무급</button>
		</div> <!-- end of jobTypeSelector -->

		<?php
		echo'<ul id="projectList">';
		echo'</ul>'; //end of projectList
		?>




		
	</div> <!-- end of ContentWrapper -->
	<script type="text/javascript">var jobNum = <?= $GLOBALS['lastJobPK'] ?></script>
	<script type = "text/javascript" src = "js/jobposting.js"></script>
</body>
</html>

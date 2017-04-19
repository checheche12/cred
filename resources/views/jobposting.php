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
				array_push($GLOBALS['qualSkillArr'],array($item2->skill));
			}
			//0 jobPostPK, 1 userPK, 2 postPurpose, 3 jobType, 4 workLocation, 5 workField, 6 position, 7 jobDesc, 8 jobPeriod, 9 benefits, 10 earning, 11 companyInfo, 12 experience, 13 education, 14 extraDesc, 15 postDate, 16 updateDate, 17 expiryDate, 18 $GLOBALS['qualSkillArr']
			array_push($GLOBALS['jobInfoArr'],array($item->jobPostPK,$item->userPK,$item->postPurpose,$item->jobType,$item->workLocation,$item->workField,$item->position,$item->jobDesc,$item->jobPeriod,$item->benefits,$item->earning,$item->companyInfo,$item->experience,$item->education,$item->extraDesc,$item->postDate,$item->updateDate,$item->expiryDate,$GLOBALS['qualSkillArr']));
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
	<style type="text/css">
		#ContentWrapper{

		}
		.postHighlight{
			display: inline-block;
			color: #ed2a7b;
			font-size: 20px;
		}
		.singlePost, .openInfo, .furtherInfo, .jobDescription, .qualification, .extraInfo{
			border: 1px solid #ed2a7b;
		}
		ul{
			list-style-type: none;
			padding: 0;
		}
		.jobDescription{
			box-sizing: border-box;
			display: inline-block;
			width: 65%;
		}
		.qualification{
			box-sizing: border-box;
			display: inline-block;
			width: 35%
		}
		.buttonFrame1, .buttonFrame2{
			text-align: center;
		}
		.label{
			font-weight: bolder;
		}
		.singlePost{
			padding: 15px;
		}
		.requiredInfo{
			display: flex;
		}
		#postHeader{
			text-align: right;
		}
		#jobTypeSelector{
			margin-top: 10px;
			margin-bottom: 5px;
		}
		#ContentWrapper{
			max-width: 62.5em;
			margin-left: auto;
			margin-right: auto;
		}
		.openInfo{
			padding: 15px;
		}
		.jobDescription{
			padding: 15px;
		}
		.qualification{
			padding:15px;
		}
		.postTime{
			padding:15px;
		}
		.extraInfo{
			padding:15px;
		}
		.time{
			display: inline-block;
		}
		.inputForm{
			padding: 5px;
			background: grey;
			margin-bottom: 5px;
		}
		.inputLabel{
			width: 15rem;
			display: inline-block;
			padding-right: 1em;
			text-align: right;
		}
		.inputBox{
			width: 43rem;
		}

	</style>
</head>
<link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />

<body>

	<div id="ContentWrapper">
		<div id="postHeader">
			<button id="post" class="postBt">글쓰기</button>
		</div>
		
		<!-- Input Page -->
		<div id="projectInputForm">
			<div class="inputForm">
				<label class="label inputLabel">구인/구직</label><input type="radio" name="postPurpose" value="person" checked>구인<input type="radio" name="postPurpose" value="project">구직<br>
			</div>
			<div id="recruiterInfo" class="inputForm">
				<label class="label inputLabel">채용자</label><textarea id="recruiterName" class="inputBox"></textarea><br>
				<label class="label inputLabel">산업분야근무필드/장르</label><textarea id="workField" class="inputBox"></textarea><br>
				<label class="label inputLabel">회사소개</label><textarea id="companyInfo" class="inputBox"></textarea><br>
			</div>
			<div id="jobInfo" class="inputForm">
				<label class="label inputLabel">모집분야/포지션</label><textarea id="position" class="inputBox"></textarea><br>
				<label class="label inputLabel">담당업무 설명</label><textarea id="jobDesc" class="inputBox"></textarea><br>
				<label class="label inputLabel">기술</label><textarea id="skill" class="inputBox"></textarea><br>
				<label class="label inputLabel">근무지</label><textarea id="workLocation" class="inputBox"></textarea><br>
				<label class="label inputLabel">채용형태</label><input type="radio" name="jobType" value="fullTime" checked>정규직<input type="radio" name="jobType" value="freeLancer">계약직<input type="radio" name="jobType" value="noPay">무급<br>
				<label class="label inputLabel">채용기간</label><textarea id="jobPeriod" class="inputBox"></textarea><br>
				<label class="label inputLabel">급여</label><textarea id="earning" class="inputBox"></textarea><br>
				<label class="label inputLabel">혜택</label><textarea id="benefits" class="inputBox"></textarea><br>
				<label class="label inputLabel">마감일</label><input type="text" id="datepicker" class="inputBox">
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
				<script>
					$( function() {
						$( "#datepicker" ).datepicker();
					} );
				</script>
			</div>
			<div id="qualificationInfo" class="inputForm">
				<label class="label inputLabel">학력</label><input type="radio" name="education" value="none" checked>무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master">석사 이상<br>
				<label class="label inputLabel">경력</label><input id="expNone" type="radio" name="experience" value="none" checked>무관<input id="expPlus" type="radio" name="experience" value=""><input id="experiencePlus" type="text" name="experience">년 이상<br>
			</div>
			<div id="extraDescFrame" class="inputForm">
				<label class="label inputLabel">부가설명</label><textarea id="extraDesc" class="inputBox"></textarea>
				
			</div>
			<div class="buttonFrame1">
				<button id="postSubmit">작성완료</button>
				<button id="cancel1">취소</button>
			</div>
		</div>

		<div id="jobTypeSelector">
			<button id="allOptions" class="postBt">All</button>
			<button id="fullTime" class="postBt">풀타임</button>
			<button id="freeLancer" class="postBt">프리렌서(계약)</button>
			<button id="noPay" class="postBt">무급</button>
		</div> <!-- end of jobTypeSelector -->
		<?php
		foreach ($GLOBALS['jobInfoArr'] as $temp) {
			echo '<p>'.$temp[1].'</p>';
			// foreach ($temp[18] as $key) {
			// 	echo '<p>'.$key.'</p>';
			// }
		}
		?>
		<!-- Output Page -->
		<ul id="projectList">
			<li class="singlePost">
				<div class="openInfo">
					<p class="postNubmer postHighlight">#173</p>&nbsp;
					<p class="hirer postHighlight">Soo Won Song</p>이
					<p class="location postHighlight">강남</p>에서 일할 수 있는
					<p class="title postHighlight">사극 stylist</p>를 구합니다.
				</div>

				<!-- open information -->
				<div class="furtherInfo">
					<div class="postTime">
						<p class="label time">게시일</p><p class="time">2017-04-18</p>
						<p class="label time">마감일</p><p class="time">2017-04-30</p>
					</div>
					<div class="requiredInfo">

						<div class="jobDescription">
							<div class="positionDesc"><p class="label">모집부문</p><p class="detail">	영화사 수작</p></div>
							<div class="hiringPeriod"><p class="label">프로젝트 기간</p><p class="detail">	영화사 수작</p></div>
							<div class="earning"><p class="label">수입</p><p class="detail">	영화사 수작</p></div>
							<div class="benefit"><p class="label">혜택</p><p class="detail">	영화사 수작</p></div>
							<div class="companyInfo"><p class="label">회사 정보</p><p class="detail">	영화사 수작</p></div>
						</div>
						<div class="qualification">
							<div class="skill"><p class="label">전문 기술</p><p class="detail">	영화사 수작</p></div>
							<div class="experience"><p class="label">경력</p><p class="detail">	영화사 수작</p></div>
							<div class="education"><p class="label">학력</p><p class="detail">	영화사 수작</p></div>
						</div>
					</div>
					<div class="extraInfo">
						<div class="extraJobDesc"><p class="label">부가설명</p></div>
					</div>
					<div class="buttonFrame2">
						<button id="applyBt">지원</button>
						<button id="editBt">수정</button>
					</div>
				</div>

			</li> <!-- end of singlePost -->
		</ul> <!-- end of projectList -->
	</div> <!-- end of ContentWrapper -->
<script type = "text/javascript" src = "js/jobposting.js"></script>
</body>
</html>

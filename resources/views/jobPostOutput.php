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

	}
}
$A = new JobPostClass();
$A->JobPost();

$x = 10;				//한번 업데이트 당 몇 글씩 추가로 포스트 되는가
$N = $_GET['N'];		//몇번째 업데이트인지 확인
$i = 0;					//글 COUNT
$min = $x + ($N-1)*$x;
$max = $x + ($N)*$x;
		//0 jobPostPK, 1 userPK, 2 postPurpose, 3 jobType, 4 workLocation, 5 workField, 6 position, 7 jobDesc, 8 jobPeriod, 9 benefits, 10 earning, 11 companyInfo, 12 experience, 13 education, 14 extraDesc, 15 postDate, 16 updateDate, 17 expiryDate, 18 recruiterName, 19 $GLOBALS['qualSkillArr']
		//Output Page
// echo'<ul id="projectList">';
foreach (array_reverse($GLOBALS['jobInfoArr']) as $temp) {
	if( $min <= $i and $max > $i ){	//$i 번쨰 이후부터 만 출력. 끊어서 append 하기 위함
		if($_GET['jobType']===$temp[3] || $_GET['jobType']==='allOptions'){

			echo'<li class="singlePost" id="singlePost'.$temp[0].'">
			<div class="openInfo">
				<p class="postNubmer postHighlight">#'.$temp[0].'</p>&nbsp;
				<p class="hirer postHighlight">'.$temp[18].'</p>&nbsp;:&nbsp;
				<p class="location postHighlight">'.$temp[4].'</p>에서 일할 수 있는
				<p class="title postHighlight">'.$temp[6].'</p>님을 구합니다.
			</div>';
			// <!-- open information -->

			echo'<div id="furtherInfo'.$temp[0].'"" class="furtherInfo">
			<div class="postTime">
				<p class="label time">게시일</p><p class="time">'.$temp[16].'</p>
				<p class="label time">마감일</p><p class="time">'.$temp[17].'</p>
			</div>
			<div class="requiredInfo">

				<div class="jobDescription">
					<div class="positionDesc"><p class="label">모집부문</p><p class="detail">'.$temp[6].'</p></div>
					<div class="hiringPeriod"><p class="label">프로젝트 기간</p><p class="detail">'.$temp[8].'</p></div>
					<div class="earning"><p class="label">수입</p><p class="detail">'.$temp[10].'</p></div>
					<div class="benefit"><p class="label">혜택</p><p class="detail">'.$temp[9].'</p></div>
					<div class="companyInfo"><p class="label">회사 정보</p><p class="detail">'.$temp[11].'</p></div>
				</div>
				<div class="qualification">
					<div class="skill"><p class="label">전문 기술</p><p class="detail">'; 
						foreach ($temp[19] as $v) {
							echo'<p class="skillEach">'.$v.'</p>';
						}
						echo'</p></div>
						<div class="experience"><p class="label">경력</p><p class="detail">'.$temp[12].'</p></div>
						<div class="education"><p class="label">학력</p><p class="detail">'.$temp[13].'</p></div>
					</div>
				</div>
				<div class="extraInfo">
					<div class="extraJobDesc"><p class="label">부가설명</p><p class="detail">'.$temp[14].'</p></div>
				</div>
				<div class="buttonFrame2">';
				if($temp[1]==$_SESSION['userPK']){	//Guest 는 못하게 해야함
						echo'<button id="applyBt'.$temp[0].'">지원</button>';
					}else{
						echo'<button id="editBt'.$temp[0].'">수정</button>';
						echo'<button id="deleteBt'.$temp[0].'">삭제</button>';
					}

					echo'</div>
				</div>
			</li>'; // end of singlePost
		}
	}
	$i+=1;
}
		// echo'</ul>'; //end of projectList
?>
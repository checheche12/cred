<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobPostClass extends Controller
{
	public function JobPost()
	{

		if($_GET['inputFormType']=="update"){

			$Sentence = "select * from jobPostDB where jobPostPK=".$_GET['jobPostPK'];
			$list = DB::select(DB::raw($Sentence));


			$GLOBALS['jobInfoArr']=array();
			foreach($list as $item){
				$Sentence2 = "select * from qualSkillDB where jobPostPK=".$_GET['jobPostPK'];
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
}
$A = new JobPostClass();
$A->JobPost();


if($_GET['inputFormType']=="new"){
	echo'
	<div id="projectInputForm">
		<div class="inputForm">
			<label class="label inputLabel">구인/구직</label><input type="radio" name="postPurpose" value="person" checked>구인<input type="radio" name="postPurpose" value="project">구직<br>
		</div>
		<div id="recruiterInfo" class="inputForm">
			<div class="inputGroup"><label class="label inputLabel">채용자</label><textarea id="recruiterName" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">산업분야근무필드/장르</label><textarea id="workField" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">회사소개</label><textarea id="companyInfo" class="inputBox"></textarea><br></div>
		</div>
		<div id="jobInfo" class="inputForm">
			<div class="inputGroup"><label class="label inputLabel">모집분야/포지션</label><textarea id="position" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">담당업무 설명</label><textarea id="jobDesc" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">기술</label><textarea id="skill" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">근무지</label><textarea id="workLocation" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">채용형태</label><input type="radio" name="jobType" value="fullTime" checked>정규직<input type="radio" name="jobType" value="freeLancer">계약직<input type="radio" name="jobType" value="noPay">무급<br></div>
			<div class="inputGroup"><label class="label inputLabel">채용기간</label><textarea id="jobPeriod" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">급여</label><textarea id="earning" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">혜택</label><textarea id="benefits" class="inputBox"></textarea><br></div>
			<div class="inputGroup"><label class="label inputLabel">마감일</label><input type="text" id="datepicker" class="inputBox" value="'; echo date("Y-m-d H:i",strtotime("+14 day"));echo'"></div>	
		</div>
		<div id="qualificationInfo" class="inputForm">
			<label class="label inputLabel">학력</label><input type="radio" name="education" value="none" checked>무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master">석사 이상<br>
			<label class="label inputLabel">경력</label><input id="expNone" type="radio" name="experience" value="none" checked>무관<input id="expPlus" type="radio" name="experience" value=""><input id="experiencePlus" type="text" name="experience">년 이상<br>
		</div>
		<div id="extraDescFrame" class="inputForm">
			<div class="inputGroup"><label class="label inputLabel">부가설명</label><textarea id="extraDesc" class="inputBox"></textarea></div>

		</div>
		<div class="buttonFrame1">
			<button id="postSubmit">작성완료</button>
			<button id="cancel">취소</button>
		</div>
	</div>
	';
}elseif ($_GET['inputFormType']=="update") {
	echo'
	<div id="projectInputForm">
		<div class="inputForm">
			<label class="label inputLabel">구인/구직</label>';
			if($GLOBALS['jobInfoArr'][0][2]=="person"){

				echo'<input type="radio" name="postPurpose" value="person" checked>구인<input type="radio" name="postPurpose" value="project">구직<br>';
			}else{
				echo'<input type="radio" name="postPurpose" value="person">구인<input type="radio" name="postPurpose" value="project" checked>구직<br>';
			}
			echo'</div>
			<div id="recruiterInfo" class="inputForm">
				<div class="inputGroup"><label class="label inputLabel">채용자</label><textarea id="recruiterName" class="inputBox">'.$GLOBALS['jobInfoArr'][0][18].'</textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">산업분야근무필드/장르</label><textarea id="workField" class="inputBox">'.$GLOBALS['jobInfoArr'][0][5].'</textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">회사소개</label><textarea id="companyInfo" class="inputBox">'.$GLOBALS['jobInfoArr'][0][11].'</textarea><br></div>
			</div>
			<div id="jobInfo" class="inputForm">
				<div class="inputGroup"><label class="label inputLabel">모집분야/포지션</label><textarea id="position" class="inputBox">'.$GLOBALS['jobInfoArr'][0][6].'</textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">담당업무 설명</label><textarea id="jobDesc" class="inputBox">'.$GLOBALS['jobInfoArr'][0][7].'</textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">기술</label><textarea id="skill" class="inputBox"></textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">근무지</label><textarea id="workLocation" class="inputBox">'.$GLOBALS['jobInfoArr'][0][4].'</textarea><br></div>
				<div class="inputGroup"><label class="label inputLabel">채용형태</label>';
					if($GLOBALS['jobInfoArr'][0][3]=="fullTime"){
						echo'<input type="radio" name="jobType" value="fullTime" checked>정규직<input type="radio" name="jobType" value="freeLancer">계약직<input type="radio" name="jobType" value="noPay">무급<br>';
					}elseif($GLOBALS['jobInfoArr'][0][3]=="freeLancer"){
						echo'<input type="radio" name="jobType" value="fullTime">정규직<input type="radio" name="jobType" value="freeLancer" checked>계약직<input type="radio" name="jobType" value="noPay">무급<br>';
					}else{
						echo'<input type="radio" name="jobType" value="fullTime">정규직<input type="radio" name="jobType" value="freeLancer">계약직<input type="radio" name="jobType" value="noPay" checked>무급<br>';
					}
					echo'</div>
					<div class="inputGroup"><label class="label inputLabel">채용기간</label><textarea id="jobPeriod" class="inputBox">'.$GLOBALS['jobInfoArr'][0][8].'</textarea><br></div>
					<div class="inputGroup"><label class="label inputLabel">급여</label><textarea id="earning" class="inputBox">'.$GLOBALS['jobInfoArr'][0][10].'</textarea><br></div>
					<div class="inputGroup"><label class="label inputLabel">혜택</label><textarea id="benefits" class="inputBox">'.$GLOBALS['jobInfoArr'][0][9].'</textarea><br></div>
					<div class="inputGroup"><label class="label inputLabel">마감일</label><input type="text" id="datepicker" class="inputBox" value="'.$GLOBALS['jobInfoArr'][0][17].'"></div>	
				</div>
				<div id="qualificationInfo" class="inputForm">
					<label class="label inputLabel">학력</label>';
					if($GLOBALS['jobInfoArr'][0][13]=="none"){
						echo'<input type="radio" name="education" value="none" checked>무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master">석사 이상<br>';
					}elseif ($GLOBALS['jobInfoArr'][0][13]=="U_attending") {
						echo'<input type="radio" name="education" value="none">무관<input type="radio" name="education" value="U_attending" checked>초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master">석사 이상<br>';
					}elseif ($GLOBALS['jobInfoArr'][0][13]=="U_Graduate") {
						echo'<input type="radio" name="education" value="none">무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate" checked>대졸<input type="radio" name="education" value="U_master">석사 이상<br>';
					}else{
						echo'<input type="radio" name="education" value="none">무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master" checked>석사 이상<br>';
					}
					echo'<label class="label inputLabel">경력</label>';
					if($GLOBALS['jobInfoArr'][0][12]=="none"){
						echo'<input id="expNone" type="radio" name="experience" value="none" checked>무관<input id="expPlus" type="radio" name="experience" value=""><input id="experiencePlus" type="text" name="experience">년 이상<br>';
					}else{
						echo'<input id="expNone" type="radio" name="experience" value="none">무관<input id="expPlus" type="radio" name="experience" value="" checked><input id="experiencePlus" type="text" name="experience" value="'.$GLOBALS['jobInfoArr'][0][12].'">년 이상<br>';
					}
					echo'</div>
					<div id="extraDescFrame" class="inputForm">
						<div class="inputGroup"><label class="label inputLabel">부가설명</label><textarea id="extraDesc" class="inputBox">'.$GLOBALS['jobInfoArr'][0][14].'</textarea></div>

					</div>
					<div class="buttonFrame1">
						<button id="postSubmit">수정완료</button>
						<button id="cancel">취소</button>
					</div>
				</div>
				';
			}
			?>
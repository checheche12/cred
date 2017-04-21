<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
			<div class="inputGroup"><label class="label inputLabel">마감일</label><input type="text" id="datepicker" class="inputBox"></div>	
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
			<div class="inputGroup"><label class="label inputLabel">마감일</label><input type="text" id="datepicker" class="inputBox"></div>	
		</div>
		<div id="qualificationInfo" class="inputForm">
			<label class="label inputLabel">학력</label><input type="radio" name="education" value="none" checked>무관<input type="radio" name="education" value="U_attending">초대졸<input type="radio" name="education" value="U_Graduate">대졸<input type="radio" name="education" value="U_master">석사 이상<br>
			<label class="label inputLabel">경력</label><input id="expNone" type="radio" name="experience" value="none" checked>무관<input id="expPlus" type="radio" name="experience" value=""><input id="experiencePlus" type="text" name="experience">년 이상<br>
		</div>
		<div id="extraDescFrame" class="inputForm">
			<div class="inputGroup"><label class="label inputLabel">부가설명</label><textarea id="extraDesc" class="inputBox"></textarea></div>

		</div>
		<div class="buttonFrame1">
			<button id="postSubmit">수정완료</button>
			<button id="cancel">취소</button>
		</div>
	</div>
	';
}
?>
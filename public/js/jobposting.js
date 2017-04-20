var token;
$.ajax({
	url : './token',
	success : function(data) {
		token = data;
	}
})
var postSubmit = document.getElementById('postSubmit');
var post = document.getElementById('post');
var allOptions = document.getElementById('allOptions');
var fullTime = document.getElementById('fullTime');
var freeLancer = document.getElementById('freeLancer');
var noPay = document.getElementById('noPay');

$(".postBt").click(function(){
	var Data = {"jobType":$(this).attr('id')};
	$.ajax({
		type:'GET',
		url:'/jobPostOutput',
		data : Data,
		success:function(data){
			$("#projectList").html();
			$("#projectList").html(data);
			bindingJobInfo();
		},
		error: function(){
			alert('error 서버 연결 안됨!');
		}
	})
});


//버튼 php 로 생성 해서 취소 눌렀을때 안에 input 값들이 다 지워지게 추후에 수정 할 것.
post.addEventListener("click",function(){
	$( "#projectInputForm" ).toggle();
});

// radio Box controller
$( "#experiencePlus" ).focus(function() {
	console.log("focused experiencePlus");
	$("input:radio[name=experience]:radio[value='']").prop( "checked", true );
});
$(document).ready(function() {
	$('input[type=radio][name=experience]').change(function() {
		if(this.value === "none"){
			console.log("radio button changed");
			$("#experiencePlus").val("");
		}
	});
});

postSubmit.addEventListener("click",function(){
	var Data = {"_token" : token};
	Data['postPurpose'] = $('input:radio[name=postPurpose]:checked').val()
	Data['recruiterName'] = $("#recruiterName").val();
	Data['workField'] = $("#workField").val();
	Data['companyInfo'] = $("#companyInfo").val();
	Data['position'] = $("#position").val();
	Data['jobDesc'] = $("#jobDesc").val();
	Data['skill'] = $("#skill").val();
	Data['workLocation'] = $("#workLocation").val();
	Data['jobType'] = $('input:radio[name=jobType]:checked').val();
	Data['jobPeriod'] = $("#jobPeriod").val();
	Data['earning'] = $("#earning").val();
	Data['benefits'] = $("#benefits").val();
	Data['expiryDate'] = $("#datepicker").val();
	Data['education'] = $('input:radio[name=education]:checked').val();

	var experience = $('input:radio[name=experience]:checked').val();
	if (experience===""){
		experience = $("#experiencePlus").val();
	}
	Data['experience'] = experience;
	Data['extraDesc'] = $("#extraDesc").val();

	//console.log(Data['postPurpose']+"|"+Data['recruiterName']+"|"+experience);

	console.log(typeof Data['expiryDate']);
	$.ajax({
		type:'POST',
		url:'/jobPostUpdate',
		data : Data,
		success:function(data){
			alert("업데이트 성공, 메인화면으로 돌아갑니다!");
			$(location).attr('href','/');
		},
		error: function(){
			alert('error 서버 연결 안됨!');
		}
	})
});

bindingJobInfo();
function bindingJobInfo(){
	for (var i = 1; i <= jobNum; i++) {
		jobInfoOpen(i);
	}
}
function jobInfoOpen(i){
	var bindId = "#singlePost" + i;
	var bindId2 = "#furtherInfo" + i;
	$(bindId).bind("click", function(){
		$( bindId2 ).toggle();
	});
}
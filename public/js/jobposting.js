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
// var cancel = document.getElementById('cancel');



//버튼 php 로 생성 해서 취소 눌렀을때 안에 input 값들이 다 지워지게 추후에 수정 할 것.
post.addEventListener("click",function(){
	// $( "#projectInputForm" ).toggle();
	$("#post").attr('disabled',true);

	var Data = {"inputFormType":"new"};
	$.ajax({
		type:'GET',
		url:'/jobPostInput',
		data : Data,
		success:function(data){
			$("#projectInputFrame").append(data);
			jobPostInputActions("insert");
		},
		error: function(){
			alert('error 서버 연결 안됨!');
		}
	})
});

function jobPostInputActions(controlType){

	// radio Box controller
	$( "#experiencePlus" ).focus(function() {
		$("input:radio[name=experience]:radio[value='']").prop( "checked", true );
	});
	$(document).ready(function() {
		$('input[type=radio][name=experience]').change(function() {
			if(this.value === "none"){
				$("#experiencePlus").val("");
			}
		});
	});

	$("#cancel").on("click",function(){
		event.stopPropagation();
		$("#post").removeAttr('disabled');
		$("#projectInputForm").remove();
	});
	$("#postSubmit").on("click",function(){
		event.stopPropagation();

		var Data = {"controlType":controlType};
		if(($(this).closest('li').attr('id'))!=undefined){
			var jobPostPK = $(this).closest('li').attr('id').substr(10, 300);
			Data['jobPostPK'] = jobPostPK;
		}
		
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

		$.ajax({
			type:'POST',
			url:'/jobPostUpdate',
			data : Data,
			success:function(data){
				alert("업데이트 성공, 메인화면으로 돌아갑니다!");
				$(location).attr('href','/');
				$("#post").removeAttr('disabled');
			},
			error: function(){
				alert('error 서버 연결 안됨!');
			}
		})
	});
	$( function() {
		$( "#datepicker" ).datepicker();
	} );
}
function bindingJobInfo(){
	for (var i = 1; i <= jobNum; i++) {
		jobInfoOpen(i);
	}
}
function jobInfoOpen(i){
	var bindId = "#singlePost" + i;
	var bindId2 = "#furtherInfo" + i;
	$( bindId ).unbind();
	$(bindId).bind("click", function(){
		$( bindId2 ).toggle();
	});
	var bindId3 = "#applyBt" + i;
	$( bindId3 ).unbind();
	$(bindId3).bind("click",function(event){
		event.stopPropagation();

		var Data = {"controlType":"apply"};
		var t = $(this).attr('id').substr(7, 300);
		Data['jobPostPK'] = t;
		$.ajax({
			type:'POST',
			url:'/jobPostUpdate',
			data : Data,
			success:function(data){
				alert(data);	//성공 실패 여부를 출력함
			},
			error: function(){
				alert('error 서버 연결 안됨!');
			}
		})

	});
	var bindId4 = "#editBt" + i;
	$( bindId4 ).unbind();
	$(bindId4).bind("click",function(event){
		event.stopPropagation();

		var Data = {"inputFormType":"update"};
		var t = $(this).attr('id').substr(6, 300);
		Data['jobPostPK'] = t;
		$.ajax({
			type:'GET',
			url:'/jobPostInput',
			data : Data,
			success:function(data){
				var bindId = "#singlePost" + t;
				$(bindId).append(data);
				jobPostInputActions("update");
				// alert("post update success");
				$("#projectInputForm").remove(data);
			},
			error: function(){
				alert('error 서버 연결 안됨!');
			}
		})

	});
	var bindId5 = "#deleteBt" + i;
	$( bindId5 ).unbind();
	$(bindId5).bind("click",function(event){
		event.stopPropagation();

		if(confirm("해당 포스트를 삭제 하시겠습니까?")==true){
			var Data = {"controlType":"delete"};
			var t = $(this).attr('id').substr(8, 300);
			Data['jobPostPK'] = t;
			$.ajax({
				type:'POST',
				url:'/jobPostUpdate',
				data : Data,
				success:function(data){
					alert("해당 포스트 삭제 성공");
					var bindId = "#singlePost" + t;
					$( bindId ).remove();
				},
				error: function(){
					alert('error 서버 연결 안됨!');
				}
			})
		}
	});
}

$(window).scroll( function() {
	if( ( ($(window).scrollTop() + $(window).height() ) >= ( $("#companyFrame").position().top) ) && (postSet.appendSensor==0) ){
		postSet.appendSensor=1;
		postAppend();
	} 
});


var postSetting = function(jobType){
	this.N = 0;						//몇번째 업데이트인지 확인
	this.jobType=jobType;			
	this.appendSensor=0;			//scroll 시 단순간에 연속적인 작동을 방지하기위한 장치
}
var postSet = new postSetting('allOptions');

$(".postBt").click(function(){
	var Type = $(this).attr('id');
	if(postSet.jobType !=Type){
		postSet.N=0;
		postSet.appendSensor=0;
	}
	postSet.jobType=Type;

	postAppend();
});

function postAppend(){
	var Data = {"jobType":postSet.jobType};
	Data['N'] = postSet.N;
	$.ajax({
		type:'GET',
		url:'/jobPostOutput',
		data : Data,
		success:function(data){
			if(postSet.N==0){
				$("#projectList").html('');
			}
			$("#projectList").append(data);
			bindingJobInfo();	//매번 추가되는 append 값들에 대한 binding
			postSet.N++;

			if(data!=""){	//들어오는 데이터가 더이상 없으면 appendSensor 를 0으로 꺼서 스크롤 해도 더이상 불필요 액션을 차단한다.
				postSet.appendSensor=0;
			}
		},
		error: function(){
			alert('error 서버 연결 안됨!');
		}
	})
}

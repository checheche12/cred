var token;
$.ajax({
	url : './token',
	success : function(data) {
		token = data;
	}
})
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
var postSubmit = document.getElementById('postSubmit');

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
	Data['jobType'] = $('input:radio[name=postPurpose]:checked').val();
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
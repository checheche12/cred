$(document).ready( function() {
	$("#header").load("/header");
});

$('body').append("<script src = 'js/makedFunction.js'>");

var token;
$.ajax({
	url : './token',
	success : function(data) {
		token = data;
	}
})


var Edit = document.getElementById('edit');
var addExperience = document.getElementById('addExperience');


addExperience.addEventListener("click",function(){
	$("#careerGroupD").append('<div id="careerD">'
		+'<div id="positionD">'
		+'<div><label class="labels" for="position" id="positionlabel">직함</label>'
		+'<input class="inputs" type = "text" id = "position" value = ""></input>'
		+'</div>'
		+'</div>'
		+'<div id="organizationD">'
		+'<div><label class="labels" for="organization" id="organizationlabel">소속</label>'
		+'<input class="inputs" type = "text" id = "organization" value = ""></input><br>'
		+'</div>'
		+'</div>'
		+'<div id="organizationD">'
		+'<div><label class="labels" for="exWorkLocation" id="locationlabel">위치</label>'
		+'<input class="inputs" type = "text" id = "exWorkLocation" value = ""></input>'
		+'</div>'
		+'</div>'
		+'<div id="descriptionD">'
		+'<div><label class="labels" for="career" id="descriptionlabel">설명</label>'
		+'<input class="inputs" type = "text" id = "career" value = "" id = "career"></input><br>'
		+'</div>'
		+'</div>'
		+'</div>')
	// var Data = {"_token" : token};

	// Data['exPosition'] = $("#postion").val();
	// Data['exOrganization'] = $("#organization").val();
	// Data['explain'] = $("#career").val();

	// var s_year = $("#start_year").val();
	// var s_month =$("#start_month").val();

	// var e_year = $("#end_year").val();
	// var e_month =$("#end_month").val();

	// s_month *= 1;
	// e_month *= 1;

	// if(s_month <10){
	// 	s_month = '0'+s_month;
	// }else{
	// 	s_month += '';
	// }

	// if(e_month <10){
	// 	e_month = '0'+e_month;
	// }else{
	// 	e_month += '';
	// }

	// start_date = s_year+s_month+'01';
	// end_date = e_year+e_month+'01';

	// Data['start_date'] = start_date;
	// Data['end_date'] = end_date;

	// $.ajax({
	// 	type:'POST',
	// 	url:'/informationEdit/informationCareer',
	// 	data : Data,
	// 	success:function(data){
	// 		alert(data);
	// 	},
	// 	error: function(){
	// 		alert('error 서버 연결 안됨!');
	// 	}
	// })

});


Edit.addEventListener("click",function(){

	var Data = {"_token" : token};

	Data['ProfilePhotoURL'] = $("#ProfilePhotoURL").val();
	Data['name'] = $("#name").val();
	Data['career'] = $("#current_position").val();
	Data['education'] = $("#education").val();
	Data['keyword'] = $("#keyword").val();

	Data['current_organization'] = $("#current_organization").val();
	Data['location'] = $("#location").val();
	Data['education2'] = $("#education2").val();

var experienceArr = [];

for(var i = 0; i < $("input#position.inputs").length;i++){
	var tempArr = [];
	tempArr.push($("input#position.inputs").eq(i).val());
	tempArr.push($("input#organization.inputs").eq(i).val());
	tempArr.push($("input#exWorkLocation.inputs").eq(i).val());
	tempArr.push($("input#career.inputs").eq(i).val());
	experienceArr.push(tempArr);
}

	Data['experienceArr'] = experienceArr;
	console.log(experienceArr);
	$.ajax({
		type:'POST',
		url:'/informationEdit/informationUp',
		data : Data,
		success:function(data){
			alert("업데이트 성공, 메인화면으로 돌아갑니다!");
			$(location).attr('href','/main');
		},
		error: function(){
			alert('error 서버 연결 안됨!');
		}
	})

});

$(addExperience).click(function(){

})


$(document).ready(function(){
	$("#ProfilePhotoURL").blur(function(){
		var urlinput = document.getElementById("ProfilePhotoURL").value;
		console.log(urlCheck(urlinput));
		console.log("getImage: "+getImage(urlinput));
		$('#pImage').html(getImage(urlinput));
      // $('#URLBox').val("");
  });
});


/** urlCheck* */
function getImage(urlInput) {

	var width = 1050;
	var height = 484;
	var url = urlInput;
    var id = matchYoutubeUrl(url); //youtube url 인지 체크 하고 youtube id 반환
    if (id != false) {
    	return "<iframe class='PostWork' width='"+width+"' height='"+height+"' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe>";
    } else if (matchVimeoUrl(url) != false) {
      id = matchVimeoUrl(url); //vimeo id 반환
      return "<iframe class='PostWork' src='https://player.vimeo.com/video/"
      + id
      + "?title=0&byline=0&portrait=0&badge=0' width='"+width+"' height='"+height+"' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
  } else {
  	return "<img class='profileImagePreview' src = '" + url + "'>";
  }
}

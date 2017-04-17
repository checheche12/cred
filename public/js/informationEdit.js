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
var education = document.getElementById('education');
var submitprofilePic = document.getElementById('submitprofilePic');

if(addExperience!=undefined){
	addExperience.addEventListener("click",function(){
		$("#careerGroupD").append('<div id="careerD">'
			+'<div id="positionD">'
			+'<div><label class="labelsexp" for="position" id="positionlabel">직함&nbsp;</label>'
			+'<input class="inputsexp" type = "text" id = "position" value = ""></input>'
			+'</div>'
			+'</div>'
			+'<div id="organizationD">'
			+'<div><label class="labelsexp" for="organization" id="organizationlabel">소속&nbsp;</label>'
			+'<input class="inputsexp" type = "text" id = "organization" value = ""></input><br>'
			+'</div>'
			+'</div>'
			+'<div id="organizationD">'
			+'<div><label class="labelsexp" for="exWorkLocation" id="locationlabel">위치&nbsp;</label>'
			+'<input class="inputsexp" type = "text" id = "exWorkLocation" value = ""></input>'
			+'</div>'
			+'</div>'
			+'<div id="descriptionD">'
			+'<div><label class="labelsexp" for="career" id="descriptionlabel">설명&nbsp;</label>'
			+'<input class="inputsexp" type = "text" id = "career" value = "" id = "career"></input><br>'
			+'</div>'
			+'</div>'
			+'</div>')
		var Data = {"_token" : token};

		Data['exPosition'] = $("#position").val();
		Data['exOrganization'] = $("#organization").val();
		Data['explain'] = $("#career").val();


		$.ajax({
			type:'POST',
			url:'/informationEdit/informationCareer',
			data : Data,
			success:function(data){
			},
			error: function(){
				alert('error 서버 연결 안됨!');
			}
		})

	});
}

Edit.addEventListener("click",function(){
	submitprofilePicFunction();
	var Data = {"_token" : token};
	Data['name'] = $("#name").val();
	Data['location'] = $("#location").val();
	Data['keyword'] = $("#keyword").val();
	if(education!=undefined){	//개인 개정 수정 시 사용
		Data['career'] = $("#current_position").val();
		Data['education'] = $("#education").val();

		Data['current_organization'] = $("#current_organization").val();
		Data['education2'] = $("#education2").val();

		var experienceArr = [];

		for(var i = 0; i < $("input#position.inputsexp").length;i++){
			var tempArr = [];
			tempArr.push($("input#position.inputsexp").eq(i).val());
			tempArr.push($("input#organization.inputsexp").eq(i).val());
			tempArr.push($("input#exWorkLocation.inputsexp").eq(i).val());
			tempArr.push($("input#career.inputsexp").eq(i).val());
			experienceArr.push(tempArr);
			console.log(tempArr);
		}

		Data['experienceArr'] = experienceArr;
	}else if(description!=undefined){	//그룹 개정 수정 시 사용
		Data['award'] = $("#award").val();
		Data['description'] = $("#description").val();
	}
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


submitprofilePic.addEventListener("click",function(){
	submitprofilePicFunction();
});


function submitprofilePicFunction(){
	var ImageFile = document.getElementById("ProfilePhotoURL");
	if(ImageFile == null){
		ImageFile = $("#profileImagePreview").attr('src');
	}
	var Ifile = ImageFile.files[0];
	var formData = new FormData();
	formData.append("Image", Ifile);
	var checkNum = 0;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "/profilephoto", false);
	xhr.onreadystatechange = function(){
		if(this.readyState >=3 && this.status == 200){
			if(xhr.responseText == "1"){
				alert('용량 초과 300kb 이하의 파일을 업로드 해주세요');
			}else if (xhr.responseText == "2"){
				alert('jpg,jpeg,png,gif,bmp 5개의 확장자만 허용되어있습니다.');
			}else if(xhr.responseText == "0"){
				alert('HTTP로 전송된 파일이 아닙니다.');
			}else{
				checkNum+=1;
				if(checkNum>=1){
					var date = new Date();
					var url = 'http://credberry.com'+(xhr.responseText.substr(1))+"?"+date.getTime();
					$("#profileImagePreview").attr('src',url);
					$("#profileImage").attr('src',url);
				}
			}
		}
	}
	xhr.send(formData);
	
}
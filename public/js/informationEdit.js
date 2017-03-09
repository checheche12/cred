$(document).ready( function() {
	$("#header").load("/header");
});

var token;
$.ajax({
	url : './token',
	success : function(data) {
		token = data;
	}
})


var Edit = document.getElementById('eeddiitt');

Edit.addEventListener("click",function(){

	var Data = {"_token" : token};

	Data['ProfilePhotoURL'] = $("#ProfilePhotoURL").val();
	Data['name'] = $("#name").val();
	Data['career'] = $("#career").val();
	Data['education'] = $("#education").val();
	Data['keyword'] = $("#keyword").val();

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


$(document).ready(function(){
  $("#ProfilePhotoURL").blur(function(){
    var urlinput = document.getElementById("ProfilePhotoURL").value;
    console.log(urlCheck(urlinput));
    $('#pImage').html(urlCheck(urlinput));
    console.log("execute");
      // $('#URLBox').val("");
    });
});

// urlCheck functions
function imageExists(url, callback) {
	var img = new Image();
	img.onload = function() {
		callback(true);
	};
	img.onerror = function() {
		callback(false);
	};
	img.src = url;
}

function validateImageURL(imageUrl) {
	imageExists(imageUrl, function(exists) {
    if (exists == true) { // Image 가 맞을 시
    // alert("This is ImageUrl");

    } else { // Image 가 아닐 시
    // alert("Invalid URL");

}
});

}
function matchYoutubeUrl(url) {
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var matches = url.match(p);
	if (matches) {
    return matches[1]; // returns Youtube ID
}
return false;
}
function matchVimeoUrl(url) {
  // https://vimeo.com/188244587
  var p = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
  var matches = url.match(p);
  if (matches) {
    return matches[3]; // returns Youtube ID <- 왜 인덱스 3이야 ㅡ.ㅡ 모르겠다
}
return false;
}

/** urlCheck* */
function urlCheck(urlInput) {

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
  	return "<img class='profileImagePreview' src = " + url + ">";
  }
}
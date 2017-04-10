// Header section 추가
$(document).ready( function() {

	$("#header").load("/header");

});

var addCreditButton = document.getElementById('addCredit');
// var closeButton = document.getElementById('close');

var position = document.getElementById('position');

var creditNameArray = document.getElementsByClassName('name');

var token;

$('body').append("<script src = 'js/makedFunction.js'>");

$.ajax({
	url:'./token',
	success:function(data){
		token = data;
	}
})

for (var i = 1;i<creditNameArray.length;i++){
	var numb = creditNameArray[i].id;
	var IDValue = '#'+numb;
	console.log(IDValue);
	$(IDValue).bind('click', function() {

		var t = $(this).attr('id').substr(0,300);

		t *= 1;

		post_to_url("./anotherProfile", t, "get");

	});
}


// closeButton.addEventListener("click",function(){
// 	goBack();
// });

$('#workFrame').html(getImage(SourceURL));



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

	/** urlCheck**/
	function getImage(urlInput) {

		var width = 1050;
		var height = 484;
		var url = urlInput;
//		var url = urlInput.value; //url input 에서 가져오기
		var id = matchYoutubeUrl(url); //youtube url 인지 체크 하고 youtube id 반환
		if (id != false) {
			/** URL 확인하고 생성 공간과 바꾸기**/
			//alert("Youtube Video id: " + id);
//			$("#checkResult").html("Youtube Video id: " + id);
//			$("#testImage")
//					.html(
//							"<div> <iframe width='560' height='315' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe> </div>");
					return "<iframe width='"+width+"' height='"+height+"' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe>";
			} else if (matchVimeoUrl(url) != false) {
						id = matchVimeoUrl(url); //vimeo id 반환
		//			$("#checkResult").html("Vimeo Video id: " + id);
		//			$("#testImage")
		//					.html(
		//							"<div> <iframe src='https://player.vimeo.com/video/"
		//									+ id
		//									+ "?title=0&byline=0&portrait=0&badge=0' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> </div>");
						return "<iframe src='https://player.vimeo.com/video/"
				+ id
				+ "?title=0&byline=0&portrait=0&badge=0' width='"+width+"' height='"+height+"' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
				} else {
							return "<image class='PostWork'src = " + url + ">";
					}
}
function goBack() {
	window.history.back();
}

var fixedButton = document.getElementById('fixed');
var deleteButton = document.getElementById('delete');
if(fixedButton != null){
	fixedButton.addEventListener("click",function(){
			post_to_url('./fixed', ArtPK, 'get');
	});
	var Data3 = {"int" : ArtPK};
	deleteButton.addEventListener("click",function(){
		$.ajax({
			url:'./delete',
			type:'GET',
			data: Data3,
			success:function(data){
				//alert('글 삭제 성공 메인으로 돌아갑니다.');
				alert(data);
				$(location).attr('href','/main');
			},

			error: function(){
				alert('글 삭제 실패');
			}

		})

	});
}
var askBt = document.getElementById('askBt');
if(askBt != null){

	$('#askBt').click(function(){
			if(confirm("이 답변을 등록하시겠습니까?")==true){
					QInputBR = $("#QInput").val().replace(/\n/g, "<br>");
					Data4 = {"artPK" : ArtPK, "Description" : QInputBR};
					$.ajax({
							url:'/uploadReply',
							type:'POST',
							data: Data4,
							success:function(data){
									alert('댓글이 정상적으로 등록되었습니다.\n'+data);
									$(location).attr('href','/post?int='+ArtPK);
							},
							error: function(){

								alert('등록 실패');
							}

					});

			}
	});

}

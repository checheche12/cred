
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

for (var i = 0;i<creditNameArray.length;i++){
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
if(fixedButton != null){
	fixedButton.addEventListener("click",function(){
		post_to_url('./fixed', ArtPK, 'get');
	});
}
var askBt = document.getElementById('askBt');
if(askBt != null){

	$('#askBt').click(function(){
		if(confirm("이 질문을 등록하시겠습니까?")==true){
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


var answerBtclass = document.getElementsByClassName('answerBtclass');
var deleteBtclass = document.getElementsByClassName('deleteBtclass');

if(answerBtclass != null){
	for(var i=0;i<answerBtclass.length;i++){
		var answerBt = answerBtclass[i];
		$(answerBt).click(function(){
			$("#commitBox").remove();
			var str = '<div id = "commitBox"><div id="QInputFrame">';
			str += '<textarea id = "replyinput"></textarea></div>';
			str += '<button id = "replybutton">등록</button>';
			str += '</div>';
			var div = $(this).closest("#Qcard");
			div.append(str);
			id = $(this).attr('id').substr(8,300);

			$("#replybutton").click(function(){
				if(confirm("답글을 등록하시겠습니까?")==true){

					ReplyReply = {'QuestionPK' : id , 'ReplyReply' : $("#replyinput").val(), 'artPK' : ArtPK};
					$.ajax({
						type:'post',
						url : '/uploadReplyReply',
						data : ReplyReply,
						success:function(data){
							alert('답글이 성공적으로 등록되었습니다.'+data);
							$(location).attr('href','/post?int='+ArtPK);
						}

					});
				}
			});
		});

	}
}

if(deleteBtclass != null){
	for(var i=0;i<deleteBtclass.length;i++){
		var deleteBt = deleteBtclass[i];
		$(deleteBt).click(function(){
			if(confirm("댓글을 정말로 삭제하시겠습니까?")==true){

				id = $(this).attr('id').substr(8,300);
				ReplyDelete = {'QuestionPK' : id};
				$.ajax({
					type:'post',
					url:'/deleteReply',
					data : ReplyDelete,
					success:function(){
						alert('댓글이 성공적으로 지워졌습니다.');
						$(location).attr('href','/post?int='+ArtPK);
					}

				});
			}
		});

	}
}

var editUOIBt = document.getElementById('editUOIBt');
var editUOIBtNum = 0;
if(editUOIBt != null){
	$(editUOIBt).click(function(){

		if(editUOIBtNum==0){
			$(editUOIBt).css('background', 'none'); 
			$(editUOIBt).css('width', '4vw'); 
			$(editUOIBt).text('저장');
			editUOIBtNum = 1;
			var str = '';

			$.ajax({
				url : '/wikiloadtext',
				data : {'int' : ArtPK},
				type : 'get',
				success:function(data){
					str += '<textarea id = "wikisubmit">';
					str += data.replace(/<br>/g,'\n');
					str += '</textarea>';
					$("#noUOI").html(str);
				}
			})

		}else{

			$.ajax({
				url : '/wikiupload',
				type : 'post',
				data : {'wiki' : $("#wikisubmit").val().replace(/\n/g, "<br>"), 'artPK' : ArtPK},
				success:function(){
					$.ajax({
						url : '/wikiload',
						data : {'int' : ArtPK},
						type : 'get',
						success:function(data){
							$("#noUOI").html(data);
							$(editUOIBt).text('편집');
							// $(editUOIBt).css('background', 'url(/mainImage/editicon.png) no-repeat'); 
							// $(editUOIBt).css('width', '1.5vmax'); 
							editUOIBtNum = 0;
						}
					})
				}
			})
		}

	});
}

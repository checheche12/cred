// Header section 추가
$(document).ready( function() {
	$("#pfpf").load("/ProfileBasicInfo");
	$("#header").load("/header");
});

var sendBt = document.getElementById('sendBt');
var cancelBt = document.getElementById('cancelBt');

var token;
$.ajax({
	url : './token',
	success : function(data) {
		token = data;
	}
})

sendBt.addEventListener("click", function() {
	var Data = {"_token" : token};
	Data['msgTitle'] = $('#msgTitle_send').val();
	Data['msgDetail'] = $('#msgDetail_send').val();

	$.ajax({
		type:'POST',
		url:'/msgSendDB',
		data : Data,
		success:function(data){
			alert(data);
			window.location.reload();
		},error: function(){
			alert('Upload failed!');
		}})
});



/*========================Main.js========================*/

$('body').append("<script src = 'js/makedFunction.js'>");

var Project = document.getElementById('Project');

var Bridge = document.getElementById('Bridge');




// $('#profileBody').scroll(function() {
//     var pos = $('#profileBody').scrollTop();
//     if (pos == 0) {
//         alert('top of the div');
//     }
// });

// GetContentByDB 함수에서 URL 을 json 형태로 변환하여 전달해준다. 그러므로

// 이 함수에서 json 형태를 다시 URL 배열로 풀어서

// 3행짜리 동영상의 table 을 구성한다.

// 현재 제작 과정. post 페이지로 잘 이동한다.
// bridgeLogDisplay();
function bridgeLogDisplay(){
	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

	$('#profileBody').text('');
	document.getElementById("profileBody").style.columnWidth="232px";
	$.ajax({

		url : './getContentURL',

		success : function(data) {
			var k = JSON.parse(data);	//0 artPK 1 ArtURL 2 title

			for (var i = 0; i < k.length; i++) {
				// url check 후 비디오일 시 썸내일로 전환 후 post
				var url = String(k[i][1]);
				var urlType = urlCheck(url);
				urlCheck_Ssumnail(urlType,url,k,i);

			}// forloop ends

		}

	})

}//bridgeLogDisplay()

Project.addEventListener("click", function() {	//	<-- 중복 클릭이 되서 .one 이라는 jquery 로 바꿨음. 확인 시 지울것. -soo
	// $("#Project").one("click",function(){

	// 토큰값을 가지고 와야한다. 토큰용 php 파일을 하나 만든다.
	bridgeLogDisplay();

	$('#Bridge').removeClass('selected');
	if ($(this).hasClass('selected')) {
	} 
	else
	{
		$('#Project').addClass('selected');
            	// $(this).addClass('selected');
                //Insert event handling logic
            }

        });

Bridge.addEventListener("click", function() {

	var Data = {"_token" : token};
	Data['userPK'] = userPK;
	bridge(Data);
	$('#Project').removeClass('selected');
	if ($(this).hasClass('selected')) {
	} 
	else
	{
		$('#Bridge').addClass('selected');
            	// $(this).addClass('selected');
                //Insert event handling logic
            }
        });
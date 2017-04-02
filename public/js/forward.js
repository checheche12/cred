// Header section 추가
$(document).ready( function() {
	$("#pfpf").load("/ProfileBasicInfo");
	$("#header").load("/header");
});

var sendBt = document.getElementById('sendBt');
var cancelBt = document.getElementById('cancelBt');
var k = 0;
var aaa = "";
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
			// alert(data);
			alert('message sent!')
			window.location.reload();
		},error: function(){
			alert('Upload failed!');
		}})
});

msgDisplay();
function msgDisplay(){



	$.ajax({
		type:'GET',
		url:'/msgRetrieveDB',
		success:function(data){
			// alert(data);
			var msgDuplicate = [];
			msgArr = JSON.parse(data);
			console.log(msgArr.length);
			for (var i = 0; i < msgArr.length; i++) {
				for(var q = 0; q<msgDuplicate.length;q++){
					console.log("msgDuplicate: "+msgDuplicate[q] + "|msgArr"+msgArr[i][0]);
					if (msgDuplicate[q]==msgArr[i][0]) {
						continue;
					}
				}
				msgDuplicate.push(msgArr[i][0]);

				$("#profileBody").append('<div id="cardFrame">'
					+'<div id="creatorInfo">'
					+'<img id="creatorPicUrl'+i+'" class="creatorPicUrl" src="">'
					+'<p class="msginformation" id="creatorName'+i+'">creatorName</p>'
					+'<p class="msginformation" id="creatorPosition'+i+'">creatorPosition</p>'
					+'<p class="msginformation" id="passedTime'+i+'">passedTime</p>'
					+'</div>'
					+'<div id="msgInfo_recieved">'
					+'<div id="msgBorder_recieved">'
					+'<div id="msgContents_recieved">'
					+'<p id="forwardedBy">forwardedBy</p>'
					+'<hr id="infoSplit">'
					+'<p class="msginformation" id="msgTitle_recieved'+i+'">msgTitle</p>'
					+'<hr id="infoSplit">'
					+'<p class="msginformation" id="msgDetail_recieved'+i+'">msgDetail</p>'
					+'<hr id="infoSplit">'
					+'<div id="msgBt_recieved">'
					+'<button id="forwardBt">forward</button>'
					+'</div>'
					+'</div>'
					+'</div>'
					+'</div>'
					+'</div>');
				//0 msgPK, 1 creatorPK, 2 PasserPK, 3 Title, 4 Detail, 5 create_date, 6 expiry_date
				var tempId1 = "#msgTitle_recieved"+i;
				var tempId2 = "#msgDetail_recieved"+i;
				var tempId3 = "#passedTime"+i;
				


				$(tempId1).text(msgArr[i][3]);
				$(tempId2).text(msgArr[i][4]);
				$(tempId3).text(msgArr[i][5]);


				// alert("success");
				// window.location.reload();
				var Data = {"_token" : token};
				Data['userPK'] = msgArr[i][1]; //creatorPK
				$.ajax({
					type:'GET',
					url:'/userinfoDB',
					data : Data,
					success:function(data){
					//0 Email, 1 Name, 2 ProfilePhotoURL, 3 userPK, 4 Career, 5 education, 6 graduateDate, 7 belong, 8 location, 9 isgroup
					uArr = JSON.parse(data);
					aaa=data;
					var tempId4 = "#creatorName"+k;
					var tempId5 = "#creatorPosition"+k;
					var tempId6 = "#creatorPicUrl"+k;
					$(tempId4).text(uArr[1]);
					$(tempId5).text(uArr[4]);
					$(tempId6).attr("src",uArr[2]);
					k++;
					console.log(tempId4);
				},error: function(){
					alert('Upload failed!');
				}})

			}
		},error: function(){
			alert('Retrieve failed!');
		}})

}

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

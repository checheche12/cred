$('body').append("<script src = 'js/makedFunction.js'>");

var Project = document.getElementById('Project');

var Bridge = document.getElementById('Bridge');

var Members = document.getElementById('Members');

var DirectMessage = document.getElementById('DirectMessage');

var Connected = document.getElementById('Connected');

var token;

	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

bridgeLogDisplay();
imagePreload( "/mainImage/GuideImage/guideLeftButton.png", "/mainImage/GuideImage/guideRightButton.png","/mainImage/GuideImage/myProject2.png");

$( window ).on("load",function() {
// var Testing = document.getElementsByTagName("li");
var Testing = $(".profileFrame");
var arrowImage = new Array();
arrowImage[0] = "/mainImage/GuideImage/guideLeftButton.png"
arrowImage[1] = "/mainImage/GuideImage/guideRightButton.png"
imageURLs = new Array();
imageURLs[0] = "/mainImage/GuideImage/myProject2.png"
makeGuide(true,Testing[0],+200,100,imageURLs);
});

function bridgeLogDisplay(){
	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

	var Data2 = {"userPK" : userPK };

	$('#projectLayout').text('');
	$('#bridgeLayout').text('');
	// document.getElementById("projectLayout").style.columnWidth="232px";
	$.ajax({

		url : './getContentAnother',
		data :Data2,

		success : function(data) {
				$('#projectLayout').append(data);
		}

	})


}//bridgeLogDisplay()

Project.addEventListener("click", function() {	//	<-- 중복 클릭이 되서 .one 이라는 jquery 로 바꿨음. 확인 시 지울것. -soo
	// $("#Project").one("click",function(){

	// 토큰값을 가지고 와야한다. 토큰용 php 파일을 하나 만든다.
	bridgeLogDisplay();

	$('#Bridge').removeClass('selected');
	$('#Members').removeClass('selected');
	$('#Connected').removeClass('selected');
	if ($(this).hasClass('selected')) {
	}
	else
	{
		$('#Project').addClass('selected');
	  // $(this).addClass('selected');
	  //Insert event handling logic
  }
  $('#memberAddFrame').css('display','none');


});
// DB에서 값 긁어 오는지 볼려고 만든 함수인데 잘 긁어 와짐. 만족함. 당연히 나중에

// 수정 해야함.


Bridge.addEventListener("click", function() {

	var Data = {"_token" : token};
	Data['userPK'] = userPK;
	bridge(Data);
	$('#Project').removeClass('selected');
	$('#Members').removeClass('selected');
	$('#Connected').removeClass('selected');
	if ($(this).hasClass('selected')) {
	}
	else
	{
		$('#Bridge').addClass('selected');
		// $(this).addClass('selected');
		//Insert event handling logic
	}
	$('#memberAddFrame').css('display','none');
});


if(Members!=undefined){

	var abcde = {"userPK" : userPK};
	Members.addEventListener("click", function(){
		memberFunction(abcde);
		$('#Bridge').removeClass('selected');
		$('#Project').removeClass('selected');
		$('#Connected').removeClass('selected');
		if ($(this).hasClass('selected')) {
		}
		else
		{
			$('#Members').addClass('selected');
										// $(this).addClass('selected');
											//Insert event handling logic
		}
			$('#memberAddFrame').css('display','block');
	})

}

Connected.addEventListener("click",function(){
	var Data = {"_token" : token};
	Data['userPK'] = userPK;
	connected(Data);
	$('#Project').removeClass('selected');
	$('#Members').removeClass('selected');
	$('#Bridge').removeClass('selected');
	if ($(this).hasClass('selected')) {
	}
	else
	{
		$('#Connected').addClass('selected');
    // $(this).addClass('selected');
    //Insert event handling logic
  }
  $('#memberAddFrame').css('display','none');
});

if(DirectMessage != undefined){
	$(DirectMessage).click(function(){
		$(location).attr('href','/dm?userPK='+userPK);
	});
}

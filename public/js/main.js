// Header section 추가

$('body').append("<script src = 'js/makedFunction.js'>");

var Project = document.getElementById('Project');

var Bridge = document.getElementById('Bridge');

var Members = document.getElementById('Members');

var Connected = document.getElementById('Connected');

var token;

var addMemberBt = document.getElementById('addMember');

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
bridgeLogDisplay();
var siba;
// $(window).ready(function(){
	imagePreload( "/mainImage/GuideImage/guideLeftButton.png", "/mainImage/GuideImage/guideRightButton.png","/mainImage/GuideImage/myProject.png");

	$( window ).on("load",function() {
	// var Testing = document.getElementsByTagName("li");
	var Testing = $("li");
	var arrowImage = new Array();
	arrowImage[0] = "/mainImage/GuideImage/guideLeftButton.png"
	arrowImage[1] = "/mainImage/GuideImage/guideRightButton.png"
	imageURLs = new Array();
	imageURLs[0] = "/mainImage/GuideImage/myProject.png"
	if(Guide != 4){
		makeGuide(true,Testing[3],-200,100,imageURLs,4);
	}
});
// })

function bridgeLogDisplay(){
	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

	$('#projectLayout').text('');
	$('#bridgeLayout').text('');
	// document.getElementById("projectLayout").style.columnWidth="232px";
	$.ajax({

		url : './getContentURL',

		success : function(data) {
			$('#projectLayout').append(data);
		}

	})

}//bridgeLogDisplay()

$('#Project').addClass('selected');


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

// var infoDetail = document.getElementsByClassName("infoDetail");

// var education = infoDetail[1];
// var specialty = infoDetail[2];

// education.addEventListener("click", function(){
// 	$("#searchSlot") = education.value;
// })

//memberSearch autocomplete
$( "#memberSearch" ).autocomplete({
	minLength: 1,
	source: function( request, response ) {
		var Data = {"_token" : token};
		Data['email'] = $("#memberSearch").val();
		$.ajax({
			type:'GET',
			dataType: "json",
			url: "/getNameSuggest",
      data: Data, //0 Name,1 Email,2 userPK
      success: function( data ) {
      	response( data );
      	console.log('data response success');
      },error: function(){
      	console.log("AJAX Search error");
      }
  });
	},
	select: function(event, ui) {
		console.log(ui.item[2]);
		$('#hiddenSearchValue').val(ui.item[2]);
	},
      focus: function( event, ui ) {                //value in inputValue
      	$( "#memberSearch" ).val( ui.item[1] );
      	return false;
      }
  })
.on( "autocompleteselect", function( event, ui ) {
	return false;
} )
.autocomplete( "instance" )._renderItem = function( ul, item ) {
	return $( '<li id="suggestList">' )
	.append( '<li class = "suggestList"> name : '+item[0]+' email : '+item[1]+'</li>')
	.appendTo( ul );
};

if(addMemberBt != undefined){
	addMemberBt.addEventListener("click", function(){
		if(confirm("해당 맴버를 그룹에 추가하시겠습니까?")==true){
			var Data = {"MemberUserPK" : $("#hiddenSearchValue").val()};
			Data['updateType'] = "add";
			$.ajax({
				type:'GET',
				url: "/updateGroupMember",
						data: Data, //0 Name,1 Email,2 userPK
						success:function( data ) {
							alert("맴버 추가 성공");
							console.log(data);
							location.reload();
						},
						error:function(request,status,error){
							alert("! 에러");
						}
					})
		}
	});
}

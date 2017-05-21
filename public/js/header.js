var Upload = document.getElementById('upload');
var Logout = document.getElementById('logout');
var Login = document.getElementById('login');
var Home = document.getElementById('credImage');
var profileImage = document.getElementById('profileImage');
var profileName = document.getElementById('profileName');
var yourart = document.getElementById('yourart');
var Msg = document.getElementById('msg');
var searchButton = document.getElementById('searchButton');
var searchSlot = document.getElementById('searchSlot');
var notification = document.getElementById('notification');
var notification_out = document.getElementById('notification_out');
var directMessage = document.getElementById('dm');
var bugReport = document.getElementById('bugReportBt');
// var hiddenSearchValue = document.createElement("hiddenSearchValue");

var recieverNotiAccount = 0;

var token;
$.ajax({
	url:'./token',
	success:function(data){
		token = data;
	}
})

$(document).ready(function() {
	$(function(){
		$('img').on('error',function(){
			$(this).attr('src', '/mainImage/noimage.png');
		});
		$('.headerFrame').css('display','block');
	});


});

$("#notification_out").scroll(function(event){
	var maxHeight = $("#notification_out").prop("scrollHeight");
	var currentScroll = $("#notification_out").scrollTop();
	var elem = $("#notification_out");
	if (elem[0].scrollHeight <= elem.outerHeight() + elem.scrollTop()) {
					recieverNotiAccount += 7;
					Data = {"recieverNotiAccount" : recieverNotiAccount};
					$.ajax({
							type:'GET',
							url : '/notiaddDetail',
							data : Data,
							success:function(data){
								$("#notiBox").append(data);
							}
					});
			}
	})

$(notification).click(function(e){
	if($(notification).attr('class')=="icons_none"){
		$(notification).attr('class',"icons");
		$(notification_out).attr('class',"notification_out");
		$(notification).css('background-image','url(mainImage/notion.png)');
		$('#notiSmallImage').remove();
		e.stopPropagation();
		$.ajax({
				type : 'GET',
				url : '/notiGotoZero',
				success:function(data){

				}
		});

	}else{
		$(notification).attr('class',"icons_none");
		$(notification_out).attr('class',"notification_out_none");
		$(notification).css('background-image','url(mainImage/notioff.png)');
	}
});

$("body").click(function(e){
	if($(notification).attr('class')=="icons"){
		$(notification).attr('class',"icons_none");
		$(notification_out).attr('class',"notification_out_none");
		$(notification).css('background-image','url(mainImage/notioff.png)');
	}
});

$(".yesbutton").click(function(e){
	var div = $(this).closest("div");
	var artPK = $(this).closest("div").attr('id');
	var notiPK = $(this).closest("div").attr('notinoti');
	e.stopPropagation();
	$.ajax({
		type : 'get',
		url : '/acceptcredit',
		data : {'artPK' : artPK, 'notificationPK' : notiPK},
		success:function(data){
				$(div).html('요청을 수락했습니다.');
		}
	});
});

$(".nobutton").click(function(e){
	var div = $(this).closest("div");
	var artPK = $(this).closest("div").attr('id');
	var notiPK = $(this).closest("div").attr('notinoti');
	e.stopPropagation();
	$.ajax({
		type : 'get',
		url : '/denycredit',
		data : {'artPK' : artPK, 'notificationPK' : notiPK},
		success:function(data){
				$(div).html('요청을 거절했습니다.');
		}
	});
})


if(Upload!=undefined){
	Upload.addEventListener("click", function() {

		$(location).attr('href', './upload');

	});
}

if(Login!=undefined){
	Login.addEventListener("click", function() {

		$(location).attr('href', './login');

	});
}


if(Logout!=undefined){
	Logout.addEventListener("click", function() {

		$(location).attr('href', './Logout');

	});
}


if(Home!=undefined){
	Home.addEventListener("click", function() {

		$(location).attr('href', './');

	});
}

if(profileImage!=undefined){
	profileImage.addEventListener("click", function() {

		$(location).attr('href', './main');

	});
}

if(profileName != undefined){
	profileName.addEventListener("click", function() {

		$(location).attr('href', './main');

	});
}

if(yourart != undefined){
	yourart.addEventListener("click", function() {

		$(location).attr('href', './Yourart');

	});
}

if(Msg != undefined){
	Msg.addEventListener("click", function() {

		$(location).attr('href', './forward');

	});
}

if(directMessage != undefined){
	directMessage.addEventListener("click",function(){
			$(location).attr('href','./dm');
	});
}

if(bugReport != undefined){
	bugReport.addEventListener("click",function(){
			$(location).attr('href','./bugReport');
	});
}
/*
nameLengthCheck();
function nameLengthCheck(){
var pName = $('#profileName').html();
if(pName.length>9){
	var temp = pName.substring(0,9);
	$('#profileName').text(temp+" ...");
}
}
*/
// $("#hiddenSearchValue").val("");
searchButton.addEventListener("click", function() {
	if($( "#searchSlot" ).val().length>0){
		$('#searchSlot').autocomplete( "search");
	}
});
document.getElementById("searchbar").onkeypress = function(e) {
	console.log("searchbar clicked");
	var key = e.charCode || e.keyCode || 0;
	if (key == 13) {
		e.preventDefault();
		if($( "#searchSlot" ).val().length>0){
			$('#searchSlot').autocomplete( "search");
		}
	} else {
		return true;
	}
}

$( "#searchSlot" ).autocomplete({
	minLength: 1,
	source: function( request, response ) {
		var Data = {"_token" : token};
		Data['inputValue'] = $('#searchSlot').val();
		$.ajax({
			type:'GET',
			dataType: "json",
			url: "searchProcess",
			data: Data,	//0 Email,1 Name,2 ProfilePhotoURL,3 userPK,4 Career(position),5 education,6 belong(organization),7 location
			success: function( data ) {
				response( data );
				console.log('data response success');
			},error: function(){
				console.log("AJAX Search error");
			}
		});
		console.log('in Autocomplete function');

	},
      focus: function( event, ui ) {                //value in inputValue
      	$( "#searchSlot" ).val( ui.item[1] );
      	// $("#hiddenSearchValue").val(ui.item[3]);
      	return false;
      }
  })
.on( "autocompleteselect", function( event, ui ) {
	post_to_url("/anotherProfile", ui.item[3], "get");
	return false;
} )
.autocomplete( "instance" )._renderItem = function( ul, item ) {

	var k_str = '<div id="resultList" class="resultList"><img id="resultImage" src="'+item[2]+'" style="height: 50px;">'
	+'<div id="searchInfoContainer" style="display: inline-block;">'
	if(item[1]!=''){
		k_str += '<div id="name" class="searchInfo">'+item[1]+'</div>'
	}
	if(item[6]!=''){
		k_str += '<div id="curOrganization" class="searchInfo" style="display: inline-block;">'+item[6]+'</div><br>';
	}
	if(item[4]!=''){
		k_str += '<div id="curPosition" class="searchInfo" style="display: inline-block;">'+item[4]+'</div>';
	}
	if(item[7]!= ''){
		k_str += '<div id="location" class="searchInfo">'+item[7]+'</div>';
	}
	k_str += '</div></div>';

	return $( "<li>" )
	.append(k_str)
	.appendTo( ul );
	$('.ui-autocomplete-input').css('width','15vw')
};

// $('#searchSlot').autocomplete( "search");

function post_to_url(path, int, method) {

	method = method || "post"; // 전송 방식 기본값을 POST로

	var form = document.createElement("form");

	form.setAttribute("method", method);

	form.setAttribute("action", path);

	// 히든으로 값을 주입시킨다.

	if(method == "post"){
		var hiddenField = document.createElement("input");

		hiddenField.setAttribute("id", "IDID");

		hiddenField.setAttribute("type", "hidden");

		hiddenField.setAttribute('name', '_token');

		hiddenField.setAttribute('value', token);

		form.appendChild(hiddenField);
	}

	var hiddenField2 = document.createElement("input");

	hiddenField2.setAttribute("id", "intint");

	hiddenField2.setAttribute("type", "hidden");

	hiddenField2.setAttribute('name', "int");

	hiddenField2.setAttribute('value', int);

	form.appendChild(hiddenField2);

	document.body.appendChild(form);

	form.submit();

}

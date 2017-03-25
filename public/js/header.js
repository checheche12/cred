var Upload = document.getElementById('upload');
var Logout = document.getElementById('logout');
var Home = document.getElementById('credImage');
var profileImage = document.getElementById('profileImage');
var profileName = document.getElementById('profileName');
var yourart = document.getElementById('yourart');
var searchButton = document.getElementById('searchButton');
var searchSlot = document.getElementById('searchSlot');

var token;
$.ajax({
	url:'./token',
	success:function(data){
		token = data;
	}
})
Upload.addEventListener("click", function() {

	$(location).attr('href', './upload');

});

Logout.addEventListener("click", function() {

	$(location).attr('href', './Logout');

});

Home.addEventListener("click", function() {

	$(location).attr('href', './main');

});

profileImage.addEventListener("click", function() {

	$(location).attr('href', './main');

});
profileName.addEventListener("click", function() {

	$(location).attr('href', './main');

});
yourart.addEventListener("click", function() {

	$(location).attr('href', './Yourart');

});

searchSlot.addEventListener("keyup",function(){
	console.log("In Search...");
	$('#searchDropdown_content').html('');
	if($('#searchSlot').val().length>=1){
		document.getElementById("searchDropdown_content").style.display="inline-block";
		/*검색창에 들어오면 검색 결과를 띄워준다*/
		var Data = {"_token" : token};
		Data['inputValue'] = $('#searchSlot').val();
		$.ajax({
			type:'GET',
			url:'searchProcess',
		data:Data,	//0 Email,1 Name,2 ProfilePhotoURL,3 userPK,4 Career(position),5 education,6 belong(organization),7 location
		success:function(data){
			var obj = JSON.parse(data);
			console.log(String(data));
			console.log(String(obj));
			var count = 0;
			var Email ='';
			var Name ='';
			var ProfilePhotoURL ='';
			var userPK ='';
			var position ='';
			var education ='';
			var organization ='';
			var location ='';
			for(var i=0;i<obj.length;i++){
				console.log("Email: "+obj[i][0]+"Name: "+obj[i][1]+"ProfilePhotoURL: "+obj[i][2]+"userPK: "+obj[i][3]+"position: "+obj[i][4]+"education: "+obj[i][5]+"belong: "+obj[i][6]+"location: "+obj[i][7]);
				count+=1;
				console.log('count' + i);

				if(count>5){break;}
				Email=obj[i][0];
				Name=obj[i][1];
				ProfilePhotoURL=obj[i][2];
				userPK=obj[i][3];
				position=obj[i][4];
				education=obj[i][5];
				organization=obj[i][6];
				location=obj[i][7];
				$('#searchDropdown_content').append('<div id="resultList" class="resultList"><img id="resultImage" src="'+ProfilePhotoURL+'" style="height: 50px;">'
					+'<div id="searchInfoContainer" style="display: inline-block;">'
					+'<div id="name" class="searchInfo">'+Name+'</div>'
					+'<div id="curOrganization" class="searchInfo" style="display: inline-block;">'+organization+'</div>'
					+'<div id="curPosition" class="searchInfo" style="display: inline-block;">'+position+'</div>'
					+'<div id="location" class="searchInfo">'+location+'</div>'
					+'<div id="specialty" class="searchInfo">specialty</div>'
					+'</div></div><br>');

			}
		},
		error: function(){
			alert('search error');
		}
	})
	}else{
		document.getElementById("searchDropdown_content").style.display="none";
	}
});
$('body').append("<script src = 'js/makedFunction.js'>");

var token;

	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

$(document).ready( function() {

	var Data = {"_token" : token };
	Data['userPK'] = userPK;

	$("#header").load("/header");

	$.ajax({
			type:'GET',
			url:'/ProfileAnotherBasicInfo',
			data : Data,
			success:function(data){

				$('#pfpf').text('');
				var q = data;
				$('#pfpf').html(q);
			},
			error: function(){
				alert('error');
			}
	});
});

bridgeLogDisplay();
function bridgeLogDisplay(){
	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

	$('#profileBody').text('');
	document.getElementById("profileBody").style.columnWidth="232px";

	var Data2 = {"userPK" : userPK };
	$.ajax({
		type : 'GET',
		url : './getContentAnother',
		data :Data2,

		success : function(data) {
			var k = JSON.parse(data);
			for (var i = 0; i < k.length; i++) {

				// url check 후 비디오일 시 썸내일로 전환 후 post
				var url = String(k[i][1]);
				var urlType = urlCheck(url);
				urlCheck_Ssumnail(urlType,url,k,i);

			}// forloop ends

		}

	})

}//bridgeLogDisplay()

Project.addEventListener("click", function() {

	console.log("SUCCESS POINT01");

	// 토큰값을 가지고 와야한다. 토큰용 php 파일을 하나 만든다.
	bridgeLogDisplay();

});

// DB에서 값 긁어 오는지 볼려고 만든 함수인데 잘 긁어 와짐. 만족함. 당연히 나중에

// 수정 해야함.


Bridge.addEventListener("click", function() {

	    var Data = {"_token" : token};
			Data['userPK'] = userPK;
			bridge(Data);
});

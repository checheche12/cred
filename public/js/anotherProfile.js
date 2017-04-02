$('body').append("<script src = 'js/makedFunction.js'>");
var Members = document.getElementById('Members');

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
				$('#profileBody').append(data);
		}

	})

}//bridgeLogDisplay()

$("#Project").click(function(){
	// 토큰값을 가지고 와야한다. 토큰용 php 파일을 하나 만든다.
	bridgeLogDisplay();
	$('#Bridge').removeClass('selected');
	$('#Members').removeClass('selected');
	if ($(this).hasClass('selected')) {
	}
	else
	{
	$('#Project').addClass('selected');
						// $(this).addClass('selected');
							//Insert event handling logic
}
});
// DB에서 값 긁어 오는지 볼려고 만든 함수인데 잘 긁어 와짐. 만족함. 당연히 나중에

// 수정 해야함.


Bridge.addEventListener("click", function() {

	    var Data = {"_token" : token};
			Data['userPK'] = userPK;
			bridge(Data);
			$('#Project').removeClass('selected');
			$('#Members').removeClass('selected');
			if ($(this).hasClass('selected')) {
			}
			else
			{
				$('#Bridge').addClass('selected');
		            	// $(this).addClass('selected');
		                //Insert event handling logic
		  }
});


if(Members!=undefined){

		var abcde = {"userPK" : userPK};
		Members.addEventListener("click", function(){
				memberFunction(abcde);
				$('#Bridge').removeClass('selected');
				$('#Project').removeClass('selected');
				if ($(this).hasClass('selected')) {
				}
				else
				{
					$('#Members').addClass('selected');
			            	// $(this).addClass('selected');
			                //Insert event handling logic
			  }
		})

}

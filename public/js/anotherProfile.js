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
				if (urlType == "youtube") {
					var yvID = matchYoutubeUrl(url);
					imgSrc = 'https://img.youtube.com/vi/' + yvID
					+ '/mqdefault.jpg';
					j = '<div class = "ProjectFrame"><img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + imgSrc
					+ '><p class="credit">credit</p><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

					$('#profileBody').append(j);

				} else if (urlType == "vimeo") {
					var vvID = matchVimeoUrl(url);
					$.getJSON('http://www.vimeo.com/api/v2/video/' + vvID
						+ '.json?callback=?', {
							format : "json"
						}, function(data) {
							j = '<div class = "ProjectFrame"><img class "VideoArt" id = Image' + k[i][0] + ' src = ' + data[0].thumbnail_large
					+ '><p class="credit">credit</p><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

							$('#profileBody').append(j);
});
				} else {
					j = '<div class = "ProjectFrame"><img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + url
					+ '><p class="credit">credit</p><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

					$('#profileBody').append(j);// skip
				}
				var IDValue = '#Image' + k[i][0];
				$(IDValue).bind('click', function() {

					var t = $(this).attr('id').substr(5, 300);

					t *= 1;

					post_to_url("./post", t,"get");

				});

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

	    $.ajax({
	        type:'POST',
	        url:'/bridgeLoader',
	        data : Data,
	        success:function(data){

						$('#profileBody').text('');

						var obj = JSON.parse(data); // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK

							for(var i =0;i<obj.length;i++){

									var q = '<table class="bridgeCard" id = '+obj[i][5]+'>'
									+'<tr> '
									+'<td class="personalImageFrame">'
									+'<img class="personalImage"src="'+obj[i][2]+'"> '
									+'</td> '+'<td class="personalInfo"> '
									+'<p class="name">'+obj[i][1]+'</p>'
									+' <p class="organization">'+obj[i][3]+'</p>'
									+'<p class="position">'+obj[i][4]+'</p> '
									+'</td> '
									+'<td class="workImageFrame">'
									+'<img class="workImage"src="mainImage/mainBackground.png"> '
									+'</td>'
									+'</tr>'
									+'</table>';

									$('#profileBody').append(q);
									document.getElementById("profileBody").style.columnWidth="344px";

									var IDValue2 = '#' + obj[i][5];
									$(IDValue2).bind('click', function() {

										var t = $(this).attr('id').substr(0, 300);
										t *= 1;

										post_to_url("/anotherProfile", t,"get");

									});
							}
	        },
	        error: function(){
	          alert('error');
	        }
	    })

	// $(location).attr('href','/bridge');



});


// urlCheck functions
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

function validateImageURL(imageUrl) {
	imageExists(imageUrl, function(exists) {
		if (exists == true) { // Image 가 맞을 시
		// alert("This is ImageUrl");

		} else { // Image 가 아닐 시
		// alert("Invalid URL");

	}
});

}
function matchYoutubeUrl(url) {
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var matches = url.match(p);
	if (matches) {
		return matches[1]; // returns Youtube ID
	}
	return false;
}
function matchVimeoUrl(url) {
	// https://vimeo.com/188244587
	var p = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
	var matches = url.match(p);
	if (matches) {
		return matches[3]; // returns Youtube ID <- 왜 인덱스 3이야 ㅡ.ㅡ 모르겠다
	}
	return false;
}

/** urlCheck* */
function urlCheck(urlInput) {
	var url = String(urlInput); // url 가져오기
	var id = matchYoutubeUrl(url); // youtube url 인지 체크 하고 youtube id 반환
	if (id != false) {
//		alert("Youtube Video id: " + id);
return "youtube";
} else if (matchVimeoUrl(url) != false) {
		id = matchVimeoUrl(url); // vimeo id 반환
//		alert("Vimeo Video id: " + id);
return "vimeo";
} else {
	validateImageURL(url);
}
}

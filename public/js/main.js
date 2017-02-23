// Header section 추가
$(document).ready( function() {

	$("#pfpf").load("/ProfileBasicInfo");
	$("#header").load("/header");

});

var Project = document.getElementById('Project');

var Bridge = document.getElementById('Bridge');

var token;

// js 에서 php 로 값을 넘겨서 php 페이지를 띄우기 위한 함수.

// js만으로 post 값 전달 방식을 사용 할 수 있지만 모든 태그를 a 태그화 해야함.

// 첫번째 인수는 이동할 url 두번째는 전달할 값 세번째는 전송 방식.(기본이 post)

function post_to_url(path, int, method) {

	method = method || "post"; // 전송 방식 기본값을 POST로

	var form = document.createElement("form");

	form.setAttribute("method", method);

	form.setAttribute("action", path);

	// 히든으로 값을 주입시킨다.

	var hiddenField = document.createElement("input");

	hiddenField.setAttribute("id", "IDID");

	hiddenField.setAttribute("type", "hidden");

	hiddenField.setAttribute('name', '_token');

	hiddenField.setAttribute('value', token);

	var hiddenField2 = document.createElement("input");

	hiddenField2.setAttribute("id", "intint");

	hiddenField2.setAttribute("type", "hidden");

	hiddenField2.setAttribute('name', "int");

	hiddenField2.setAttribute('value', int);

	form.appendChild(hiddenField);

	form.appendChild(hiddenField2);

	document.body.appendChild(form);

	form.submit();

}

// GetContentByDB 함수에서 URL 을 json 형태로 변환하여 전달해준다. 그러므로

// 이 함수에서 json 형태를 다시 URL 배열로 풀어서

// 3행짜리 동영상의 table 을 구성한다.

// 현재 제작 과정. post 페이지로 잘 이동한다.
bridgeLogDisplay();

function bridgeLogDisplay(){
	$.ajax({

		url : './token',

		success : function(data) {

			token = data;

		}

	})

	$('#profileBody').text('');

	$.ajax({

		url : './getContentURL',

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
					j = '<img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + imgSrc
					+ '>';

					$('#profileBody').append(j);

				} else if (urlType == "vimeo") {
					var vvID = matchVimeoUrl(url);
					$.getJSON('http://www.vimeo.com/api/v2/video/' + vvID
						+ '.json?callback=?', {
							format : "json"
						}, function(data) {
							j = '<img class "VideoArt" id = Image' + k[i][0] + ' src = ' + data[0].thumbnail_large
							+ '>';

							$('#profileBody').append(j);
});
				} else {
					j = '<img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + url
					+ '>';

					$('#profileBody').append(j);// skip
				}
				var IDValue = '#Image' + k[i][0];
				$(IDValue).bind('click', function() {

					var t = $(this).attr('id').substr(5, 1000);

					t *= 1;

					post_to_url("./post", t);

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

	// $(location).attr('href','/bridge');
	$('#profileBody').text('');

	var q = '<table class="bridgeCard"> '
	+'<tr> '
	+'<td class="personalImageFrame">'
	+'<img class="personalImage"src="mainImage/mina3.jpg"> '
	+'</td> '+'<td class="personalInfo"> '
	+'<p class="name">Lil Yachty</p>'
	+' <p class="organization">Dope Music</p>'
	+'<p class="position">High</p> '
	+'<p class="location">NY,NY</p>'
	+'</td> '
	+'<td class="workImageFrame">'
	+'<img class="workImage"src="mainImage/mainBackground.png"> '
	+'</td>'
	+'</tr>'
	+'</table>';

	$('#profileBody').append(q);

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

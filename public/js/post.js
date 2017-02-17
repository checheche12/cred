var addCreditButton = document.getElementById('addCredit');

addCreditButton.addEventListener("click",function(){
  alert("추가");
});


$('#first').html(urlCheck(SourceURL));

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
		console.log("checking imageChecker: "+imageUrl);
		imageExists(imageUrl, function(exists) {
			if (exists == true) { //Image 가 맞을 시
				//alert("This is ImageUrl");
//				$("#checkResult").html("This is ImageUrl");
//				$("#testImage").html("<div> <img src='"+imageUrl+"'> </div>");

			} else { //Image 가 아닐 시
				// alert("Invalid URL");
//				$("#checkResult").html("Invalid URL");
//				$("#testImage").html("");
			}
		});

	}

	/** validating youtubeUrl (초창기에는 Youtube upload 만 지원한다는 가정을 하고 진행 한다)**/
	/** youtube url 인지 체크 **/
	function matchYoutubeUrl(url) {
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		var matches = url.match(p);
		if (matches) {
			return matches[1]; //returns Youtube ID
		}
		return false;
	}
	function matchVimeoUrl(url) {
		//https://vimeo.com/188244587
		var p = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
		var matches = url.match(p);
		if (matches) {
			return matches[3]; //returns Youtube ID  <- 왜 인덱스 3이야 ㅡ.ㅡ 모르겠다
		}
		return false;
	}

	/** urlCheck**/
	function urlCheck(urlInput) {

		var url = urlInput;
//		var url = urlInput.value; //url input 에서 가져오기
		var id = matchYoutubeUrl(url); //youtube url 인지 체크 하고 youtube id 반환
		if (id != false) {
			/** URL 확인하고 생성 공간과 바꾸기**/
			//alert("Youtube Video id: " + id);
//			$("#checkResult").html("Youtube Video id: " + id);
//			$("#testImage")
//					.html(
//							"<div> <iframe width='560' height='315' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe> </div>");
			return "<iframe width='560' height='315' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe>";
		} else if (matchVimeoUrl(url) != false) {
			id = matchVimeoUrl(url); //vimeo id 반환
//			$("#checkResult").html("Vimeo Video id: " + id);
//			$("#testImage")
//					.html(
//							"<div> <iframe src='https://player.vimeo.com/video/"
//									+ id
//									+ "?title=0&byline=0&portrait=0&badge=0' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> </div>");
			return "<iframe src='https://player.vimeo.com/video/"
      									+ id
      									+ "?title=0&byline=0&portrait=0&badge=0' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		} else {
			return "<image src = " + url + ">";
		}
	}

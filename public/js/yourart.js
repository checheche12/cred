// Header section 추가
$(document).ready( function() {

	$("#pfpf").load("/ProfileBasicInfo");
	$("#header").load("/header");

});


for(var i = 0 ; i < NotTagArt.length ; i++){
  var j = "<div class = 'TagCard' id = 'TagCard"+i+"'>";
  var url = NotTagArt[i][3]
  var urlType = urlCheck(url);
  var imgSrc = '';

  if (urlType == "youtube") {
    var yvID = matchYoutubeUrl(url);
    imgSrc = 'https://img.youtube.com/vi/' + yvID + '/mqdefault.jpg';

  }else{
    imgSrc = url;
  }
  j += "<img class = 'videoArt' src = "+imgSrc+"><div/>";
  j += "<div class = 'position'>"+ NotTagArt[i][4]+"</div>";
  j += "<div class = 'name'>"+ NotTagArt[i][1]+"</div>";
  j += "<button id = button"+i+">확인</button>";
  j += "</div>"
  $('#totalsuggest').append(j);

  var IDValue = '#button' + i;
  $(IDValue).bind('click', function() {
		var a = $(this);
    var t = $(this).attr('id').substr(6, 300);
    t *= 1;
    var Data = [];
    Data = {"art" : [NotTagArt[t][0],NotTagArt[t][1],NotTagArt[t][2],NotTagArt[t][4]] };

    $.ajax({
  		url : '/moveart',
      data : Data,
  		success : function(data) {
          alert("성공적으로 추가되었습니다.");
					$(a).closest('div').remove();
  		}
  	})
  });

}

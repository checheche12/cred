function urlCheck_Ssumnail(urlType,url,k,i){

  var IDValue = '#Image' + k[i][0];
  if (urlType == "youtube") {
   var yvID = matchYoutubeUrl(url);
   imgSrc = 'https://img.youtube.com/vi/' + yvID
   + '/mqdefault.jpg';
   j = '<div class = "ProjectFrame"><img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + imgSrc
   + '><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

   $('#profileBody').append(j);
   $(IDValue).bind('click', function() {

    var t = $(this).attr('id').substr(5, 300);

    t *= 1;

    post_to_url("./post", t,"get");

  });
 } else if (urlType == "vimeo") {
   var vvID = matchVimeoUrl(url);
   $.getJSON('http://www.vimeo.com/api/v2/video/' + vvID
    + '.json?callback=?', {
     format : "json"
   }, function(data) {
     j = '<div class = "ProjectFrame"><img class ="VideoArt" id = Image' + k[i][0] + ' src = ' + data[0].thumbnail_large
     + '><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

     $('#profileBody').append(j);
     $(IDValue).bind('click', function() {

      var t = $(this).attr('id').substr(5, 300);

      t *= 1;

      post_to_url("./post", t,"get");

    });
   });
 } else {
   j = '<div class = "ProjectFrame"><img class = "VideoArt" id = Image' + k[i][0] + ' src = ' + url
   + '><div class="detail"><p class="name">'+k[i][2]+'</p><p class="position">'+k[i][3]+'</p></div></div>';

  					$('#profileBody').append(j);// skip
            $(IDValue).bind('click', function() {

              var t = $(this).attr('id').substr(5, 300);

              t *= 1;

              post_to_url("./post", t,"get");

            });
          }

        }


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


function bridge(Data){
 $.ajax({
   type:'POST',
   url:'/bridgeLoader',
   data : Data,
   success:function(data){

    $('#projectLayout').text('');
    $('#bridgeLayout').text('');
   // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK 6 isgroup
   $('#bridgeLayout').append(data);
 },
 error: function(){
   alert('error');
 }
})

  	// $(location).attr('href','/bridge');
  }


  function memberFunction(Data){
    $.ajax({
      type:'get',
      url:'/memberLoader',
      data : Data,
      success:function(data){

        $('#projectLayout').text('');
        $('#bridgeLayout').text('');

        if(data){

          $('#bridgeLayout').append(data);

          var cardArr = document.getElementsByClassName('bridgeCard');
          for(var i=0;i<cardArr.length;i++){
            var bt = cardArr[i].id;

            var IDValue2 = '#' + bt;
            $(IDValue2).bind('click', function() {

             var t = $(this).attr('id').substr(0, 300);
             t *= 1;

             post_to_url("/anotherProfile", t,"get");

           });

            var DeleteIDValue = '#delete' + bt;
            $(DeleteIDValue).bind('click', function(event) {
              event.stopPropagation();
              if(confirm("이 맴버를 삭제하시겠습니까?")==true){

                var t = $(this).attr('id').substr(6, 300);
                t *= 1;

                var Data = {"_token" : token};
                Data['MemberUserPK'] = t;
                Data['updateType']="delete";
                $.ajax({
                  type:'GET',
                  url: "/updateGroupMember",
                            data: Data, //0 Name,1 Email,2 userPK
                            success:function( data ) {
                             alert("맴버 삭제 성공");
                             location.reload();
                           },
                           error:function(request,status,error){
                            alert("! 에러");
                            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                          }

                        });

              }
                      }); //end of Binding
          }
                    }},  //end of success
                    error: function(){
                      alert('error');
                    }
                  })
   	// $(location).attr('href','/bridge');
   }



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

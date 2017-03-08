// Header section 추가
$(document).ready( function() {

  $("#header").load("/header");

});

var TitleBox = document.getElementById('titleBox');
var URLBox = document.getElementById('URLBox');
var Description = document.getElementById('context');

var addCredit = document.getElementById('submitCredit');
var Email = document.getElementById('email');
var position = document.getElementById('position');

var CreditBox = document.getElementById('creditBox');
var submitButton = document.getElementById('saveButton');
var cancelButton = document.getElementById('cancelButton');

var token;

var creditArray = [];

$(document).ready(function(){
  $("#URLBox").blur(function(){
    var urlinput = document.getElementById("URLBox").value;
    console.log(urlCheck(urlinput));
    $('#video').html(urlCheck(urlinput));
      // $('#URLBox').val("");
    });
});

$.ajax({
  url:'./token',
  success:function(data){
    token = data;
  }
})

$('body').click(function(){
  $('#emailsuggest').html('');
});

Email.addEventListener("blur",function(){
  if(Email.value.length>1){
    /*
        이 함수는 email 에 글이 완성되면 추천 리스트를 띄워주는 역할을 한다....
        */
        var Data = {"_token" : token};

        Data['email'] = Email.value;

        $.ajax({
          type:'GET',
          url:'/getNameSuggest',
          data : Data,
          success:function(data){
            var obj = JSON.parse(data);
            for(var i = 0;i<obj.length;i++){

            console.log(obj[i][0]); // 이름
            console.log(obj[i][1]); // 이메일

            Sentence = '<li class = "suggest" id = "suggestList'+i+'"'+'> name : '+obj[i][0]+' email : '+obj[i][1]+'</li>';
            $('#emailsuggest').append(Sentence);
            var sen = '#suggestList'+i;
            $(sen).bind("click",function(){
              var t = $(this).attr('id').substr(11, 300);
              $('#email').val(obj[t][1]);
            });
          }
        },
        error: function(){
          alert('server connect error');
        }
      })

      }

    });

var userPkArr =[];
addCredit.addEventListener("click",function(){

  var Data = {"_token" : token};

  Data['email'] = Email.value;
  var dC = function duplicateCheck(){
    console.log(userPkArr);
    for(i=0;i<userPkArr.length;i++){
      if(userPkArr[i]==Email.value){return true;}
    }
    return false;
  }

  $.ajax({
    type:'POST',
    url:'/checkAddcredit',
    data : Data,
    success:function(data){
      if(data == 'There is no Email'){
        alert("등록되지 않은 이메일입니다. 이메일을 다시 확인해주세요.");
      }else if(dC()){
        alert("동일한 아이디가 미리 크레딧 되어있습니다. (this user is already credited)")
        //중복 이메일/USER PK 발견시 Alarm 또는 표시
      }else{
        var k = JSON.parse(data);

        var j = "<div class = 'creditContext'>";
        j += ("<div class='name'>"+k[0] + "</div><br>");
        j += ("<div class='position'>"+position.value+"</div></div>");
        $('#creditBox').append(j);

        var t = [k[1],position.value];
        creditArray.push(t);

      userPkArr.push(Email.value); //중복 확인 용 array
      console.log(userPkArr);
      $('#email').val("");
      $('#position').val("");
      console.log("CHEKING POINT");

    }
  },
  error: function(){
    alert('error');
  }
})

});

cancelButton.addEventListener("click",function(){
  goBack();
})

submitButton.addEventListener("click",function(){
  var Data2 = {"_token" : token};

  Data2['Title'] = TitleBox.value;
  Data2['ArtURL'] = URLBox.value;
  Data2['Description'] = Description.value;

  Data2['main'] = creditArray;

  $.ajax({
    type:'POST',
    url:'/uploadWriteDB',
    data : Data2,
    success:function(data){
      alert('success  '+ data);
      $(location).attr('href','/main');
    },
    error: function(){
      console.log(Data2);
      alert('error');
    }
  })

});
function goBack() {
  window.history.back();
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

  var width = 1050;
  var height = 484;
  var url = urlInput;
    // console.log(urlInput);
//    var url = urlInput.value; //url input 에서 가져오기
    var id = matchYoutubeUrl(url); //youtube url 인지 체크 하고 youtube id 반환
    if (id != false) {
      /** URL 확인하고 생성 공간과 바꾸기**/
      //alert("Youtube Video id: " + id);
//      $("#checkResult").html("Youtube Video id: " + id);
//      $("#testImage")
//          .html(
//              "<div> <iframe width='560' height='315' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe> </div>");
return "<iframe class='PostWork' width='"+width+"' height='"+height+"' src='https://www.youtube.com/embed/"+id+ "' frameborder='0' allowfullscreen></iframe>";
} else if (matchVimeoUrl(url) != false) {
      id = matchVimeoUrl(url); //vimeo id 반환
//      $("#checkResult").html("Vimeo Video id: " + id);
//      $("#testImage")
//          .html(
//              "<div> <iframe src='https://player.vimeo.com/video/"
//                  + id
//                  + "?title=0&byline=0&portrait=0&badge=0' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> </div>");
return "<iframe class='PostWork' src='https://player.vimeo.com/video/"
+ id
+ "?title=0&byline=0&portrait=0&badge=0' width='"+width+"' height='"+height+"' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
} else {
  return "<image class='PostWork' src = " + url + ">";
}
}

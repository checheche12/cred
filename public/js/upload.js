// Header section 추가
$(document).ready( function() {

  $("#header").load("/header");

});

$('body').append("<script src = 'js/makedFunction.js'>");

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
    $('#video').html(getImage(urlinput));
      // $('#URLBox').val("");
    });
});

$.ajax({
  url:'./token',
  success:function(data){
    token = data;
  }
})

$.ajax({
  url:'./email',
  success:function(data){
    data = JSON.parse(data);
    $("#email").val(data[0]);
  }
})

$('body').click(function(){
  $('#emailsuggest').html('');
});

Email.addEventListener("keyup",function(){

  if(Email.value.length>1){
    /*
      이 함수는 email 에 글이 들어오게 되면 추천 리스트를 띄워주는 역할을 한다....
    */

        var Data = {"_token" : token};

        Data['email'] = Email.value;

        $.ajax({
          type:'GET',
          url:'/getNameSuggest',
          data : Data,
          success:function(data){
            var obj = JSON.parse(data);

            $('#emailsuggest').html('');

            for(var i = 0;i<obj.length;i++){
            //obj[i][0] 은 이름 obj[i][1] 은 이메일
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

var userPKArr =[];  //중복 크레딧 체크용 배열

addCredit.addEventListener("click",function(){

  var Data = {"_token" : token};

  Data['email'] = Email.value;

  var dC = function duplicateCheck(k){ // 중복 크레딧 체크해 주는 함수
    console.log(userPKArr);
    for(i=0;i<userPKArr.length;i++){
      if(userPKArr[i]==k){return true;}
    }
    return false;
  }

  $.ajax({
    type:'POST',
    url:'/checkAddcredit',
    data : Data,
    success:function(data){
      var k = JSON.parse(data);
      if(data == 'There is no Email'){
        alert("등록되지 않은 이메일입니다. 이메일을 다시 확인해주세요.");
      }else if(dC(k[1])){
        alert("동일한 아이디가 미리 크레딧 되어있습니다. (this user is already credited)")
        //중복 이메일/USER PK 발견시 Alarm 또는 표시
      }else if(!position.value){
        alert("position 이 비어있습니다. (please type in position.)");

      }else{

        var j = "<div class = 'creditContext'>";
        j += ("<img class = 'xImage' id = "+k[1]+" src ='/mainImage/uploadImage/x.jpg'></img>");
        j += ("<div class='name'>"+k[0] + "</div><br>");
        j += ("<div class='position'>"+position.value+"</div></div>");
        $('#creditBox').append(j);

        $(".xImage").click(function(){
            var xButton = $(this).closest('div');
            var xButtonID = $(this).attr('id');
            xButtonID = xButtonID * 1;

            userPKArr = jQuery.grep(userPKArr, function(value) {
               return value != xButtonID;
             });

            for(var k = 0; k<creditArray.length;k++){
              if(creditArray[k].indexOf(xButtonID)!=-1){
                creditArray.splice(k,1);
                break;
              }
            }
            $(xButton).remove();
        });

        var t = [k[1],position.value];
        creditArray.push(t);

      userPKArr.push(k[1]); //중복 확인 용 array
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

/** getImage* */
function getImage(urlInput) {

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

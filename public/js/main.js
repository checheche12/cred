

var Project = document.getElementById('Project');
var Bridge_Log = document.getElementById('Bridge_Log');
var Bridge = document.getElementById('Bridge');
var token;

//js 에서 php 로 값을 넘겨서 php 페이지를 띄우기 위한 함수.
//js만으로 post 값 전달 방식을 사용 할 수 있지만 모든 태그를 a 태그화 해야함.
//첫번째 인수는 이동할 url 두번째는 전달할 값 세번째는 전송 방식.(기본이 post)
function post_to_url(path, int, method) {
    method = method || "post"; // 전송 방식 기본값을 POST로

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    //히든으로 값을 주입시킨다.
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("id","IDID");
    hiddenField.setAttribute("type","hidden");
    hiddenField.setAttribute('name','_token');
    hiddenField.setAttribute('value',token);

    var hiddenField2 = document.createElement("input");
    hiddenField2.setAttribute("id","intint");
    hiddenField2.setAttribute("type","hidden");
    hiddenField2.setAttribute('name',"int");
    hiddenField2.setAttribute('value',int);

    form.appendChild(hiddenField);
    form.appendChild(hiddenField2);
    document.body.appendChild(form);

    form.submit();
}


// GetContentByDB 함수에서 URL 을 json 형태로 변환하여 전달해준다. 그러므로
// 이 함수에서 json 형태를 다시 URL 배열로 풀어서
// 3행짜리 동영상의 table 을 구성한다.

// 현재 제작 과정. post 페이지로 잘 이동한다.

Project.addEventListener("click",function(){

    // 토큰값을 가지고 와야한다. 토큰용 php 파일을 하나 만든다.
    $.ajax({
      url:'./token',
      success:function(data){
          token = data;
      }
    })

    $('#profileBody').text('');
    $.ajax({
      url:'./getContentURL',
      success:function(data){
          var k = JSON.parse(data);
          for(var i=0;i<k.length;i++){
              j = '<img id = Image'+ k[i][0] +' src = '+k[i][1]+' width = "232px" height ="232px">';
              var IDValue = '#Image'+k[i][0];
              $('#profileBody').append(j);
              $(IDValue).bind('click',function(){
                  var t = $(this).attr('id').substr(5,1000);
                  t *=1;
                  post_to_url("./post",t);
              });
          }
      }
    })
});

//DB에서 값 긁어 오는지 볼려고 만든 함수인데 잘 긁어 와짐. 만족함. 당연히 나중에
//수정 해야함.

Bridge_Log.addEventListener("click",function(){
    $.ajax({
      url:'./UserInfo',
      success:function(data){
          $('#profileBody').html(data);
      }
    })
});

// 로그아웃 하는 버튼인데 원래는 아님 나중에 수정해야함.

Bridge.addEventListener("click",function(){
  $(location).attr('href','./Logout');
});

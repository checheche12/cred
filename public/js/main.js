

var Project = document.getElementById('Project');
var Bridge_Log = document.getElementById('Bridge_Log');
var Bridge = document.getElementById('Bridge');

// GetContentByDB 함수에서 URL 을 json 형태로 변환하여 전달해준다. 그러므로
// 이 함수에서 json 형태를 다시 URL 배열로 풀어서
// 3행짜리 동영상의 table 을 구성한다.

// 현재 제작 과정. 이미지를 잘 불러오므로 이미지를 클릭했을때 post 페이지로 넘어가는
// 내용을 구현해 볼 것이다.

Project.addEventListener("click",function(){
    $.ajax({
      url:'./getContentURL',
      success:function(data){
          var k = JSON.parse(data);

          for(var i=0;i<k.length;i++){
              var j = '<img id = Image'+ (i+1) +' src = '+k[i][1]+' width = "232px" height ="232px">';
              var IDValue = '#Image'+(i+1);
              $('#profileBody').append(j);
              $(IDValue).bind('click',function(){
                  alert($(this).attr('id'));
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

<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

?>
<link rel="stylesheet" type ="text/css" href="css/intro2.css?v=1">
<button id = "userinquiry">유저 조회</button>
<button id = "postinquiry">게시물 조회</button>
<button id = "writenoti">공지 작성</button>
<button id = "Spotlight">스포트라이트 변경</button>
<button id = "RecentWork">최근작품 변경</button>
<button id = "statistics">통계</button>

<div id = "controller">

</div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script>

//유저 관리

$("#userinquiry").click(function(){
  $('#controller').text('');

  $.ajax({
      type:'get',
      url:'/administratorgetuser',
      success:function(data){
          $('#controller').append(data);
          $(".usercard").click(function(){
              var k = $(this);
              if(confirm("유저 아이디가 " + $(this).attr('id') + "인 유저를 정말로 삭제하시겠습니까?") == true){

                  $.ajax({
                      type:'GET',
                      url:'/administratordeleteuser?number='+$(this).attr('id'),

                      success:function(data2){
                          alert("유저 삭제가 완료되었습니다.");
                          $(k).remove();

                      }

                  })

              }
          });
      }
  })
       	// $(location).attr('href','/bridge');
})

//게시물 관리

$("#postinquiry").click(function(){
  $('#controller').text('');

  $.ajax({
      type:'get',
      url:'/administratorgetpost',
      success:function(data){
          $('#controller').append(data);

          $(".artcard").click(function(){
              var k = $(this);
              if(confirm("작품 번호가 " + $(this).attr('id') + "인 작품을 정말로 삭제하시겠습니까?") == true){

                  $.ajax({
                      type:'GET',
                      url:'/administratordeletepost?number='+$(this).attr('id'),

                      success:function(data2){
                          alert("글 삭제가 완료되었습니다.");
                          $(k).remove();

                      }

                  })

              }
          });
      }
  })
       	// $(location).attr('href','/bridge');
})

//공지 작성

$("#writenoti").click(function(){
  $('#controller').text('');

  var string = '<br><br>URL <input id = "T1" type = "text" style = "width : 500px "><br><br><br>';
  string += 'Text <textarea id = "T2" row = "100" cols = "100"';
  string += "style = 'margin : 0px; width : 700px; height : 300px;'>";
  string += '</textarea><br><br>';
  string += '<button id = "sub">등록</button>&nbsp;&nbsp;';
  string += '<button id = "pre">미리보기</button>';
  string += '<div id = "preloader"></div>';

    $('#controller').append(string);

    $('#sub').click(function(){
        var T1T2 = {"url" : $("#T1").val()};
        T1T2['TEXT'] = $("#T2").val();

        $.ajax({
            type : 'post',
            url: '/administratoruploadindex',
            data: T1T2,
            success:function(data){
                alert('공지가 성공적으로 등록되었습니다.');
                $('#controller').text('');
            }
        });

    });


    $('#pre').click(function(){

        var kk = '<div id="MainContent_Frame">';
        kk += '<div id="MainContent">'
        kk += '<img id="MainImage" src= '+$("#T1").val()+'>';
        kk += '<div id="quoteBox">';
        kk += $("#T2").val();
        kk += '</div>';
        kk += '</div>';
        kk += '</div>';

       $("#preloader").html(kk);

    });

});


$("#Spotlight").click(function(){

  $('#controller').text('');

  $.ajax({
      type : 'get',
      url : "/getspotlight",
      success:function(data){
        $("#controller").append(data);

          var kk = '<br><br><br><input id = "firstS" type = "text">&nbsp;&nbsp;';
          kk += '<input id = "secondS" type = "text">&nbsp;&nbsp;';
          kk += '<input id = "thirdS" type = "text">&nbsp;&nbsp;';
          kk += '<input id = "fourthS" type = "text">';
          kk += '<button id = "subS">스포트라이트 등록하기</button>';
          $("#controller").append(kk);

          $("#subS").click(function(){
                var Spotdata = {"first" : $('#firstS').val(), "second" : $('#secondS').val(), "third" : $('#thirdS').val(), "fourth" : $('#fourthS').val()};
                $.ajax({
                    type : 'post',
                    data : Spotdata,
                    url : '/uploadSpotlight',
                    success:function(data){
                        alert("스포트라이트 등록에 성공했습니다.");
                        $('#controller').text('');
                    }
                })

          });

      }
  });

});

$("#RecentWork").click(function(){

    $('#controller').text('');

    $.ajax({
        type : 'get',
        url : "/getrecent",
        success:function(data){
          $("#controller").append(data);

            var kk = '<br><br><br><input id = "firstS" type = "text">&nbsp;&nbsp;';
            kk += '<input id = "secondS" type = "text">&nbsp;&nbsp;';
            kk += '<input id = "thirdS" type = "text">&nbsp;&nbsp;';
            kk += '<input id = "fourthS" type = "text">';
            kk += '<button id = "subS">최근작품 등록하기</button>';
            $("#controller").append(kk);

            $("#subS").click(function(){
                  var Spotdata = {"first" : $('#firstS').val(), "second" : $('#secondS').val(), "third" : $('#thirdS').val(), "fourth" : $('#fourthS').val()};
                  $.ajax({
                      type : 'post',
                      data : Spotdata,
                      url : '/uploadrecent',
                      success:function(data){
                          alert("최근작품 등록에 성공했습니다.");
                          $('#controller').text('');
                      }
                  })

            });

        }
    });


});

</script>

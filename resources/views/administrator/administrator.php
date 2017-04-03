<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

?>

<button id = "userinquiry">유저 조회</button>
<button id = "postinquiry">게시물 조회</button>
<button id = "writenoti">공지 작성</button>
<button id = "statistics">통계</button>

<div id = "controller">

</div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script>
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
</script>

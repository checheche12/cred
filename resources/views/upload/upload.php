<!-- <script type="text/javascript">
  function statusChangeCallback(response) {
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      var fbFriend =[];
      FB.api( //친구리스트 불러오기
        "/me/taggable_friends?limit=2000",
        function (response) {
          if (response && !response.error) {
            /* handle the result */
            console.log(response)
            var data = response.data;
            var edge = response.edge;
            for(var i=0; i<response.data.length; i++){
              let fbFriendName= data[i].name;
              let fbFriendPicture= data[i].picture.data.url;
              console.log("checking friend's list");

              if ((fbFriendName).toLowerCase().includes(($('#email').val()).toLowerCase())){
                Sentence = '<li class = "suggest" id = "suggestListFb'+i+'"'+' style="cursor:pointer;"> <img src="'+fbFriendPicture+'" height="20px" width="20px"> name : '+fbFriendName+'</li>';
                var sen = '#suggestListFb'+i;
                $('#emailsuggest').append(Sentence);
                console.log("clicked suggest 1 "+sen);

                $(sen).bind("click",function(){
                  console.log("Clikcing Friend's Name");
                  console.log("i: "+i+" Name: "+fbFriendName + "idValue: "+sen);
                  $('#email').val(fbFriendName);
                });
              }
            }
          }
        });
    }else {
      // The person is not logged into your app or we are unable to tell.
      // document.getElementById('status').innerHTML = 'Please log ' +
      // 'into this app.';
      console.log('please log into this app');
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '278220249266484',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
    // checkLoginState();
  };

  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


</script> -->
<link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
<link rel="stylesheet" type ="text/css" href="css/upload.css">
<div id = "header">
  <?php
  include_once('../resources/views/header.php');
  ?>
</div>

<p id = "uploadtext" >upload</p>

<div id = "video">

</div>

<div id = "contextBox">

  <label for="URLBox">URL을 입력하여 프로젝트를 업로드하세요</label><br>
  <input id = "URLBox" type="text" placeholder="동영상 url을 입력해 주세요"></input><br><br>
  <label for="titleBox">제목</label><br>
  <input id = "titleBox" type="text"></input><br><br>

  <div><label for="email">크레딧</label><img id="credqmark" src="/mainImage/credqmark.png" title="영상 제작에 기여한 모든 사람들에 대해 알려주세요.
  사람들은 주로 캐스트, 촬영, 편집 ,기획, 클라이언트, 협력사 등에 대한 정보를 알고 싶어합니다."></div>
  <input id = "email" type="text" placeholder="이름 / e-mail"></input>
  <input id = "position" type="text" placeholder=" 담당 역할"></input>
  <button id = "submitCredit" >+추가</button><br><br>
  <!-- 추가된 크레딧 -->

  <div id = "emailsuggest">

  </div>

  <div id = "creditBox">
  </div>

  <label for="context">작품설명</label><br>
  <textarea id = "context" cols : "40" rows:"10" placeholder="[TIP] 작품과 작품 제작과정에 대한 모든 정보를 공유해 주세요.
  사람들은 주로 비디오 저작권자, 기획 인사이트, 사용된 촬영 및 편집 기술과 장비, 음향소스 같은 정보를 궁금해합니다."></textarea><br><br>

  <button id = "cancelButton" class="submitButton">cancel</button>
  <button id = "saveButton" class="submitButton">저장</button>

</div>

<script type = "text/javascript" src = "js/upload.js"></script>

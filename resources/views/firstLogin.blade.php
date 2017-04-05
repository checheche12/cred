<link rel="stylesheet" type ="text/css" href="css/firstLogin.blade.css">


<?php
session_start();
if(isset($_SESSION['is_login'])){
  header('Location: ./main');
  exit;
}
?>

<!-- Facebook API -->
<script>
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      FB.api('/me',{fields: 'name, email'},function(response){
        console.log('checkpoint 1');
        setValue();
        function setValue(){
          document.hiddenLoginForm.email.value = response.email;
          document.hiddenLoginForm.name.value = response.name;
          var tEmail = document.getElementById("email").value;
          var tName = document.getElementById("name").value;
          console.log('sending hiddenForm to newMember : '+tEmail+' || '+tName);
          document.getElementById('hiddenLoginForm').submit();
        }
        testAPI();

      })
    }else {
      // The person is not logged into your app or we are unable to tell.
      // document.getElementById('status').innerHTML = 'Please log ' +
      // 'into this app.';
      console.log('please log into this app');
    }
  }


// /** TESTING **/
//   function loginProcess(){
//     console.log('In login Process 1...');

//     FB.login(function(response) {
//     console.log('In login Process 2...');
//       if (response.authResponse) {
//         FB.api('/me', {fields: 'name, email'}, function(response) {
//           console.log('login Process Successful. '+response.email +'||'+response.name);
//         //user just authorized your app
//       });
//       }
//     }/*, {scope: 'email, public_profile', return_scopes: true}*/);
//     // console.log("testAPI: ");
//     // testAPI();
//   }

// This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
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
  };

  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    // FB.api('/me', {fields: 'name,email'}, function(response) {
    //   console.log('Successful login for: ' + response.name + '|' + response.email);
    //   document.getElementById('status').innerHTML =
    //   'Thanks for logging in, ' + response.name + '!';
    // });
    FB.api( //친구리스트 불러오기
      "/me/taggable_friends?limit=2000",
      function (response) {
        if (response && !response.error) {
          /* handle the result */
          console.log(response)
          for(var i=0; i<response.data.length; i++){
            var data = response.data;
            console.log(data[i].name + "number of friend: "+i);
          }
        }
      }
      );
  }
</script>

<div class="logo">
  <img src = "/mainImage/signupImage/credlogowhite.png" width="187px"><br>
</div>
<div class="quote">CRED. New experience!</div>

<form id = "form" method="post" action = "auth">
  <div class="infoFrame">

    <p class="labels">이메일</p>
    <input class = "BOX" id = "IDID" name = "ID" type="text"><br>
    <p class="labels">패스워드</p>
    <input class = "BOX" id = "PWPW" name ="PW" type="password"><br><br>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="buttons">

    <!-- Testing Button-->
    <!-- <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false" onlogin="loginProcess()" scope="public_profile,email"></div> -->

    <input id = "subsub" type="submit" value="로그인" />

  </form>


  <a href = "/signup">
    <input id="signupBt" type="button" name="signupBt" value="회원가입">
  </a>

  <br><br>
  <a href = "/passwordinit" id = "pass">
    비밀번호를 잊어버리셨나요?
  </a>

</div>
<div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState()" scope="public_profile,email,user_friends, publish_actions"></div>

<!-- <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState()" scope="public_profile,email,user_friends, publish_actions"></div> -->

<!-- facebook login button -->
<!-- <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="true" data-auto-logout-link="true" onlogin="checkLoginState()" scope="public_profile,email"></div> -->

<form id="hiddenLoginForm" name="hiddenLoginForm" method="post" action="newMember">
  <input type="hidden" name="email" id="email" value="">
  <input type="hidden" name="name" id="name" value="">
  <input type="hidden" name="_token" value = "{{csrf_token()}}">

</form>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>

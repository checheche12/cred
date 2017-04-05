<style>
html{
    background: #fafafa;
}
body{
  text-align: center;
  padding-top: 20px;
  margin: 100 auto;
  background: white;
  width: 700px;
  border: 1px solid #e6e6e6;
  height:250px;
}
#IDID{
  height : 35px;
  width : 300px;
  padding : 0 20px;
  border-radius: 3px;
  box-shadow: 0 0 0 1px rgba(0,0,0,.1), 0 2px 3px rgba(0,0,0,.2);
  border: 1px solid #dbdbdb;
}
#subsub{
  width : 90px;
  height : 35px;
  background-color: #008cba;
  color : white;
  border : 2px solid #008cba;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  border-radius: 4px;
  cursor: pointer;
}
</style>

이메일을 입력해주십시오.

<form id = "form" method="get" action = "/passwordinitemail">

  <div class="infoFrame">
    <p class="labels">이메일</p>
    <input class = "BOX" id = "IDID" name = "ID" type="text" size = "30"><br>
  </div>

  <br>
    <!-- Testing Button-->
    <!-- <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false" onlogin="loginProcess()" scope="public_profile,email"></div> -->

    <input id = "subsub" type="submit" value="확인" />

  </form>

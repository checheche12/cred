<link rel="stylesheet" type ="text/css" href="css/signup.css">
<link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
<body id="body">
	<div id="infoFrame">
		<div class="logoDiv">
			<img
			id="logoImage" src="/mainImage/signupImage/signupLogo.png"
			><br>
		</div>
		<div class="quote">
			프로젝트에서 당신의 역할은 무엇이었나요?<br>모든 이들은 당신을 궁금해합니다.
		</div>
		<div class="quote1">
			무료로 가입하세요.
		</div>
		<form method="post" action="checkSignup">

			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

			<input type="radio" name="chk_info" value="personal" checked="checked">Personal
			&nbsp; &nbsp; &nbsp; &nbsp;
			<input type="radio" name="chk_info" value="group">Group
			
			<div class="infoFrame">
				<input class="BOX" type="text" id='email' name="emailemail"
				placeholder=" 이메일주소"> <input class="BOX" type="text"
				id='name' name="namename" placeholder=" 사용자 이름"> <input
				class="BOX" type="password" id='pw' name="pwpw" placeholder=" 비밀번호">
			</div>
			<input type="hidden" name="hiddenPicURL" value="mainImage/default_profile_pic.png">
			<button id="signUp">회원가입</button>
		</form>
	</div>
</body>
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/signUp.js"></script>

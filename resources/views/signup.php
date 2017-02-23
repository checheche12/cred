<link rel="stylesheet" type ="text/css" href="css/signup.css">

<body id="body">
<div id="infoFrame">
	<div class="logoDiv">
		<img
			id="logoImage" src="/mainImage/signupImage/signupLogo.png"
			><br>
	</div>
	<div class="quote">
		CRED에서 여러 사람들과의 협업을 <br>공유하고 관리하세요!
	</div>

	<form method="post" action="checkSignup">

		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

		<div class="infoFrame">
			<input class="BOX" type="text" id='email' name="emailemail"
				placeholder=" 이메일주소"> <input class="BOX" type="text"
				id='name' name="namename" placeholder=" 사용자 이름"> <input
				class="BOX" type="password" id='pw' name="pwpw" placeholder=" 비밀번호">
		</div>
		<div id="signupD">
			<input id="signUp" type="image"
				src="https://files.slack.com/files-pri/T2Z0F0H1A-F45JKFU1Z/_____________________________________________.png" />
		</div>
	</form>
</div>
</body>
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/signUp.js"></script>

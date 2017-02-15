<form method = "post" action = "checkSignup">

<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

이름:
<input type = "text" id = 'name' name = "namename">
이메일:
<input type = "text" id = 'email' name = "emailemail">
비밀번호:
<input type = "password" id = 'pw' name = "pwpw">

<input type = "submit">
</form>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>

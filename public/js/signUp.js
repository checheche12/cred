var logoImage = document.getElementById('logoImage');

logoImage.addEventListener("click",function(){
		$(location).attr('href', './');
})

var EmailRegExp =  /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
var form = document.getElementsByTagName("form");

var inputButton = document.getElementById("signUp");
inputButton.addEventListener("click",function(){

	EmailValue = $("#email").val();
	if(EmailValue.match(EmailRegExp)==null){
		alert("이메일 형식이 잘못되었습니다.");
	}else{
		form[0].submit();
	}

});

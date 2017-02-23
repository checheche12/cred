$(document).ready( function() {
	$("#header").load("/header");
});

var token;
$.ajax({
		url : './token',
		success : function(data) {
			token = data;
		}
})


var Edit = document.getElementById('eeddiitt');

Edit.addEventListener("click",function(){

			var Data = {"_token" : token};

			Data['name'] = $("#name").val();
			Data['career'] = $("#career").val();
			Data['education'] = $("#education").val();
			Data['keyword'] = $("#keyword").val();

			$.ajax({
	        type:'POST',
	        url:'/informationEdit/informationUp',
	        data : Data,
	        success:function(data){
							alert("업데이트 성공, 메인화면으로 돌아갑니다!");
							$(location).attr('href','/main');
	        },
	        error: function(){
	          alert('error 서버 연결 안됨!');
	        }
	    })

});

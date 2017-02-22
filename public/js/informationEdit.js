$(document).ready( function() {
	$("#header").load("/header");
});

var token;

var Edit = document.getElementById('edit');

Edit.addEventListener("click",function(){
			$.ajax({
				url : './token',
				success : function(data) {
					token = data;
				}
			})
});

$('img').on('error',function(){
	$(this).attr('src', '/mainImage/noimage.png');
});

$("#xBt").on('click',function(){
	$("#ContentWidth").remove();
	$.ajax({
		type:'GET',
		url:'/eventCheck',
		success:function(data){
			alert("Button Disable");
		},error: function(){
			alert("ERROR");
		}
	})
});
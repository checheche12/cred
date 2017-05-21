$('img').on('error',function(){
	$(this).attr('src', '/mainImage/noimage.png');
});

$("#xBt").on('click',function(){
	$("#ContentWidth").remove();
	$.ajax({
		type:'GET',
		url:'/eventStatus',
		success:function(data){
			alert("Button Disable");
		},error: function(){
			alert("ERROR");
		}
	})
});
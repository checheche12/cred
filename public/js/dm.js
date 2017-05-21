var DMText = document.getElementById('DMText');
var recieverAccount = 0;


$( document ).ready(function() {
  $("#DMDetail").scrollTop('1000');

	$("#DMDetail").scroll(function() {
			var minHeight = 0;
			var currentScroll = $("#DMDetail").scrollTop();

					if (minHeight >= currentScroll) {
							recieverAccount += 15;
							Data = {"recieveruserPK" : recieveruserPK , "recieverAccount" : recieverAccount};
							$.ajax({
									type:'GET',
									url : '/dmaddDetail',
									data : Data,
									success:function(data){
										$("#DMDetail").scrollTop("1");
										$("#DMDetail").prepend(data);
									}
							});
					}
			})
});


$("#send").click(function(){
	// if(confirm("실제로 전송하시겠습니까?")==true){

			Data = {"recieveruserPK" : recieveruserPK};
			Data['DMText'] = DMText.value.replace(/\n/g, "<br>");
			$.ajax({
				type:'POST',
				url : '/dmSend',
				data : Data,
				success:function(data){
          var string = "<div class = 'right'>"+
                "<p class='Date'>"+data+"</p>"+
                "<div class = 'rtext'>"+Data['DMText']+"</div>"+
                "<img class = 'rightImg' src = '"+$("#profileImage").attr('src')+"'>"+
                "</div>";
					$("#DMDetail").append(string);
          var k = $('body').prop("scrollHeight");
          $("#DMDetail").scrollTop(k);
          $("#DMText").val("");
				}
			})

	// }
});

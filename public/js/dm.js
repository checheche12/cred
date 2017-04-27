var DMText = document.getElementById('DMText');

$("#send").click(function(){
	if(confirm("실제로 전송하시겠습니까?")==true){

			Data = {"recieveruserPK" : recieveruserPK};
			Data['DMText'] = DMText.value.replace(/\n/g, "<br>");
			$.ajax({
				type:'POST',
				url : '/dmSend',
				data : Data,
				success:function(data){
					location.reload();
				}
			})

	}
});

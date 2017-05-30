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
          if(data=="error"){

            alert("없는 유저입니다.")

          }else{

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
				}
			})

	// }
});

$( "#searchDMSlot" ).autocomplete({
	minLength: 1,
	source: function( request, response ) {
		var Data = {"_token" : token};
		Data['inputValue'] = $('#searchDMSlot').val();
		$.ajax({
			type:'GET',
			dataType: "json",
			url: "searchProcess",
			data: Data,	//0 Email,1 Name,2 ProfilePhotoURL,3 userPK,4 Career(position),5 education,6 belong(organization),7 location
			success: function( data ) {
				response( data );
				console.log('data response success');
			},error: function(){
				console.log("AJAX Search error");
			}
		});
		console.log('in Autocomplete function');

	},
      focus: function( event, ui ) {                //value in inputValue
      	$( "#searchDMSlot" ).val( ui.item[1] );
      	// $("#hiddenSearchValue").val(ui.item[3]);
      	return false;
      }
  })
.on( "autocompleteselect", function( event, ui ) {
  location.href="/dm?userPK="+ui.item[3];
	return false;
} )
.autocomplete( "instance" )._renderItem = function( ul, item ) {
	var k_str = '<div id="resultList" class="resultList"><img id="resultImage" src="'+item[2]+'" style="height: 50px;">'
	+'<div id="searchInfoContainer" style="display: inline-block;">'
	if(item[1]!=''){
		k_str += '<div id="name" class="searchInfo">'+item[1]+'</div>'
	}
	if(item[6]!=''){
		k_str += '<div id="curOrganization" class="searchInfo" style="display: inline-block;">'+item[6]+'</div><br>';
	}
	if(item[4]!=''){
		k_str += '<div id="curPosition" class="searchInfo" style="display: inline-block;">'+item[4]+'</div>';
	}
	if(item[7]!= ''){
		k_str += '<div id="location" class="searchInfo">'+item[7]+'</div>';
	}
	k_str += '</div></div>';

	return $( "<li>" )
	.append(k_str)
	.appendTo( ul );
};

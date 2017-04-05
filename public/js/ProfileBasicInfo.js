var informationEdit = document.getElementById('informationEdit');
var profileImage2 = document.getElementById('profileImage2');

var educationInfo = document.getElementById("educationInfo");
var specialtyInfo = document.getElementById("specialtyInfo");

var another;
var specialty;

if(another=='no'){
	informationEdit.addEventListener("click",function(){
		$(location).attr('href', './informationEdit');
	})
}

$(document).ready(function() {

	$("#educationInfo").on("click", function(){
		$('#searchSlot').val($("#educationInfo").text());
		$('#searchSlot').autocomplete( "search");
	});

	$("#curOrganization").on("click", function(){
		$('#searchSlot').val($("#curOrganization").text());
		$('#searchSlot').autocomplete( "search");
	});

	$("#curPosition").on("click", function(){
		$('#searchSlot').val($("#curPosition").text());
		$('#searchSlot').autocomplete( "search");
	});

	$("#location").on("click", function(){
		$('#searchSlot').val($("#location").text());
		$('#searchSlot').autocomplete( "search");
	});
	for (var i =0; i<specialty.length;i++) {
		console.log("check point 1");
		var bindId = "#specialty" + i;
		$(bindId).bind("click", function(){
			console.log("check point 2");
			$('#searchSlot').val($(bindId).text());
			$('#searchSlot').autocomplete( "search");
		});
	}
});

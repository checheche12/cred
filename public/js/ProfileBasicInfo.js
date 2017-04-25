var informationEdit = document.getElementById('informationEdit');
var profileImage2 = document.getElementById('profileImage2');

var educationInfo = document.getElementById("educationInfo");
var specialtyInfo = document.getElementById("specialtyInfo");

var specialty = document.getElementsByClassName("specialty");
var award = document.getElementsByClassName("award");
var exO = document.getElementsByClassName("exO");
var exL = document.getElementsByClassName("exL");
var exP = document.getElementsByClassName("exP");

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
		specialtyBinding(i);
	}
	// if(award!=undefined){
	// 	for (var i =0; i<award.length;i++) {
	// 		awardBinding(i);
	// 	}
	// }
	if(exO!=undefined){
		for (var i =0; i<exO.length;i++) {
			exOBinding(i);
		}
	}
	if(exL!=undefined){
		for (var i =0; i<exL.length;i++) {
			exLBinding(i);
		}
	}
	if(exP!=undefined){
		for (var i =0; i<exP.length;i++) {
			exPBinding(i);
		}
	}
});

function specialtyBinding(i){
	var bindId = "#specialty" + i;
	$(bindId).bind("click", function(){
		$('#searchSlot').val($(bindId).text());
		$('#searchSlot').autocomplete( "search");
	});
}
function awardBinding(i){
	var bindId = "#award" + i;
	$(bindId).bind("click", function(){
		$('#searchSlot').val($(bindId).text());
		$('#searchSlot').autocomplete( "search");
	});
}
function exOBinding(i){
	var bindId = "#exOrganization" + i;
	$(bindId).bind("click", function(){
		$('#searchSlot').val($(bindId).text());
		$('#searchSlot').autocomplete( "search");
	});
}
function exLBinding(i){
	var bindId = "#exWorkLocation" + i;
	$(bindId).bind("click", function(){
		$('#searchSlot').val($(bindId).text());
		$('#searchSlot').autocomplete( "search");
	});
}
function exPBinding(i){
	var bindId = "#exPosition" + i;
	$(bindId).bind("click", function(){
		$('#searchSlot').val($(bindId).text());
		$('#searchSlot').autocomplete( "search");
	});
}
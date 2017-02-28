var informationEdit = document.getElementById('informationEdit');
var profileImage2 = document.getElementById('profileImage2');

if(another=='no'){
	informationEdit.addEventListener("click",function(){
			$(location).attr('href', './informationEdit');
	})
}


profileImage2.addEventListener("click",function(){
		$(location).attr('href', './main');
})

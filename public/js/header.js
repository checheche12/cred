var Upload = document.getElementById('upload');
var Logout = document.getElementById('logout');

Upload.addEventListener("click", function() {

	$(location).attr('href', './upload');

});

Logout.addEventListener("click", function() {

	$(location).attr('href', './Logout');

});

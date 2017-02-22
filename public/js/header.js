var Upload = document.getElementById('upload');
var Logout = document.getElementById('logout');
var Home = document.getElementById('credImage');

Upload.addEventListener("click", function() {

	$(location).attr('href', './upload');

});

Logout.addEventListener("click", function() {

	$(location).attr('href', './Logout');

});

Home.addEventListener("click", function() {

	$(location).attr('href', './main');

});
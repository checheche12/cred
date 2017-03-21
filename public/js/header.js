var Upload = document.getElementById('upload');
var Logout = document.getElementById('logout');
var Home = document.getElementById('credImage');
var profileImage = document.getElementById('profileImage');
var profileName = document.getElementById('profileName');
var yourart = document.getElementById('yourart');

Upload.addEventListener("click", function() {

	$(location).attr('href', './upload');

});

Logout.addEventListener("click", function() {

	$(location).attr('href', './Logout');

});

Home.addEventListener("click", function() {

	$(location).attr('href', './main');

});

profileImage.addEventListener("click", function() {

	$(location).attr('href', './main');

});
profileName.addEventListener("click", function() {

	$(location).attr('href', './main');

});
yourart.addEventListener("click", function() {

	$(location).attr('href', './Yourart');

});
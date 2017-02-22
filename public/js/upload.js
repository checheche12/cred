$(document).ready( function() {

	$("#header").load("/header");

});

var TitleBox = document.getElementById('titleBox');
var URLBox = document.getElementById('URLBox');
var Description = document.getElementById('context');

var addCredit = document.getElementById('submitCredit');
var Email = document.getElementById('email');
var position = document.getElementById('position');

var CreditBox = document.getElementById('creditBox');

var submitButton = document.getElementById('submit');

var token;

var creditArray = [];


$.ajax({
  url:'./token',
  success:function(data){
      token = data;
  }
})


addCredit.addEventListener("click",function(){

    var Data = {"_token" : token};

    Data['email'] = Email.value;

    $.ajax({
        type:'POST',
        url:'/checkAddcredit',
        data : Data,
        success:function(data){
            if(data == 'There is no Email'){
              alert("등록되지 않은 이메일입니다. 이메일을 다시 확인해주세요.");
            }else{
              var k = JSON.parse(data);

              var j = "<div class = 'creditContext'>";
              j += (k[0] + "<br>");
              j += (position.value+"</div>");
              $('#creditBox').append(j);

              var t = [k[1],position.value];
              creditArray.push(t);

            }
        },
        error: function(){
          alert('error');
        }
    })

});

submitButton.addEventListener("click",function(){
      var Data2 = {"_token" : token};

      Data2['Title'] = TitleBox.value;
      Data2['ArtURL'] = URLBox.value;
      Data2['Description'] = Description.value;

      Data2['main'] = creditArray;

      $.ajax({
          type:'POST',
          url:'/uploadWriteDB',
          data : Data2,
          success:function(data){
            alert('success  '+ data);
          },
          error: function(){
            console.log(Data2);
            alert('error');
          }
      })

});

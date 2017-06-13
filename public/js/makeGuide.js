imagePreload = function() {
    // variables
    var image_cache_array = new Array(),
        i = 0;

    // termination condition
    if (!document.images) {
      return false;
    }

    for (key in arguments) {
      image_cache_array[i] = new Image();
      image_cache_array[i].src = arguments[key];
      i++;
    }

    return i;
  }


function makeGuide(isStart, selector, x_Position, y_Position,imageURLs,number,arrowImage,guideOptionArray,animatingFunction)
{

	if(!isStart)
	{
			return ;
	}else{

    if(arrowImage == undefined){
      var BodyTag = document.getElementsByTagName("body"); // arrowImage 이미지 경로를 여기다가 추가해야한다.
      $(BodyTag).prepend('<div id = "backLayerDiv">'+
      '<div id = "guideTotal">'+
      '<div id = "positionAbsolute" style="position: absolute">'+
      '<div id = "guideImage"><div id = "reView" style="display : inline-block;position: absolute;margin-top: 3rem;margin-left: 4.3rem;z-index: 1001;">다시보지 않기</div><img id = "mainImage" src = '+imageURLs[0]+'>'+''+'</img>'+
      '</div>'+
      '</div>');
    }else{
      var BodyTag = document.getElementsByTagName("body"); // arrowImage 이미지 경로를 여기다가 추가해야한다.
      $(BodyTag).prepend('<div id = "backLayerDiv">'+
      '<div id = "guideTotal">'+
      '<div id = "positionAbsolute" style="position: absolute">'+
      '<div id = "guideImage"><div id = "reView" style="display : inline-block;position: absolute;margin-top: 3rem;margin-left: 4.3rem;z-index: 1001;">다시보지 않기</div><img id = "mainImage" src = '+imageURLs[0]+'>'+''+'</img>'+
      '<div id = "ArrowBox">'+
      '<div id = "preventGuide"><img id = "preventImage" src = '+arrowImage[0]+'>'+''+'</img></div>'+
      '<div id = "nextGuide"><img id = "nextImage" src = '+arrowImage[1]+'>'+''+'</img><div></div></div>'+
      '</div></div>'+
      '</div>');
    }
		//style="background-image: url(/mainImage/GuideImage/box.png)"

		$("#guideTotal").css('display','inline-block');
		$("#preventGuide").css('z-index',"1000").css('display','inline-block');
		$("#nextGuide").css('z-index',"1000").css('display','inline-block');
		$("#guideTotal").css('margin-left',$(selector).offset().left+x_Position).css('margin-top',$(selector).offset().top+y_Position)
		if($.inArray('backgroundcolor',Object.keys('guideOptionArray'))==-1){
			var width = $(BodyTag[0]).width()
			var height = $(BodyTag[0]).height()
			$("#backLayerDiv").css('z-index',"1001").css('position',"absolute").css('left',"0px").css('top',"0px").css('background-color','rgba(136,136,136,0.5)')
			$("#backLayerDiv").width(width);
			$("#backLayerDiv").height(height);

			//$(BodyTag).css("background-color","#888888")

		}else{
			var width = $(BodyTag[0]).width()
			var height = $(BodyTag[0]).height()
			$("#backLayerDiv").css('position',"absolute").css('left',"0px").css('top',"0px").css('background-color',guideOptionArray['backgroundcolor'])
			$("#backLayerDiv").width(width);
			$("#backLayerDiv").height(height);

			//$(BodyTag).css("background-color",guideOptionArray['backgroundcolor'])
		}
		var leftOffset = $("#positionAbsolute").offset().left+($("#guideImage").width()-$("#positionAbsolute").width())/2
		var topOffset = $("#positionAbsolute").offset().top+($("#guideImage").height()-$("#positionAbsolute").height())/2

			console.log($("#guideImage").width())
			console.log($("#guideImage").height())
			console.log($("#positionAbsolute").width())
      console.log($("#positionAbsolute").height())
			$("#positionAbsolute").css('left',leftOffset).css('top',topOffset)

		$(window).resize(function(){
			var width = $(BodyTag[0]).width()
			var height = $(BodyTag[0]).height()
      $("#backLayerDiv").width(width).height(height);
			$("#guideToal").css('margin-left',$(selector).offset().left).css('margin-top',$(selector).offset().top)
   });

	 $("#guideTotal").click(function(event){
		 	event.stopPropagation();
	 })

	 $("#backLayerDiv").click(function(){
		 	$(this).remove()

	 });

   $("#reView").click(function(){
      var Data = {"number" : number};
      $.ajax({
  			type:'GET',
  			url:'/guideSetting',
  			data : Data,
  			success:function(data){
            $("#backLayerDiv").remove()
  			},
  			error: function(){
          alert(number)
  			     alert('error');
  			}
  		})
   });


	}

}

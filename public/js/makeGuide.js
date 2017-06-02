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


function makeGuide(isStart, selector, x_Position, y_Position,arrowImage,imageURLs ,guideOptionArray,animatingFunction)
{

	if(!isStart)
	{
			return ;
	}else{

		//style="background-image: url(/mainImage/GuideImage/box.png)"
		var BodyTag = document.getElementsByTagName("body"); // arrowImage 이미지 경로를 여기다가 추가해야한다.
		$(BodyTag).prepend('<div id = "backLayerDiv">'+
		'<div id = "guideTotal">'+
		'<div id = "positionAbsolute" style="position: absolute">'+
		'<div id = "guideImage"><img id = "mainImage" src = "/mainImage/GuideImage/myProject.png">'+''+'</img></div>'+
		'<div id = "ArrowBox">'+
		'<div id = "preventGuide"><img id = "preventImage" src = '+arrowImage[0]+'>'+''+'</img></div>'+
		'<div id = "nextGuide"><img id = "nextImage" src = '+arrowImage[1]+'>'+''+'</img></div></div>'+
		'</div><img src = "/mainImage/GuideImage/box.png"></div>'+
		'</div>');

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
		var leftOffset = $("#guideTotal").offset().left+($("#guideTotal").width()-$("#positionAbsolute").width())/2
		var topOffset = $("#guideTotal").offset().top+($("#guideTotal").height()-$("#positionAbsolute").height())/2

			console.log($("#guideTotal").width())
			console.log($("#guideTotal").width())
			console.log($("#positionAbsolute").width())
			console.log($("guideTotal").width())
			$("#positionAbsolute").css('left',leftOffset).css('top',topOffset)

		$(window).resize(function(){
			var width = $(BodyTag[0]).width()
			var height = $(BodyTag[0]).height()
      $("#backLayerDiv").width(width).height(height);
			$("#guideTotal").css('margin-left',$(selector).offset().left-400).css('margin-top',$(selector).offset().top+200)
   });

	 $("#guideTotal").click(function(event){
		 	event.stopPropagation();
	 })

	 $("#backLayerDiv").click(function(){
		 	$(this).remove()

	 });


	}

}

 jQuery(document).ready(function($) {
	
	//On Tab Title Click Show The Content Div
	$('.est-content-slider-title h2').on('click', function(){

		if($(".est-slider-content").hasClass("est-content-hidden")){
		  $(".est-slider-content").removeClass('est-content-hidden');
		  $(".est-slider-content").addClass('est-content-show');
		}
		else{  // if click garda est-content-hidden chaina bhane
		  $(".est-slider-content").addClass('est-content-hidden');
		  $(".est-slider-content").removeClass('est-content-show');
		}

	});

	//On Close Button Click Dismiss The Content Div
	$('span.est-close-slider-content').on( 'click', function(){
		if($('.est-slider-content').hasClass('est-content-hidden'))
		{
			$(".est-slider-content").removeClass('est-content-show');
			$(".est-slider-content").addClass('est-content-hidden');	
		}
		else
		{
			$(".est-slider-content").addClass('est-content-hidden');
		  	$(".est-slider-content").removeClass('est-content-show');	
		}
	});


	//Hide Or Show Tab on Mobile Device
	if( $("#est-front-display-wrap").hasClass( "est-mobile-display-on" ) ) 
    {
		var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
	    if (mobile) 
	    { 
	        //alert("MOBILE DEVICE!!");
	        $("#est-front-display-wrap").show();// OR you can use $('.navWrap').css('display', 'block');
	    } 
	    else{
	    	$("#est-front-display-wrap").show();// OR you can use $('.navWrap').css('display', 'none');
	    }
	}
	else
	{
		var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
	    if (mobile) 
	    { 
	        //alert("MOBILE DEVICE!!");
	        $("#est-front-display-wrap").hide();// OR you can use $('.navWrap').css('display', 'block');
	    } 
	    else{
	    	$("#est-front-display-wrap").show();// OR you can use $('.navWrap').css('display', 'none');
	    }
	}


	
});

(function($){
        $(window).on("load",function(){
            $(".est-content-slider .est-slider-content-inner-wrap").mCustomScrollbar({
			    theme:"dark"
			});
        });
    })(jQuery);
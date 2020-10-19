jQuery(document).ready(function($) {
	
	// $('#est-tab-settings').show();
	
	$('div.est-nav-tab-wrapper a').click(function(){
		var tab_id = $(this).attr('data-tab');
		$('.est-content').hide();
		$('div.est-nav-tab-wrapper a').removeClass('est-nav-tab-active');
		$(this).addClass('est-nav-tab-active');
		$("#"+tab_id).show();
	});
	
	//show fields according to Link Type (Internal External and contentSlider)
	$('.est-link-type').on('click', function(){
	  if($(this).val() == 'internal') {
	    $('#est-internal-tab').show();
	    $('#est-external-tab').hide();
	    $('#est-contentSlider-type').hide();
	  }
	  else if($(this).val() == 'external'){
	  	$('#est-external-tab').show();	
	  	$('#est-internal-tab').hide();
	  	$('#est-contentSlider-type').hide();
	  }
	  else if($(this).val() == 'content_slider'){
	    $('#est-contentSlider-type').show();   
	    $('#est-external-tab').hide();
	    $('#est-internal-tab').hide();
	  }
	  else{
	  	return false;
	  }
	});

	//Customize Layout Hide Show on Customize box checked/unchecked
	$('#est-customize_layout_select').on('click',function(){
		if($(this).is(':checked'))
		{
			$('#est-customize-fields-show').show();
		}
		else
		{
			$('#est-customize-fields-show').hide();
		}
	});


	//display settings for template image
    $div_select = $('#est-display-settings-wrap');
	$div_select.on('change', '.est-image-selector', function () {
        var selected_tmp_img = $(this).find('option:selected').data('img');
        $(this).closest('#est-display-settings-wrap').find('.est-layout-template-image img').attr('src', selected_tmp_img);
    });

	$('.color-field').wpColorPicker();

	//display content slider bgcolor and text color option
	$('.est-link-type').change(function(){ 
            
            var option = $(this).val();
            // alert(option);

            if(option == 'content_slider'){
            	$('.est-content-slider-dynamic-options').show();
            }else{
            	$('.est-content-slider-dynamic-options').hide();
            }
    });

 

    //validation
    var error1 = false;
    var error2 = false;
    // var error3 = false;

    jQuery("#est-tab-title input[type='text']").on("change keyup",function(){
    	
		if (jQuery(this).val().length !=0) 
		{
			
			jQuery(this).parent().children("span").remove();
			error1 = false;
		}
	});

	jQuery("#est-tab-text input[type='text']").on("change keyup",function(){
    	
		if (jQuery(this).val().length !=0) 
		{
			
			jQuery(this).parent().children("span").remove();
			error2 = false;
		}
	});


	jQuery("#main-form").on("submit",function(event){
		
		var tab_title = jQuery("#est-tab-title input[type='text']").val().trim(); 
		var tab_text = jQuery("#est-tab-text input[type='text']").val().trim(); 
		//var tab_content = jQuery("#est-tab-content textarea#est-content").val().trim(); 

		if (tab_title.length == 0) 
		{
			jQuery("#est-tab-title input[type='text']").parent().children("span").remove();
			jQuery("#est-tab-title input[type='text']").parent().append("<span style='color:red;'>This field should not be left empty</span>");
			error1 = true;
		}
		if (tab_text.length == 0) 
		{
			jQuery("#est-tab-text input[type='text']").parent().children("span").remove();
			jQuery("#est-tab-text input[type='text']").parent().append("<span style='color:red;'>This field should not be left empty</span>");
			error2 = true;
		}

		if (error1 || error2) 
		{
			event.preventDefault();
		}
		else
		{
			return;
		}
	});

	$('.est-field-wrap #est-enable-offset').on('change', function(){
		var $this = $(this);

		if($this.is(":checked"))
			$this.closest('.est-field-wrap').next().fadeIn();
			
		else
			$this.closest('.est-field-wrap').next().fadeOut();
	});

});
	
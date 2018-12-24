(function($) {
    	
        $(document).ready(function ($) {


        /* Image select option */

        $('body').on('click', 'img.herald-img-select', function(e){
            e.preventDefault();
            $(this).closest('ul').find('img.herald-img-select').removeClass('selected');
            $(this).addClass('selected');
             $(this).closest('ul').find('input').removeAttr('checked');
                $(this).closest('li').find('input').attr('checked','checked');

            if($(this).closest('ul').hasClass('herald-next-hide')){
                var v = $(this).closest('li').find('input:checked').val();
                if(v == 'inherit' || v == 'none'){
                     $(this).closest('.form-field').next().fadeOut(400);
                } else {
                    $(this).closest('.form-field').next().fadeIn(400);
                }
            }
        });

        /* Show/hide */
        $('body').on('click', '.herald-next-hide:not(ul)', function(e){
            var v = $(this).val();
            if(v == 'inherit' || v == 'none'){
                $(this).closest('.form-field').next().fadeOut(400);
            } else {
                $(this).closest('.form-field').next().fadeIn(400);
            }
        });

    	/* Color picker metabox handle */
    	
    	if($('.herald-colorpicker').length){
    		$('.herald-colorpicker').wpColorPicker();

    		$('a.herald-rec-color').click(function(e){
    			e.preventDefault();
    			$('.herald-colorpicker').val($(this).attr('data-color'));
    			$('.herald-colorpicker').change();
    		});	
    	}

    	herald_toggle_color_picker();
    	
    	$("body").on("click", "input.color-type", function(e){
			herald_toggle_color_picker();
		});

      		   
    	function herald_toggle_color_picker(){
    		var picker_value = $('input.color-type:checked').val();
    		if(picker_value == 'custom'){
    			$('#herald-color-wrap').show();
    		} else {
    			$('#herald-color-wrap').hide();
    		}


        }
        
        /* Image upload */
        var meta_image_frame;

        $('body').on('click', '#herald-image-upload', function(e) {

            e.preventDefault();

            if (meta_image_frame) {
                meta_image_frame.open();
                return;
            }

            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: 'Choose your image',
                button: {
                    text: 'Set Category image'
                },
                library: {
                    type: 'image'
                }
            });

            meta_image_frame.on('select', function() {

                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                $('#herald-image-url').val(media_attachment.url);
                $('#herald-image-preview').attr('src', media_attachment.url);
                $('#herald-image-preview').show();
                $('#herald-image-clear').show();

            });

            meta_image_frame.open();
        });


        $('body').on('click', '#herald-image-clear', function(e) {
            $('#herald-image-preview').hide();
            $('#herald-image-url').val('');
            $(this).hide();
        });

    });
    	
})(jQuery);
( function( $ ) {

	'use strict'; 

	jQuery(document).ready( function($) {

	  function mediaUpload(buttonClass) {

	    var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;

	    $('body').on('click', buttonClass, function(e) {

	      var buttonID = '#' + $(this).attr('id');
	      var button = $(buttonID);
				var send_attachment_bkp = wp.media.editor.send.attachment;
	      var id = button.attr('id').replace('_button', '');
				var mySize = $(this).data('size');

	      _custom_media = true;

	      wp.media.editor.send.attachment = function(props, attachment) {
	        if ( _custom_media  ) {
						var myAttachment = attachment.sizes[mySize];

						if ( typeof myAttachment == 'undefined' ) {
							myAttachment = attachment.sizes['full'];
						}

						$('.northninja_media_id').val(attachment.id);
	        	$('#' + id).val(myAttachment.url);
	        	$('.northninja_media_image').attr('src', myAttachment.url).parent().css('display', 'block');

					} else {
			    	return _orig_send_attachment.apply( buttonID, [props, attachment] );
					}
	      }

	      wp.media.editor.open(button);
	      return false;
	    });

			$('body').on('click', '.northninja_remove_media', function(e) {
				var id = $(this).data('remove');

				$('#' + id).val('');
				$(this).parent().css('display', 'none');
				return false;
			});

			$('#addtag').submit(function(e) {
				if ( ! $(this).closest('form').children('div').hasClass('form-invalid') ) {
					$('.northninja_media_preview').css('display', 'none');
				}
			});

	  }

		mediaUpload('.northninja_upload_media_button');
	});

} ) ( jQuery );
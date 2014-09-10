(function($){
	Drupal.behaviors.metamorph_presets = {
		attach: function(context,settings) {
			var presets = settings.metamorph_presets;
			var current_preset = 0;
			var farb = $.farbtastic('#placeholder');
			$('#edit-metamorph-presets-list').change(function(){
				current_preset = $(this).val();
        $('#edit-metamorph-preset-key').val(presets[current_preset].key);
        $('#edit-metamorph-base-color').val(presets[current_preset].base_color);
				$('#edit-metamorph-link-color').val(presets[current_preset].link_color);
				$('#edit-metamorph-link-hover-color').val(presets[current_preset].link_hover_color);
				$('#edit-metamorph-text-color').val(presets[current_preset].text_color);
				$('#edit-metamorph-heading-color').val(presets[current_preset].heading_color);
				$('.color').each(function(){
					farb.linkTo(this);
				});
			}).change().change(function(){
				$('.preset-option').trigger('change');
			});
			$('.color').focus(function(){
				$('#edit-preset-settings .form-item').removeClass('focus');
				$(this).parents('.form-item').addClass('focus');
				farb.linkTo(this);
			});
			$('.preset-option').change(function(){
				presets[current_preset][$(this).data('property')] = $(this).val();
			});
			$('form#system-theme-settings').submit(function () {
				$('input[name=metamorph_presets]').val(base64Encode(JSON.stringify(presets)));
			});
		}
	};
})(jQuery)

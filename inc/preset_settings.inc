<?php

function metamorph_preset_settings_form_alter(&$form){
	drupal_add_js(drupal_get_path('theme','metamorph').'/admin/js/farbtastic.js');
	drupal_add_js(drupal_get_path('theme','metamorph').'/admin/js/presets.js');
	drupal_add_css(drupal_get_path('theme','metamorph').'/admin/css/farbtastic.css');
	$theme = metamorph_get_theme();
	$presets = $theme->presets;
	if(empty($presets)){
		$presets = array(
			'metamorph_presets' => array(
				array(
					'key' => 'preset1',
					'base_color' => '#0072b9',
					'text_color' => '#494949',
					'link_color' => '#027ac6',
					'link_hover_color' => '#027ac6',
					'heading_color' => '#2385c2',
				),
				array(
					'key' => 'preset2',
					'base_color' => '#464849',
					'text_color' => '#494949',
					'link_color' => '#2f416f',
					'link_hover_color' => '#2f416f',
					'heading_color' => '#2a2b2d',
				),
				array(
					'key' => 'preset3',
					'base_color' => '#55c0e2',
					'text_color' => '#696969',
					'link_color' => '#000000',
					'link_hover_color' => '#000000',
					'heading_color' => '#085360',
				),
				array(
					'key' => 'preset4',
					'base_color' => '#d5b048',
					'text_color' => '#494949',
					'link_color' => '#6c420e',
					'link_hover_color' => '#6c420e',
					'heading_color' => '#331900',
				),
				array(
					'key' => 'preset5',
					'base_color' => '#3f3f3f',
					'text_color' => '#000000',
					'link_color' => '#336699',
					'link_hover_color' => '#336699',
					'heading_color' => '#6598cb',
				),
				array(
					'key' => 'preset6',
					'base_color' => '#d0cb9a',
					'text_color' => '#494949',
					'link_color' => '#917803',
					'link_hover_color' => '#917803',
					'heading_color' => '#efde01',
				)
			)
		);
	}else{
		$presets = array(
			'metamorph_presets' => $presets,
		);
	}
	drupal_add_js($presets,'setting');
	$preset_options = array();
	foreach($presets['metamorph_presets'] as $k=>$p){
		$p = (array)$p;
		$preset_options[] = $p['key'];
	}
	$form['preset_settings'] = array(
		'#type' => 'fieldset',
		'#title' => 'Presets',
		'#group' => 'metamorph_settings',
		'#weight' => 1
	);
	$form['preset_settings']['metamorph_presets'] = array(
		'#type' => 'hidden',
		'#default_value' => theme_get_setting('metamorph_presets'),
	);
	$form['preset_settings']['metamorph_default_preset'] = array(
		'#type' => 'select',
		'#title' => 'Default preset',
		'#options' => $preset_options,
		'#default_value' => $theme->get('metamorph_default_preset'),
		'#description' => 'Check to set this preset is default',
	);
	$form['preset_settings']['metamorph_presets_settings'] = array(
		'#type' => 'fieldset',
		'#title' => 'Preset settings',
		'#collapsible' => TRUE,
		'#collapsed' => TRUE,
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_presets_list'] = array(
		'#type' => 'select',
		'#title' => 'Presets',
		'#default_value' => $theme->preset,
		'#options' => $preset_options,
	);

	$default_preset = (array)$presets['metamorph_presets'][0];
	$form['preset_settings']['metamorph_presets_settings']['metamorph_preset_key'] = array(
		'#type' => 'textfield',
		'#title' => 'Preset name',
		'#default_value' => $default_preset['key'],
		'#description' => 'The css file generated based on this name. e.g: style-[preset_name].css',
		'#attributes' => array('data-property'=>'key','class'=>array('preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_base_color'] = array(
		'#type' => 'textfield',
		'#title' => 'Base color',
		'#default_value' => $default_preset['base_color'],
		'#attributes' => array('data-property'=>'base_color','class'=>array('color','preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_link_color'] = array(
		'#type' => 'textfield',
		'#title' => 'Link color',
		'#default_value' => $default_preset['link_color'],
		'#attributes' => array('data-property'=>'link_color','class'=>array('color','preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_link_hover_color'] = array(
		'#type' => 'textfield',
		'#title' => 'Link hover color',
		'#default_value' => $default_preset['link_hover_color'],
		'#attributes' => array('data-property'=>'link_hover_color','class'=>array('color','preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_text_color'] = array(
		'#type' => 'textfield',
		'#title' => 'Text color',
		'#default_value' => $default_preset['text_color'],
		'#attributes' => array('data-property'=>'text_color','class'=>array('color','preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_heading_color'] = array(
		'#type' => 'textfield',
		'#title' => 'Headding color',
		'#default_value' => $default_preset['heading_color'],
		'#attributes' => array('data-property'=>'heading_color','class'=>array('color','preset-option')),
	);
	$form['preset_settings']['metamorph_presets_settings']['metamorph_link_picker'] = array(
		'#markup' => '<div id="placeholder"></div>',
	);
}

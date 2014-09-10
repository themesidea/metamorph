<?php
require_once dirname(__FILE__) . '/includes/core.php';
require_once dirname(__FILE__) . '/inc/layout_settings.inc';
require_once dirname(__FILE__) . '/inc/preset_settings.inc';
require_once dirname(__FILE__) . '/inc/basic_settings.inc';
/**
 * Implements hook_form_system_theme_settings_alter()
 */
function metamorph_form_system_theme_settings_alter(&$form,&$form_state,$form_id = NULL) {
	$theme_key = arg(3);
	if(file_exists(drupal_get_path('theme',$theme_key).'/template.php')){
		require_once drupal_get_path('theme',$theme_key).'/template.php';
	}
	$theme = metamorph_get_theme();
	$form['metamorph_settings'] = array(
		'#type' => 'vertical_tabs',
    '#weight' => -10,
    '#prefix' => t('<div id="ti-header"><h2 id="theme-name">MetaMorph <small>Framework v 1.0.0</small><span class="mm-framework"><a href="http://themesidea.co.uk" target="_blank">by Themes Idea</a></span></h2></div>'),
	);
	$form['drupal_core_settings'] = array(
		'#type' => 'fieldset',
		'#title' => 'Drupal core',
		'#group' => 'metamorph_settings',
		'#weight' => 99,
	);
	$form['drupal_core_settings']['theme_settings'] = $form['theme_settings'];
	$form['drupal_core_settings']['logo'] = $form['logo'];
	$form['drupal_core_settings']['favicon'] = $form['favicon'];
	unset($form['theme_settings']);
	unset($form['logo']);
	unset($form['favicon']);
	metamorph_layout_settings_form_alter($form);
	metamorph_preset_settings_form_alter($form);
	metamorph_basic_settings_form_alter($form);
	$form['#submit'][] = 'metamorph_form_system_theme_settings_submit';
	$form['#submit'][] = 'metamorph_form_system_theme_settings_submit';
}

function metamorph_form_system_theme_settings_submit(&$form,&$form_state){
	variable_set('metamorph_settings_updated',REQUEST_TIME);
}

<?php

function metamorph_basic_settings_form_alter(&$form) {
  $form['basic_settings'] = array(
      '#type' => 'fieldset',
      '#title' => 'Basic',
      '#group' => 'metamorph_settings',
      '#weight' => 2
  );
  $form['basic_settings']['metamorph_layout'] = array(
      '#type' => 'select',
      '#title' => t('Layout'),
      '#options' => array('wide' => 'Wide', 'boxed' => 'Boxed'),
      '#default_value' => theme_get_setting('metamorph_layout')
  );
  $form['basic_settings']['metamorph_direction'] = array(
      '#type' => 'select',
      '#title' => t('Direction'),
      '#options' => array('ltr' => 'LTR', 'rtl' => 'RTL'),
      '#default_value' => theme_get_setting('metamorph_direction')
  );
  $form['basic_settings']['metamorph_ga_analytics'] = array(
      '#type' => 'textarea',
      '#title' => t('Google Analytics Code'),
      '#description'=>t('Paste your GA code without &lt;script&gt; and &lt;/script&gt; tags'),
      '#default_value' => theme_get_setting('metamorph_ga_analytics')
  );
  $form['basic_settings']['metamorph_wrapper_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom HTML class'),
      '#description'=>t('Provides this text as an additional body class (in $classes in html.tpl.php) when this section is active.'),
      '#default_value' => theme_get_setting('metamorph_wrapper_class')
  );
}

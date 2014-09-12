<?php
  require_once dirname(__FILE__) . '/includes/core.php';
  require_once dirname(__FILE__) . '/includes/lessc.php';
  require_once dirname(__FILE__) . '/includes/form.inc';


  function metamorph_default_layouts(){
    return 'W3sia2V5IjoiZGVmYXVsdCIsInRpdGxlIjoiRGVmYXVsdCIsInNlY3Rpb25zIjpbeyJrZXkiOiJoZWFkZXIiLCJ0aXRsZSI6IkhlYWRlciIsIndlaWdodCI6MCwiZnVsbHdpZHRoIjoibm8iLCJiYWNrZ3JvdW5kY29sb3IiOiIiLCJzdGlja3kiOmZhbHNlLCJ2cGhvbmUiOmZhbHNlLCJ2dGFibGV0IjpmYWxzZSwidmRlc2t0b3AiOmZhbHNlLCJocGhvbmUiOmZhbHNlLCJodGFibGV0IjpmYWxzZSwiaGRlc2t0b3AiOmZhbHNlLCJyZWdpb25zIjpbeyJrZXkiOiJoZWFkZXIiLCJ0aXRsZSI6IkhlYWRlciIsIndlaWdodCI6MCwiY29seHMiOiIxMiIsImNvbHNtIjoiMTIiLCJjb2xtZCI6IjEyIiwiY29sbGciOiIxMiJ9XX0seyJrZXkiOiJwcmVmYWNlIiwidGl0bGUiOiJQcmVmYWNlIiwid2VpZ2h0IjoxLCJmdWxsd2lkdGgiOiJubyIsImJhY2tncm91bmRjb2xvciI6IiIsInN0aWNreSI6ZmFsc2UsInZwaG9uZSI6ZmFsc2UsInZ0YWJsZXQiOmZhbHNlLCJ2ZGVza3RvcCI6ZmFsc2UsImhwaG9uZSI6ZmFsc2UsImh0YWJsZXQiOmZhbHNlLCJoZGVza3RvcCI6ZmFsc2UsInJlZ2lvbnMiOlt7ImtleSI6InByZWZhY2VfZmlyc3QiLCJ0aXRsZSI6IlByZWZhY2UgMSIsIndlaWdodCI6MCwiY29seHMiOiIxMiIsImNvbHNtIjoiNiIsImNvbG1kIjoiMyIsImNvbGxnIjoiMyJ9LHsgImtleSI6InByZWZhY2Vfc2Vjb25kIiwidGl0bGUiOiJQcmVmYWNlIDIiLCAid2VpZ2h0IjoxLCJjb2x4cyI6IjEyIiwiY29sc20iOiI2IiwiY29sbWQiOiIzIiwiY29sbGciOiIzIn0seyJrZXkiOiJwcmVmYWNlX3RoaXJkIiwidGl0bGUiOiJQcmVmYWNlIDMiLCJ3ZWlnaHQiOjIsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjYiLCJjb2xtZCI6IjMiLCJjb2xsZyI6IjMifSx7ImtleSI6InByZWZhY2VfZm91cnRoIiwidGl0bGUiOiJQcmVmYWNlIDQiLCJ3ZWlnaHQiOjMsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjYiLCJjb2xtZCI6IjMiLCJjb2xsZyI6IjMifV19LHsia2V5IjoiY29yZSIsInRpdGxlIjoiQ29yZSIsIndlaWdodCI6MiwiZnVsbHdpZHRoIjoibm8iLCJiYWNrZ3JvdW5kY29sb3IiOiIiLCJzdGlja3kiOmZhbHNlLCJ2cGhvbmUiOmZhbHNlLCJ2dGFibGV0IjpmYWxzZSwidmRlc2t0b3AiOmZhbHNlLCJocGhvbmUiOmZhbHNlLCJodGFibGV0IjpmYWxzZSwiaGRlc2t0b3AiOmZhbHNlLCJyZWdpb25zIjpbeyJrZXkiOiJoaWdobGlnaHRlZCIsInRpdGxlIjoiSGlnaGxpZ2h0ZWQiLCJ3ZWlnaHQiOjAsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjEyIiwiY29sbWQiOiIxMiIsImNvbGxnIjoiMTIifSx7ImtleSI6ImZlYXR1cmVkIiwidGl0bGUiOiJGZWF0dXJlZCIsIndlaWdodCI6MCwiY29seHMiOiIxMiIsImNvbHNtIjoiMTIiLCJjb2xtZCI6IjEyIiwiY29sbGciOiIxMiJ9XX0seyJrZXkiOiJtYWluIiwidGl0bGUiOiJNYWluIiwid2VpZ2h0IjozLCJmdWxsd2lkdGgiOiJubyIsImJhY2tncm91bmRjb2xvciI6IiIsInN0aWNreSI6ZmFsc2UsInZwaG9uZSI6ZmFsc2UsInZ0YWJsZXQiOmZhbHNlLCJ2ZGVza3RvcCI6ZmFsc2UsImhwaG9uZSI6ZmFsc2UsImh0YWJsZXQiOmZhbHNlLCJoZGVza3RvcCI6ZmFsc2UsInJlZ2lvbnMiOlt7ICJrZXkiOiJzaWRlYmFyX2ZpcnN0IiwidGl0bGUiOiJMZWZ0IHNpZGViYXIiLCJ3ZWlnaHQiOjAsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjEyIiwiY29sbWQiOiIzIiwgImNvbGxnIjoiMyIgfSx7ImtleSI6ImNvbnRlbnQiLCJ0aXRsZSI6IkNvbnRlbnQiLCJ3ZWlnaHQiOjEsICJjb2x4cyI6IjEyIiwgImNvbHNtIjoiMTIiLCJjb2xtZCI6IjYiLCAiY29sbGciOiI2In0seyJrZXkiOiJzaWRlYmFyX3NlY29uZCIsInRpdGxlIjoiUmlnaHQgc2lkZWJhciIsIndlaWdodCI6MiwiY29seHMiOiIxMiIsImNvbHNtIjoiMTIiLCJjb2xtZCI6IjMiLCAiY29sbGciOiIzIn1dfSx7ImtleSI6InBvc3RzY3JpcHQiLCJ0aXRsZSI6IlBvc3RzY3JpcHQiLCJ3ZWlnaHQiOjQsImZ1bGx3aWR0aCI6Im5vIiwiYmFja2dyb3VuZGNvbG9yIjoiIiwic3RpY2t5IjpmYWxzZSwidnBob25lIjpmYWxzZSwidnRhYmxldCI6ZmFsc2UsInZkZXNrdG9wIjpmYWxzZSwiaHBob25lIjpmYWxzZSwiaHRhYmxldCI6ZmFsc2UsImhkZXNrdG9wIjpmYWxzZSwicmVnaW9ucyI6W3sia2V5IjoicG9zdHNjcmlwdF9maXJzdCIsInRpdGxlIjoiUG9zdHNjcmlwdCAxIiwid2VpZ2h0IjowLCJjb2x4cyI6IjEyIiwiY29sc20iOiI2IiwiY29sbWQiOiIzIiwiY29sbGciOiIzIn0seyJrZXkiOiJwb3N0c2NyaXB0X3NlY29uZCIsInRpdGxlIjoiUG9zdHNjcmlwdCAyIiwid2VpZ2h0IjoxLCJjb2x4cyI6IjEyIiwiY29sc20iOiI2IiwiY29sbWQiOiIzIiwiY29sbGciOiIzIn0seyJrZXkiOiJwb3N0c2NyaXB0X3RoaXJkIiwidGl0bGUiOiJQb3N0c2NyaXB0IDMiLCJ3ZWlnaHQiOjIsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjYiLCJjb2xtZCI6IjMiLCJjb2xsZyI6IjMifSx7ImtleSI6InBvc3RzY3JpcHRfZm91cnRoIiwidGl0bGUiOiJQb3N0c2NyaXB0IDQiLCJ3ZWlnaHQiOjMsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjYiLCJjb2xtZCI6IjMiLCJjb2xsZyI6IjMifV19LHsia2V5IjoiZm9vdGVyIiwidGl0bGUiOiJGb290ZXIiLCJ3ZWlnaHQiOjUsImZ1bGx3aWR0aCI6Im5vIiwiYmFja2dyb3VuZGNvbG9yIjoiIiwic3RpY2t5IjpmYWxzZSwidnBob25lIjpmYWxzZSwidnRhYmxldCI6ZmFsc2UsInZkZXNrdG9wIjpmYWxzZSwiaHBob25lIjpmYWxzZSwiaHRhYmxldCI6ZmFsc2UsImhkZXNrdG9wIjpmYWxzZSwicmVnaW9ucyI6W3sia2V5IjoiZm9vdGVyIiwidGl0bGUiOiJGb290ZXIiLCJ3ZWlnaHQiOjAsImNvbHhzIjoiMTIiLCJjb2xzbSI6IjEyIiwgImNvbG1kIjoiMTIiLCJjb2xsZyI6IjEyIn1dfSx7ImtleSI6InVuYXNzaWduZWQiLCJ0aXRsZSI6IlVuYXNzaWduZWQiLCJ3ZWlnaHQiOjYsImZ1bGx3aWR0aCI6Im5vIiwiYmFja2dyb3VuZGNvbG9yIjoiIiwic3RpY2t5IjpmYWxzZSwidnBob25lIjpmYWxzZSwidnRhYmxldCI6ZmFsc2UsInZkZXNrdG9wIjpmYWxzZSwiaHBob25lIjpmYWxzZSwiaHRhYmxldCI6ZmFsc2UsImhkZXNrdG9wIjpmYWxzZSwicmVnaW9ucyI6W3sia2V5IjoiaGVscCIsInRpdGxlIjoiSGVscCIsIndlaWdodCI6MCwiY29seHMiOjEyLCJjb2xzbSI6MTIsImNvbG1kIjo2LCJjb2xsZyI6Nn0seyJrZXkiOiJwYWdlX3RvcCIsInRpdGxlIjoiUGFnZSB0b3AiLCJ3ZWlnaHQiOjEsImNvbHhzIjoxMiwiY29sc20iOjEyLCJjb2xtZCI6NiwiY29sbGciOjYgfSx7ImtleSI6InBhZ2VfYm90dG9tIiwidGl0bGUiOiJQYWdlIGJvdHRvbSIsIndlaWdodCI6MiwiY29seHMiOjEyLCJjb2xzbSI6MTIsImNvbG1kIjo2LCJjb2xsZyI6NiB9LHsia2V5IjoiZGFzaGJvYXJkX21haW4iLCJ0aXRsZSI6IkRhc2hib2FyZCAobWFpbikiLCJ3ZWlnaHQiOjMsICJjb2x4cyI6MTIsImNvbHNtIjoxMiwiY29sbWQiOjYsImNvbGxnIjo2fSx7ImtleSI6ImRhc2hib2FyZF9zaWRlYmFyIiwidGl0bGUiOiJEYXNoYm9hcmQgKHNpZGViYXIpIiwid2VpZ2h0Ijo0LCJjb2x4cyI6MTIsImNvbHNtIjoxMiwiY29sbWQiOjYsImNvbGxnIjo2fSx7ImtleSI6ImRhc2hib2FyZF9pbmFjdGl2ZSIsInRpdGxlIjoiRGFzaGJvYXJkIChpbmFjdGl2ZSkiLCJ3ZWlnaHQiOjUsImNvbHhzIjoxMiwiY29sc20iOjEyLCJjb2xtZCI6NiwiY29sbGciOjZ9XX1dfV0==';
  }

  function metamorph_default_presets(){
    return 'W3sia2V5IjoiUHJlc2V0IDEiLCJiYXNlX2NvbG9yIjoiIzAwNzJiOSIsInRleHRfY29sb3IiOiIjNDk0OTQ5IiwibGlua19jb2xvciI6IiM1YWI1ZWUiLCJsaW5rX2hvdmVyX2NvbG9yIjoiIzAyN2FjNiIsImhlYWRpbmdfY29sb3IiOiIjMjM4NWMyIn0seyJrZXkiOiJQcmVzZXQgMiIsImJhc2VfY29sb3IiOiIjNTVjMGUyIiwidGV4dF9jb2xvciI6IiM2OTY5NjkiLCJsaW5rX2NvbG9yIjoiIzAwMDAwMCIsImxpbmtfaG92ZXJfY29sb3IiOiIjNTVjMGUyIiwiaGVhZGluZ19jb2xvciI6IiMwODUzNjAifSx7ImtleSI6IlByZXNldCAzIiwiYmFzZV9jb2xvciI6IiNkNWIwNDgiLCJ0ZXh0X2NvbG9yIjoiIzMzMTkwMCIsImxpbmtfY29sb3IiOiIjNmM0MjBlIiwibGlua19ob3Zlcl9jb2xvciI6IiM5NzE3MDIiLCJoZWFkaW5nX2NvbG9yIjoiIzQ5NDk0OSJ9LHsia2V5IjoiUHJlc2V0IDQiLCJiYXNlX2NvbG9yIjoiIzEyMDIwYiIsInRleHRfY29sb3IiOiIjODk4MDgwIiwibGlua19jb2xvciI6IiMxYjFhMTMiLCJsaW5rX2hvdmVyX2NvbG9yIjoiI2YzOTFjNiIsImhlYWRpbmdfY29sb3IiOiIjZjQxMDYzIn0seyJrZXkiOiJQcmVzZXQgNSIsImJhc2VfY29sb3IiOiIjZmZlMjNkIiwidGV4dF9jb2xvciI6IiM0OTQ5NDkiLCJsaW5rX2NvbG9yIjoiIzQ5NDk0OSIsImxpbmtfaG92ZXJfY29sb3IiOiIjYTkyOTBhIiwiaGVhZGluZ19jb2xvciI6IiNmYzZkMWQifSx7ImtleSI6IlByZXNldCA2IiwiYmFzZV9jb2xvciI6IiM3ODg1OTciLCJ0ZXh0X2NvbG9yIjoiIzcwNzA3MCIsImxpbmtfY29sb3IiOiIjM2Y3MjhkIiwibGlua19ob3Zlcl9jb2xvciI6IiM3ODg1OTciLCJoZWFkaW5nX2NvbG9yIjoiI2E5YWRiYyJ9LHsia2V5IjoiUHJlc2V0IDciLCJiYXNlX2NvbG9yIjoiIzViNWZhOSIsInRleHRfY29sb3IiOiIjNDk0OTQ5IiwibGlua19jb2xvciI6IiM1YjVmYWEiLCJsaW5rX2hvdmVyX2NvbG9yIjoiIzBhMjM1MiIsImhlYWRpbmdfY29sb3IiOiIjOWZhOGQ1In0seyJrZXkiOiJQcmVzZXQgOCIsImJhc2VfY29sb3IiOiIjN2RiMzIzIiwidGV4dF9jb2xvciI6IiMxOTFhMTkiLCJsaW5rX2NvbG9yIjoiIzZhOTkxNSIsImxpbmtfaG92ZXJfY29sb3IiOiIjYjVkNTJhIiwiaGVhZGluZ19jb2xvciI6IiM3ZGIzMjMifSx7ImtleSI6IlByZXNldCA5IiwiYmFzZV9jb2xvciI6IiNiN2EwYmEiLCJ0ZXh0X2NvbG9yIjoiIzUxNWQ1MiIsImxpbmtfY29sb3IiOiIjYzcwMDAwIiwibGlua19ob3Zlcl9jb2xvciI6IiNhMTQ0M2EiLCJoZWFkaW5nX2NvbG9yIjoiI2ExNDQzYSJ9LHsia2V5IjoiUHJlc2V0IDEwIiwiYmFzZV9jb2xvciI6IiMxODU4M2QiLCJ0ZXh0X2NvbG9yIjoiIzJkMmQyZCIsImxpbmtfY29sb3IiOiIjMWI1ZjQyIiwibGlua19ob3Zlcl9jb2xvciI6IiM1MmJmOTAiLCJoZWFkaW5nX2NvbG9yIjoiIzM0Nzc1YSJ9XQ';
  }

  /**
   * Implements hook_theme
   */
  function metamorph_theme($existing, $type, $theme, $path) {
    return array(
      'metamorph-section' => array(
        'template' => 'section',
        'path' => $path . '/templates/base',
        'render element' => 'elements',
        'pattern' => 'section__',
        'preprocess functions' => array(
          'template_preprocess',
          'template_preprocess_section',
        ),
        'process functions' => array(
          'template_process',
          'template_process_section',
        ),
      )
    );
  }

  function template_preprocess_section(&$vars) {
    $section = $vars['section'];
    $vars['theme_hook_suggestions'][] = 'section__' . $section->key;
    if(isset($section->sticky) && $section->sticky){
      $vars['classes_array'][] = 'metamorph-sticky';
      drupal_add_js(drupal_get_path('theme', 'metamorph') . '/assets/js/metamorph-sticky.js');
    }
    if(isset($section->colpadding) && $section->colpadding != '' && $section->colpadding != 15 && $section->colpadding >= 0){
      $vars['attributes_array']['data-padding'] = $section->colpadding;
      $vars['classes_array'][] = 'custompadding';
    }
    if(isset($section->custom_class) && $section->custom_class != ''){
      $vars['classes_array'][] = $section->custom_class;
    }
    if(isset($section->hphone) && $section->hphone){
      $vars['classes_array'][] = 'hidden-xs';
    }
    if(isset($section->htablet) && $section->htablet){
      $vars['classes_array'][] = 'hidden-sm';
    }
    if(isset($section->hdesktop) && $section->hdesktop){
      $vars['classes_array'][] = 'hidden-md';
      $vars['classes_array'][] = 'hidden-lg';
    }
    if(isset($section->vphone) && $section->vphone){
      $vars['classes_array'][] = 'visible-xs';
    }
    if(isset($section->vtablet) && $section->vtablet){
      $vars['classes_array'][] = 'visible-sm';
    }
    if(isset($section->vdesktop) && $section->vdesktop){
      $vars['classes_array'][] = 'visible-md';
      $vars['classes_array'][] = 'visible-lg';
    }
    $vars['container_class'] = $section->fullwidth == 'no'?'container':'metamorph-container';
    $vars['attributes_array']['class'] = $vars['classes_array'];
    $vars['attributes_array']['id'] = drupal_html_id('section-' . $section->key);
    if(isset($section->backgroundcolor) && $section->backgroundcolor){
      $vars['attributes_array']['style'] = "background-color:{$section->backgroundcolor}";
    }
  }
  /**
   * Implement hook_page_alter
   */
  function metamorph_page_alter(&$page){
    $regions = system_region_list($GLOBALS['theme'], REGIONS_ALL);
    foreach ($regions as $region => $name) {
      switch ($region){
        case 'title':
          if(empty($page[$region])){
            $page[$region] = array(
              'block_title'=> array(
                '#markup'=>''
              ),
              '#region'=>$region,
              '#theme_wrappers' => array('region')
            );
          }
          break;
      }
    }
  }

  /**
   * Implement hook_preprocess_page
   */
  function metamorph_preprocess_page(&$page){
    $theme = metamorph_get_theme();
    $theme->page = &$page;
  }

  /**
   * Implement hook_preprocess_html
   */
  function metamorph_preprocess_html(&$vars) {
    drupal_add_css(drupal_get_path('theme', 'metamorph') . '/assets/css/metamorph.css');
    drupal_add_css(drupal_get_path('theme', 'metamorph') . '/vendor/bootstrap/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme', 'metamorph') . '/vendor/font-awesome/css/font-awesome.min.css');
    drupal_add_js(drupal_get_path('theme', 'metamorph') . '/vendor/bootstrap/js/bootstrap.min.js');
    drupal_add_js(drupal_get_path('theme', 'metamorph') . '/assets/js/smoothscroll.js');
    drupal_add_js(drupal_get_path('theme', 'metamorph') . '/assets/js/metamorph-custompadding.js');
    require_once dirname(__FILE__).'/includes/lessc.php';
    $theme = metamorph_get_theme();
    $direction = null;
    if (isset($_SESSION['metamorph_default_direction'])) {
      $direction = $_SESSION['metamorph_default_direction'];
    }
    if(empty($direction)){
      $direction = $theme->get('metamorph_direction');
    }
    if(empty($direction)){
      $direction = 'ltr';
    }
    if($direction == 'rtl' ||  module_exists('metamorph_quicksettings')){
      drupal_add_css(drupal_get_path('theme', 'metamorph') . '/assets/css/metamorph-rtl.css');
    }
    $_SESSION['metamorph_default_direction'] = $direction;
    $layout = theme_get_setting('metamorph_layout');
    $vars['classes_array'][] = $direction;
    $vars['classes_array'][] = $layout;
    $vars['classes_array'][] = $theme->get('metamorph_wrapper_class');
    $less = new metamorph_lessc($theme);
    $preset_key = strtolower($theme->presets[$theme->preset]->key);
    $preset_key = preg_replace('/[^a-z0-9]/s','',$preset_key);
    $css_file = drupal_get_path('theme',$theme->theme).'/assets/css/style-'.$preset_key.'.css';
    $less->complie($css_file);
    drupal_add_css($css_file);
    //Google Analytics
    $ga_code = $theme->get('metamorph_ga_analytics');
    if(!empty($ga_code)){
      drupal_add_js($ga_code,'inline');
    }
  }

  /**
   * Implement hook_preprocess_region
   */
  function metamorph_preprocess_region(&$vars) {
    $theme = metamorph_get_theme();
    $region_key = $vars['elements']['#region'];
    $region = $theme->getRegion($region_key);
    if($region){
      $vars['classes_array'][] = 'col-xs-'.$region->colxs;
      $vars['classes_array'][] = 'col-sm-'.$region->colsm;
      $vars['classes_array'][] = 'col-md-'.$region->colmd;
      $vars['classes_array'][] = 'col-lg-'.$region->collg;
    }
  }
  /**
   * Implement hook_process_region
   */
  function metamorph_process_region(&$vars) {
    $theme = metamorph_get_theme();
    switch ($vars['elements']['#region']) {
      case 'content':
        $vars['messages'] = $theme->page['messages'];
        $vars['title_prefix'] = $theme->page['title_prefix'];
        $vars['title'] = $theme->page['title'];
        $vars['title_suffix'] = $theme->page['title_suffix'];
        $vars['tabs'] = $theme->page['tabs'];
        $vars['action_links'] = $theme->page['action_links'];
        $vars['feed_icons'] = $theme->page['feed_icons'];
        $vars['breadcrumb'] = $theme->page['breadcrumb'];
        break;
      case 'logo':
        $vars['logo'] = $theme->page['logo'];
        $vars['logo_img'] = !is_null($vars['logo']) ? '<img src="' . $vars['logo'] . '" id="logo"/>' : '';
        $vars['linked_logo'] = !is_null($vars['logo']) ? l($vars['logo_img'], '<front>', array('html' => TRUE, 'attributes' => array('rel' => 'home'))) : '';
        break;
      case 'title':
        $vars['title_prefix'] = $theme->page['title_prefix'];
        $vars['title'] = $theme->page['title'];
        $vars['title_suffix'] = $theme->page['title_suffix'];
        break;
    }
  }

  /**
   * Implement hook_menu_local_tasks
   */
  function metamorph_menu_local_tasks(&$vars) {
    $output = '';

    if (!empty($vars['primary'])) {
      $vars['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
      $vars['primary']['#prefix'] = '<ul class="nav nav-tabs">';
      $vars['primary']['#suffix'] = '</ul>';
      $output .= drupal_render($vars['primary']);
    }

    if (!empty($vars['secondary'])) {
      $vars['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
      $vars['secondary']['#prefix'] = '<ul class="nav nav-pills">';
      $vars['secondary']['#suffix'] = '</ul>';
      $output .= drupal_render($vars['secondary']);
    }

    return $output;
  }

  /**
   * Implement hook_preprocess_node
   */
  function metamorph_preprocess_node(&$vars) {
    $node = $vars['node'];
    if($vars['view_mode'] != 'full'){
      $vars['theme_hook_suggestions'][] = 'node__' . $node->type . '__'.$vars['view_mode'];
      $vars['theme_hook_suggestions'][] = 'node__' . $node->nid . '__'.$vars['view_mode'];
    }
  }

  /**
   * Pager
   */
  function metamorph_pager($variables) {
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];
    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // current is the page we are currently paged to
    $pager_current = $pager_page_array[$element] + 1;
    // first is the first page listed by this pager piece (re quantity)
    $pager_first = $pager_current - $pager_middle + 1;
    // last is the last page listed by this pager piece (re quantity)
    $pager_last = $pager_current + $quantity - $pager_middle;
    // max is the maximum page number
    $pager_max = $pager_total[$element];
    // End of marker calculations.

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
      // Adjust "center" if at end of query.
      $i = $i + ($pager_max - $pager_last);
      $pager_last = $pager_max;
    }
    if ($i <= 0) {
      // Adjust "center" if at start of query.
      $pager_last = $pager_last + (1 - $i);
      $i = 1;
    }
    // End of generation loop preparation.

    $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
    $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

    if ($pager_total[$element] > 1) {
      if ($li_first) {
        $items[] = array(
          'class' => array('pager-first'),
          'data' => $li_first,
        );
      }
      if ($li_previous) {
        $items[] = array(
          'class' => array('pager-previous'),
          'data' => $li_previous,
        );
      }

      // When there is more than one page, create the pager list.
      if ($i != $pager_max) {
        if ($i > 1) {
          $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
          );
        }
        // Now generate the actual pager piece.
        for (; $i <= $pager_last && $i <= $pager_max; $i++) {
          if ($i < $pager_current) {
            $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
            );
          }
          if ($i == $pager_current) {
            $items[] = array(
              'class' => array('pager-current'),
              'data' => '<a href="#" title="Current page">'.$i.'</a>',
            );
          }
          if ($i > $pager_current) {
            $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
            );
          }
        }
        if ($i < $pager_max) {
          $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '<a href="#">…</a>',
          );
        }
      }
      // End generation.
      if ($li_next) {
        $items[] = array(
          'class' => array('pager-next'),
          'data' => $li_next,
        );
      }
      if ($li_last) {
        $items[] = array(
          'class' => array('pager-last'),
          'data' => $li_last,
        );
      }
      return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
        'items' => $items,
        'attributes' => array('class' => array('pagination')),
      ));
    }
  }

<?php
  /*! MetaMorph - v1.0.0 - 09-09-2014
  * http://themesidea.co.uk/
  * Copyright (c) 2014
  */

  function metamorph_layout_settings_form_alter(&$form){
    $theme = metamorph_get_theme();
    $metamorph_theme_path = drupal_get_path('theme','metamorph');
    $layouts = json_encode($theme->layouts);
    $regions = array();
    foreach($theme->getRegions() as $key=>$name){
      $region = new stdClass();
      $region->region = $key;
      $region->title = $name;
      $regions[] = $region;
    }

    $sections = array('header','banner');
    $sections = json_encode($sections);
    $regions = json_encode($regions);
    $js = <<<JS
	var metamorph_layouts = {$layouts};
	var metamorph_sections = {$sections};
	var metamorph_regions = {$regions};
JS;
    $coloptions = array(1=>'1 col',2=>'2 cols',3=>'3 cols',4=>'4 cols',5=>'5 cols',6=>'6 cols',7=>'7 cols',8=>'8 cols',9=>'9 cols',10=>'10 cols',11=>'11 cols',12=>'12 cols');
    $form['layout_settings'] = array(
      '#type' => 'fieldset',
      '#title' => 'Layouts',
      '#group' => 'metamorph_settings',
      '#weight' => 0
    );
    $form['layout_settings']['metamorph_layouts_edit'] = array(
      '#type' => 'container',
      '#title' => t('Edit layout'),
    );
    $form['layout_settings']['metamorph_layouts_edit']['layout_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#size' => ''
    );
    $form['layout_settings']['metamorph_layouts'] = array(
      '#type' => 'hidden',
      '#default_value' => base64_encode($layouts),
    );
    $form['layout_settings']['metamorph_layouts_ui'] = array(
      '#markup' => '<a href="#" class="metamorph-add-layout"><i class="fa fa-plus-circle"></i> Add layout</a><ul id="metamorph_layouts"></ul><ul id="metamorph_sections"></ul>',
    );

    $form['layout_settings']['metamorph_add_section'] = array(
      '#markup' => '<div id="metamorph_add_section"><a href="#"><i class="fa fa-plus-circle"></i> Add section</a></div>',
    );
    $form['layout_settings']['metamorph_add_section_dialog'] = array(
      '#markup' => '<div id="metamorph_add_section_dialog" title="Add section">Section: <input type="text" class="form-text" name="section_name"/></div>',
    );

    //Region settings
    $form['layout_settings']['metamorph_region_settings'] = array(
      '#type' => 'container',
      '#title' => t('Region settings'),
    );
    $form['layout_settings']['metamorph_region_settings']['cols'] = array(
      '#type' =>'fieldset',
      '#title' => 'Colunms',
    );
    $form['layout_settings']['metamorph_region_settings']['cols']['region_col_lg'] = array(
      '#type' => 'select',
      '#options' => $coloptions,
      '#field_prefix' => '<i class="fa fa-desktop"></i>',
    );
    $form['layout_settings']['metamorph_region_settings']['cols']['region_col_md'] = array(
      '#type' => 'select',
      '#options' => $coloptions,
      '#field_prefix' => '<i class="fa fa-laptop"></i>'
    );
    $form['layout_settings']['metamorph_region_settings']['cols']['region_col_sm'] = array(
      '#type' => 'select',
      '#options' => $coloptions,
      '#field_prefix' => '<i class="fa fa-tablet"></i>'
    );
    $form['layout_settings']['metamorph_region_settings']['cols']['region_col_xs'] = array(
      '#type' => 'select',
      '#options' => $coloptions,
      '#field_prefix' => '<i class="fa fa-mobile-phone"></i>'
    );

    //Section settings
    $form['layout_settings']['metamorph_section_settings'] = array(
      '#type' => 'container',
      '#title' => t('Section settings'),
    );
    $form['layout_settings']['metamorph_section_settings']['section_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Section'),
      '#size' => ''
    );
    $form['layout_settings']['metamorph_section_settings']['section_fullwidth'] = array(
      '#type' => 'select',
      '#title' => t('Full width'),
      '#options' => array('no' => 'No', 'yes' => 'Yes'),
    );
    $form['layout_settings']['metamorph_section_settings']['section_visible'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Visible'),
      '#options' => array(
        'vphone' => 'Visible Phone',
        'vtablet' => 'Visible Tablet',
        'vdesktop' => 'Visible Desktop',
        'hphone' => 'Hidden Phone',
        'htablet' => 'Hidden Tablet',
        'hdesktop' => 'Hiddeny Desktop',
      ),
    );
    $form['layout_settings']['metamorph_section_settings']['section_background_color'] = array(
      '#type' => 'textfield',
      '#title' => t('Background color'),
      '#size' =>''
    );
    $form['layout_settings']['metamorph_section_settings']['section_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sticky on top'),
      '#size' =>''
    );

    $form['layout_settings']['metamorph_section_settings']['section_custom_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom class'),
      '#size' =>''
    );
    $form['layout_settings']['metamorph_section_settings']['section_colpadding'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom column padding'),
      '#description' => t('Leave blank to use default bootstrap padding (15px)'),
      '#field_suffix' => 'px',
      '#size' =>''
    );
    $form['layout_settings']['metamorph_layout_pages'] = array(
      '#type' => 'textarea',
      '#title' => t('Pages Assignment'),
      '#description' => t('List of pages to apply this layout. Enter one path per line. The \'*\' character is a wildcard. Example paths are blog for the blog page and blog/* for every personal blog. &lt;front&gt; is the front page.'),
      '#size' =>''
    );
    $form['#attached'] = array(
      'css' => array(
        $metamorph_theme_path.'/admin/css/bootstrap.css',
        $metamorph_theme_path.'/vendor/font-awesome/css/font-awesome.min.css',
        $metamorph_theme_path.'/admin/css/admin.theme-settings.css'
      ),
      'js' => array(
        $js => array('type'=>'inline'),
        $metamorph_theme_path.'/admin/js/admin.metamorph.js',
      )
    );
    drupal_add_library('system', 'ui.draggable');
    drupal_add_library('system', 'ui.dropable');
    drupal_add_library('system', 'ui.sortable');
    drupal_add_library('system', 'ui.dialog');
  }

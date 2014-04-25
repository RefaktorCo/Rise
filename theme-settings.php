<?php

/**
 * Implements hook_form_system_theme_settings_alter()
 */
function rise_form_system_theme_settings_alter(&$form, &$form_state) {

  // Main settings wrapper
  $form['options'] = array(
    '#type' => 'vertical_tabs',
    '#default_tab' => 'defaults',
    '#weight' => '-10',
    
  );
  
  // Default Drupal Settings    
  $form['options']['drupal_default_settings'] = array(
		'#type' => 'fieldset',
		'#title' => t('Drupal Core Settings'),
	);
	
	  // "Toggle Display" 
		$form['options']['drupal_default_settings']['theme_settings'] = $form['theme_settings'];
		
		// "Unset default Toggle Display settings" 
		unset($form['theme_settings']);
		
		// "Logo Image Settings" 
		$form['options']['drupal_default_settings']['logo'] = $form['logo'];
		
		// "Unset default Logo Image Settings" 
		unset($form['logo']);
		
		// "Shortcut Icon Settings" 
		$form['options']['drupal_default_settings']['favicon'] = $form['favicon'];   
		
		// "Unset default Shortcut Icon Settings" 
		unset($form['favicon']);
		
  // General
  $form['options']['general'] = array(
    '#type' => 'fieldset',
    '#title' => t('General'),
  );
                
    // Color Schemes
    $form['options']['general']['color_scheme'] = array(
      '#type' => 'select',
      '#title' => t('Color Scheme'),
      '#options' => array (
        'light' => t('Light'),
        'dark' => t('Dark')
      ),
      '#default_value' => theme_get_setting('color_scheme'),
    );
    
    // Loader
    $form['options']['general']['loader'] = array(
      '#type' => 'checkbox',
      '#title' => t('Loader'),
      '#default_value' => theme_get_setting('loader'),
      '#description' => t('Check to enable the page loading graphic on the front page'),
    );
  
  // Post Meta
  $form['options']['meta'] = array(
    '#type' => 'fieldset',
    '#title' => t('Post Meta'),
  );
                
    // Meta Date
    $form['options']['meta']['meta_date'] = array(
      '#type' => 'checkbox',
      '#title' => t('Meta Date'),
      '#default_value' => theme_get_setting('meta_date'),
    );
    
    // Meta Author
    $form['options']['meta']['meta_author'] = array(
      '#type' => 'checkbox',
      '#title' => t('Meta Author'),
      '#default_value' => theme_get_setting('meta_author'),
    );   
    
    // Meta Date
    $form['options']['meta']['meta_tags'] = array(
      '#type' => 'checkbox',
      '#title' => t('Meta Tags'),
      '#default_value' => theme_get_setting('meta_tags'),
    );
    
  // CSS
  $form['options']['css'] = array(
    '#type' => 'fieldset',
    '#title' => t('CSS'),
  );
  
    // User CSS
    $form['options']['css']['user_css'] = array(
      '#type' => 'textarea',
      '#title' => t('Add your own CSS'),
      '#default_value' => theme_get_setting('user_css'),
    );  
}
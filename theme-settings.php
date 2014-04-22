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
                
    // Sticky Header
    $form['options']['general']['header_search'] = array(
      '#type' => 'checkbox',
      '#title' => t('Header Search'),
      '#default_value' => theme_get_setting('header_search'),
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
?>
<?php
/**
 * Define $root global variable.
 */
global $theme_root, $parent_root, $theme_path;
$theme_root = base_path() . path_to_theme();
$parent_root = base_path() . drupal_get_path('theme', 'rise');

require_once(drupal_get_path('theme', 'rise').'/includes/twitter.inc');

/**
 * Add list classes for links in "Header Menu" region.
 */
function rise_menu_link__site_navigation(array $variables) {
  $output = '';
  unset($variables['element']['#attributes']['class']);
  $element = $variables['element'];
  static $item_id = 0;
  $menu_name = $element['#original_link']['menu_name'];

  // set the global depth variable
  global $depth;
  $depth = $element['#original_link']['depth'];
  
  $sub_menu = $element['#below'] ? drupal_render($element['#below']) : '';
  $output .= l($element['#title'], $element['#href'], $element['#localized_options']);
  // if link class is active, make li class as active too
  if(strpos($output,"active")>0){
    $element['#attributes']['class'][] = "active";
  }
 
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . '</li>';
  
}

/**
 * Define class for first menu UL.
 */
function rise_menu_tree__site_navigation($variables){
  return '<ul class="navigation">' . $variables['tree'] . '</ul>';
  
}

/**
 * Define class for all other menu ULs.
 */
function rise_menu_tree__site_navigation_below($variables){
  return '<div class="dropdown"><ul>' . $variables['tree'] . '</ul></div>';
}

/**
 * Modify theme_js_alter()
 */
function rise_js_alter(&$js) {
  if (isset($js['misc/jquery.js'])) {
       $jsPath = 'https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js';
       $js['misc/jquery.js']['version'] = '2.0.2';
    $js['misc/jquery.js']['data'] = $jsPath;
  }
}

/**
 * Overrides theme_process_page().
 */
function rise_process_page($variables) {	
  // Assign site name and slogan toggle theme settings to variables.
  $variables['disable_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['disable_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
   // Assign site name/slogan defaults if there is no value.
  if ($variables['disable_site_name']) {
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['disable_site_slogan']) {
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}	

/**
 * Assign theme hook suggestions for custom templates.
 */  
function rise_preprocess_page(&$vars, $hook) {
  if (isset($vars['node'])) {
    $suggest = "page__node__{$vars['node']->type}";
    $vars['theme_hook_suggestions'][] = $suggest;
  }
  
  $status = drupal_get_http_header("status");  
  if($status == "404 Not Found") {      
    $vars['theme_hook_suggestions'][] = 'page__404';
  }
  
  if (arg(0) == 'taxonomy' && arg(1) == 'term' ){
    $term = taxonomy_term_load(arg(2));
    $vars['theme_hook_suggestions'][] = 'page--taxonomy--vocabulary--' . $term->vid;
  }
  
}

/**
 * Impelements hook_form_alter()
 */
function rise_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    
    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['class'] = array('search');
    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    
  }
} 

/**
 * Overrides theme_preprocess_username().
 */
function rise_preprocess_username(&$vars) {
  global $theme_key;
  $theme_name = $theme_key;
  
  // Add rel=author for SEO and supporting search engines
  if (isset($vars['link_path'])) {
    $vars['link_attributes']['rel'][] = 'author';
  }
  else {
    $vars['attributes_array']['rel'][] = 'author';
  }
}


/**
 * Implements hook_block_view_alter() for "Site Navigation" region.
 */
function rise_block_view_alter(&$data, $block) {

  if ( ($block->region == 'site_navigation') && (isset($data['subject'])) && ($data['subject'] != 'Rise Menu') ) {
    $data['content']['#theme_wrappers'] = array('menu_tree__site_navigation');
  }

  if ( ($block->region == 'site_navigation') && !isset($data['content']['#type']) && $block->module != 'rise_module' ) {   
    $data['content']['#theme_wrappers'] = array('menu_tree__site_navigation');

    foreach($data['content'] as &$key):
     
      if (isset($key['#theme'])) {
        $key['#theme'] = 'menu_link__site_navigation';
      }
      if (isset($key['#below']['#theme_wrappers'])) {
        $key['#below']['#theme_wrappers'] = array('menu_tree__site_navigation_below');
      }
      
      if (isset($key['#below'])) {
        foreach($key['#below'] as &$key2):
        
           if (isset($key2['#theme'])) {
             $key2['#theme'] = 'menu_link__site_navigation';
           }
           if (isset($key2['#below']['#theme_wrappers'])) {
             $key2['#below']['#theme_wrappers'] = array('menu_tree__site_navigation_below');
           }
           if (isset($key2['#below'])) {
              foreach($key2['#below'] as &$key3):
              
                if (isset($key3['#theme'])) {
                  $key3['#theme'] = 'menu_link__site_navigation';
                }
              endforeach;
              
           }
        endforeach;
       
      }
    endforeach;
  }
}


/**
* Implements hook_form_contact_site_form_alter().
*/
function rise_form_contact_site_form_alter(&$form, &$form_state, $form_id) {
  global $user;
  
  $form['name'] = array(
	  '#type' => 'textfield',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('name')),
	  '#required' => TRUE,
	);
  
	$form['mail'] = array(
	  '#type' => 'textfield',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('email')),
	  '#required' => TRUE,
	);
	
	$form['subject'] = array(
	  '#type' => 'textfield',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('subject')),
	  '#required' => TRUE,
	);
	
	$form['message'] = array(
	  '#type' => 'textarea',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('message')),
	  '#required' => TRUE,
	);

}

/**
 * Modify theme_item_list()
 */
function rise_item_list($vars) {
  if (isset($vars['attributes']['class']) && in_array('pager', $vars['attributes']['class'])) {
    unset($vars['attributes']['class']);
    foreach ($vars['items'] as $i => &$item) {
      if (in_array('pager-current', $item['class'])) {
        $item['class'] = array('active');
        $item['data'] = $item['data'];
      }
      
      elseif (in_array('pager-item', $item['class'])) {
        $item['class'] = array('page-numbers');
        $item['data'] =  $item['data'];
      }
      
      elseif (in_array('pager-next', $item['class'])) {
        $item['class'] = array('next page-numbers');
        $item['data'] =  $item['data'];
      }
      
      elseif (in_array('pager-last', $item['class'])) {
        $item['class'] = array('page-numbers');
        $item['data'] =  $item['data'];
      }
      
      elseif (in_array('pager-first', $item['class'])) {
        $item['class'] = array('page-numbers first');
        $item['data'] =  $item['data'];
      }
      
      elseif (in_array('pager-previous', $item['class'])) {
        $item['class'] = array('prev page-numbers');
        $item['data'] =  $item['data'];
      }
      
      elseif (in_array('pager-ellipsis', $item['class'])) {
        $item['class'] = array('disabled');
        $item['data'] =  $item['data'];
      }
    }
    return '<div class="pagination">' . theme_item_list($vars) . '</div>';
  }
  return theme_item_list($vars);
}

/**
* Implements hook_form_comment_form_alter().
*/
function comment_form_comment_form_alter(&$form, &$form_state) {

   /* Remove field title and add placeholder for "Author" field */
	$form['author']['name']['#attributes']['placeholder'] = t( 'name' );
  $form['author']['name']['#title'] = FALSE;
	
  /* Remove the "your name" elements for authenticated users */
  if ($form['is_anonymous']['#value'] == false) {
    $form['author']['#access'] = FALSE; 
  }
  
  /* Remove field title and add placeholder for "Subject" field */
	$form['subject']['#attributes']['placeholder'] = t( 'subject' );
	$form['subject']['#title'] = FALSE;
	$form['subject']['#required'] = FALSE;
	
	/* Remove field title and add placeholder for "Comment Body" field */
	$form['comment_body'][LANGUAGE_NONE][0]['#attributes']['placeholder'] = t( 'message' );
	$form['comment_body']['und'][0]['#title'] = FALSE;
	
}

function rise_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  _form_set_class($element, array('form-text input'));

  $extra = '';
  if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }

  $output = '<input' . drupal_attributes($element['#attributes']) . ' />';

  return $output . $extra;
}

/**
 * Overrides theme_field().
 */
function rise_field($variables) {
 
  $output = '';
 
  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';  
  }
  
 if ($variables['element']['#field_name'] == 'field_tags') {
    foreach ($variables['items'] as $delta => $item) {
      $rendered_items[] = drupal_render($item);
    }
    $output .= implode(', ', $rendered_items);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_portfolio_category') {
    foreach ($variables['items'] as $delta => $item) {
      $rendered_items[] = drupal_render($item);
    }
    $output .= implode(', ', $rendered_items);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_article_embed') {
    foreach ($variables['items'] as $delta => $item) {
      $rendered_items[] = drupal_render($item);
    }
    $output .= implode(' ', $rendered_items);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_intro_content') {
    foreach ($variables['items'] as $delta => $item) {
      $rendered_items[] = drupal_render($item);
    }
    $output .= implode(' ', $rendered_items);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_skills_icon') {
    foreach ($variables['items'] as $delta => $item) {
      $rendered_items[] = drupal_render($item);
    }
    $output .= implode(' ', $rendered_items);
  }
           
  else {
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
    // Default rendering taken from theme_field().
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
    $output .= '</div>';
    // Render the top-level DIV.
    $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';
  }
  
  // Render the top-level DIV.
  return $output;
}

/**
* Add several style-related elements into the <head> tag.
*/
function rise_preprocess_html(&$vars){
  
  // Get the height and width of the logo image for the Portfolio AJAX loading screen.
  $image_url = parse_url(theme_get_setting('logo'));
  $image_path = str_replace(base_path(), realpath(DRUPAL_ROOT) . '/', $image_url['path']);
  $info = image_get_info($image_path);
  $height = $info['height'];
  $width = $info['width'];

  $loading_screen_logo = array(
   '#type' => 'markup',
   '#markup' => "<style type='text/css'>.loading-screen .logo { width: ".$width."px; height: ".$height."px;}</style> ",
   '#weight' => 2,
 );
 
 drupal_add_html_head( $loading_screen_logo, 'loading_screen_logo');

}

/**
*  Unset color stylesheet depending on theme settings.
*/
function rise_css_alter(&$css) {
 
 if (theme_get_setting('color_scheme') == "light") {
   global $parent_root;
   unset($css[drupal_get_path('theme', 'rise') . '/css/dark.css']);
 }
 
}

/**
 * Theme node pagination function().
 */
function rise_node_pagination($node, $mode = 'n') {
  $query = new EntityFieldQuery();
	$query
    ->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', $node->type);
  $result = $query->execute();
  $nids = array_keys($result['node']);
  
  while ($node->nid != current($nids)) {
    next($nids);
  }
  
  switch($mode) {
    case 'p':
      prev($nids);
    break;
		
    case 'n':
      next($nids);
    break;
		
    default:
    return NULL;
  }
  
  return current($nids);
}

/**
 * User CSS function. Separate from rise_preprocess_html so function can be called directly before </head> tag.
 */
function rise_user_css() {
  echo "<!-- User defined CSS -->";
  echo "<style type='text/css'>";
  echo theme_get_setting('user_css');
  echo "</style>";
  echo "<!-- End user defined CSS -->";	
}

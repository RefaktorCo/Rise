<?php
/**
 * Define $root global variable.
 */
global $theme_root, $parent_root, $theme_path;
$theme_root = base_path() . path_to_theme();
$parent_root = base_path() . drupal_get_path('theme', 'rise');

require_once(drupal_get_path('theme', 'rise').'/includes/twitter.inc');

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
 * Overrides theme_menu_tree().
 */
function rise_menu_tree__site_navigation(&$variables) {
  return '<ul class="navigation">' . $variables['tree'] . '</ul>';
}


/**
 * Implements hook_block_view_alter() for "Site Navigation" region.
 */
function rise_block_view_alter(&$data, $block) {

  if ( ($block->region == 'site_navigation') && ($data['subject'] != 'Rise Menu')) {
    $data['content']['#theme_wrappers'] = array('menu_tree__site_navigation');
  }
  
}


/**
 * Overrides theme_menu_local_tasks().
 */
function rise_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="etabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="etabs">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
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
        $item['class'] = array('page-numbers-current current');
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
function rise_form_comment_form_alter(&$form, &$form_state, $form_id) {
  global $user;
  
  if (!$user->uid) {
  $form['author']['name'] = array(
	  '#type' => 'textfield',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('name')),
	  '#required' => TRUE,
	);
	}
	
	$form['subject'] = array(
	  '#type' => 'textfield',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('subject')),
	  '#required' => TRUE,
	);
	
	$form['comment_body'] = array(
	  '#type' => 'textarea',
	  '#maxlength' => 255,
	  '#attributes' =>array('placeholder' => t('comment')),
	  '#required' => TRUE,
	);

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

  $customFields = array('field_portfolio_video','field_portfolio_category','field_portfolio_client','field_portfolio_website');
 
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
    $output .= implode(' ', $rendered_items);
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

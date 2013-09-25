<?php

/**
 * Implements hook_theme().
 */
function cambridge_theme_theme($existing, $type, $theme, $path) {
  return array(
    'cambridge_theme_unstyled_list' => array(
      'function' => 'cambridge_theme_unstyled_list',
      'render element' => 'tree',
    ),
    'cambridge_theme_horizontal_navigation' => array(
      'function' => 'cambridge_theme_horizontal_navigation',
      'render element' => 'tree',
    ),
    'cambridge_theme_local_dropdown_menu' => array(
      'function' => 'cambridge_theme_local_dropdown_menu',
      'render element' => 'tree',
    ),
    'cambridge_theme_left_navigation_block' => array(
      'function' => 'cambridge_theme_left_navigation_block',
      'render element' => 'tree',
    ),
    'cambridge_theme_left_navigation_link' => array(
      'function' => 'cambridge_theme_left_navigation_link',
      'render element' => 'element',
    ),
    'cambridge_easy_breadcrumb' => array(
      'function' => 'theme_cambridge_easy_breadcrumb',
      'variables' => array(
        'breadcrumb' => NULL,
        'segments_quantity' => NULL,
        'separator' => NULL,
      ),
    ),
  );
}

/**
 * Implements template_preprocess_html().
 */
function cambridge_theme_preprocess_html(&$variables) {
  $variables['classes_array'][] = 'campl-theme-' . theme_get_setting('colour_scheme');

  if (FALSE === module_exists('touch_icons')) {
    drupal_add_html_head_link(
      array(
        'rel' => 'apple-touch-icon',
        'href' => file_create_url(drupal_get_path('theme', 'cambridge_theme') . '/apple-touch-icon.png'),
        'type' => 'image/png',
      )
    );
  }
}

/**
 * Implements theme_menu_local_tasks().
 */
function cambridge_theme_menu_local_tasks(&$variables) {
  if (empty($variables['primary']) && empty($variables['secondary'])) {
    return NULL;
  }

  $output = '<div class="campl-content-container">';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="campl-nav campl-nav-tabs campl-unstyled-list">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="campl-nav campl-nav-tabs campl-unstyled-list">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  $output .= '</div>';

  return $output;
}

/**
 * Implements hook_js_alter().
 */
function cambridge_theme_js_alter(&$javascript) {
  // Use the jQuery version provided with the house style.
  $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'cambridge_theme') . '/js/libs/jquery-min.js';
  $javascript['misc/jquery.js']['version'] = '1.7.1';
}

/**
 * Unstyled list theme wrapper.
 */
function cambridge_theme_unstyled_list($variables) {
  return '<ul class="campl-unstyled-list">' . $variables['tree']['#children'] . '</ul>';
}

/**
 * Horizontal navigation theme wrapper.
 */
function cambridge_theme_horizontal_navigation($variables) {
  return '<div class="campl-wrap clearfix campl-local-navigation"><div class="campl-local-navigation-container"><ul class="campl-unstyled-list">' . $variables['tree']['#children'] . '</ul></div></div>';
}

/**
 * Local dropdown menu theme wrapper.
 */
function cambridge_theme_local_dropdown_menu($variables) {
  return '<ul class="campl-unstyled-list local-dropdown-menu">' . $variables['tree']['#children'] . '</ul>';
}

/**
 * Left navigation menu block themer.
 */
function cambridge_theme_left_navigation_block($variables) {
  return $variables['tree']['#children'];
}

/**
 * Left navigation menu block link themer.
 */
function cambridge_theme_left_navigation_link($variables) {
  $element = $variables['element'];
  $sub_menu = '';
  if ($element['#below']) {
    $element['#attributes']['class'][] = 'campl-selected';
    $sub_menu = '<ul class="campl-unstyled-list campl-vertical-breadcrumb-children">' .
      drupal_render($element['#below']) . '</ul>';
  }
  $list_menu = '';

  if ($element['#title'] != t('Home')) {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    $list_menu = '<li' . drupal_attributes($element['#attributes']) . ' >' . $output . $sub_menu . "</li>\n";
  }

  return $list_menu;
}

/**
 * Implements template_preprocess_block().
 */
function cambridge_theme_preprocess_block(&$variables) {
  if (
    $variables['block']->region === 'content'
    &&
    (
      // it's not normal content
      ($variables['block']->module !== 'system' || $variables['block']->delta !== 'main')
      ||
      // but it can be a form
      isset($variables['elements']['#form_id'])
      ||
      // or a user profile
      (isset($variables['elements']['#theme']) && $variables['elements']['#theme'] === 'user_profile')
      ||
      // or a default Drupal not found message
      (
        isset($variables['elements']['main']['#children'])
        &&
        $variables['elements']['main']['#children'] == t(
          'The requested page "@path" could not be found.',
          array('@path' => request_uri())
        )
      )
      ||
      // or a default Drupal access denied message
      (
        isset($variables['elements']['main']['#children'])
        &&
        $variables['elements']['main']['#children'] == t('You are not authorized to access this page.')
      )
      ||
      // or an empty front page
      isset($variables['elements']['default_message'])
    )
    &&
    // it's not a view block
    $variables['block']->module !== 'views'
  ) {
    $variables['classes_array'][] = 'campl-content-container';
  }
  elseif ($variables['block']->region === 'sidebar' && $variables['block']->module !== 'views') {
    $variables['content_attributes_array']['class'][] = 'campl-content-container';
  }
  elseif (in_array($variables['block']->region, array('footer_1', 'footer_2', 'footer_3', 'footer_4'))) {
    $variables['classes_array'][] = 'campl-content-container campl-navigation-list';
    $variables['theme_hook_suggestions'][] = 'block__footer_x';
  }
}

/**
 * Implements template_preprocess_menu_block_wrapper().
 */
function cambridge_theme_preprocess_menu_block_wrapper(&$variables) {
  // Let the template know if this is the left_navigation region or not.
  $variables['config']['in_left_navigation'] = in_array(
    'cambridge_theme_left_navigation_block',
    $variables['content']['#theme_wrappers']
  );
}

/**
 * Implements theme_status_messages().
 */
function cambridge_theme_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  foreach (drupal_get_messages($display) as $type => $messages) {
    switch ($type) {
      case 'status':
        $type = 'success';
        $name = t('Success');
        break;
      case 'error':
        $type = 'warning';
        $name = t('Warning');
        break;
      case 'warning':
        $type = 'Alert';
        $name = t('Alert');
        break;
      default:
        $type = 'info';
        $name = t('Information');
    }

    foreach ($messages as $message) {
      $output .= '<div class="campl-notifications-panel campl-' . $type . '-panel campl-notifications-container clearfix">';

      $output .= '<div class="campl-column4">';
      $output .= '<p class="campl-notifications-icon campl-' . $type . '-icon">' . $name . ':</p>';
      $output .= '</div>';

      $output .= '<div class="campl-column8">';
      $output .= '<p>' . $message . "</p>";
      $output .= "</div>";

      $output .= "</div>";
    }
  }

  return $output;
}

/**
 * Implements theme_image().
 */
function cambridge_theme_image($variables) {
  // Make sure class is added to all images.
  $variables['attributes']['class'][] = 'campl-scale-with-grid';

  return theme_image($variables);
}

/**
 * Implements hook_block_view_alter().
 */
function cambridge_theme_block_view_alter(&$data, $block) {

  if (in_array($block->region, array('footer_1', 'footer_2', 'footer_3', 'footer_4'))) {
    // Add wrapper to blocks in the local footer column regions.
    if (array_key_exists('content', $data) && is_array($data['content'])) {
      $data['content']['#theme_wrappers'] = array('cambridge_theme_unstyled_list');
    }
  }
  elseif ($block->module === 'menu_block' && $block->region === 'horizontal_navigation') {
    // Forcibly disable the block title.
    $data['subject'] = NULL;

    // Add wrappers to the horizontal navigation regions.

    $data['content']['#content']['#theme_wrappers'] = array('cambridge_theme_horizontal_navigation');
    foreach ($data['content']['#content'] as $id => $item) {
      if (isset($data['content']['#content'][$id]['#below']) && count($data['content']['#content'][$id]['#below'])) {
        $data['content']['#content'][$id]['#below']['#theme_wrappers'] = array('cambridge_theme_local_dropdown_menu');
        foreach ($data['content']['#content'][$id]['#below'] as $belowId => $below) {
          if ('#' === substr($belowId, 0, 1)) {
            continue;
          }
          if (count($data['content']['#content'][$id]['#below'][$belowId]['#below'])) {
            $data['content']['#content'][$id]['#below'][$belowId]['#below']['#theme_wrappers'] = array('cambridge_theme_local_dropdown_menu');
          }
        }
      }
    }

    // We need to add the campl-current-page class to the current page, but there isn't a way to do this with arrays as
    // it can have any number of levels. So they need to be turned into ArrayObjects and back again. (Ugly, but...)

    require_once __DIR__ . '/includes/recursive_array_object.class.inc';

    $object = new RecursiveArrayObject($data['content']['#content']);

    $find_active = function ($objects) use (&$find_active) {
      foreach ($objects as $key => $object) {
        if ('#' === substr($key, 0, 1)) {
          continue;
        }

        if (in_array('active', (array) $object['#attributes']['class'])) {
          $object['#attributes']['class'][] = 'campl-current-page';
          return TRUE;
        }

        if ((is_array($object['#below']) || $object['#below'] instanceof Countable) && count($object['#below'])) {
          if (TRUE === $find_active($object['#below'])) {
            return TRUE;
          }
        }
      }

      return FALSE;
    };

    $find_active($object);

    $data['content']['#content'] = $object->getArrayCopy();
  }
  elseif ($block->module === 'menu_block' && $block->region === 'left_navigation') {
    // Forcibly disable the block title.
    $data['subject'] = NULL;

    // We need to add references to the cambridge_theme_left_navigation_link and cambridge_theme_left_navigation_block
    // functions so that the left navigation menu renders correctly, but there isn't a way to do this with arrays as it
    // can have any number of levels. So they need to be turned into ArrayObjects and back again. (Ugly, but...)

    require_once __DIR__ . '/includes/recursive_array_object.class.inc';

    if (FALSE === isset($data['content']['#content'])) {
      return;
    }

    $object = new RecursiveArrayObject($data['content']['#content']);

    $replace_wrappers = function ($objects) use (&$replace_wrappers) {
      foreach ($objects as $key => $object) {
        if ('#' === substr($key, 0, 1)) {
          continue;
        }

        $object['#theme'] = array('cambridge_theme_left_navigation_link');

        if ((is_array($object['#below']) || $object['#below'] instanceof Countable) && count($object['#below'])) {
          $replace_wrappers($object['#below']);
        }
      }

      $objects['#theme_wrappers'] = array('cambridge_theme_left_navigation_block');
    };

    $replace_wrappers($object);

    $data['content']['#content'] = $object->getArrayCopy();
  }
}

/**
 * Implements hook_theme_link().
 */
function cambridge_theme_link($variables) {
  if (
    isset($variables['options']['attributes']['class'])
    &&
    in_array('active-trail', $variables['options']['attributes']['class'])
  ) {
    $variables['options']['attributes']['class'][] = 'campl-selected';
  }

  return theme_link($variables);
}

/**
 * Implements hook_menu_breadcrumb_alter().
 */
function cambridge_theme_menu_breadcrumb_alter(&$active_trail, $item) {
  if (isset($active_trail[0])) {
    $active_trail[0]['localized_options']['attributes']['class'][] = 'campl-home ir';
  }
}

/**
 * Implements template_breadcrumb().
 */
function cambridge_theme_breadcrumb($breadcrumbs) {
  if (count($breadcrumbs['breadcrumb']) <= 1) {
    return '';
  }

  $html = '<div class="campl-breadcrumb" id="breadcrumb">';
  $html .= '<ul class="campl-unstyled-list campl-horizontal-navigation clearfix">';
  foreach ($breadcrumbs['breadcrumb'] as $i => $breadcrumb) {
    if ($i == 0) {
      $html .= '<li class="first-child">';
    }
    else {
      $html .= '<li>';
    }
    $html .= $breadcrumb . '</li>';
  }
  $html .= '</ul>';
  $html .= '</div>';

  return $html;
}

/**
 * Implements hook_block_view_MODULE_DELTA_alter() for the Easy Breadcrumb module's Easy Breadcrumb block.
 */
function cambridge_theme_block_view_easy_breadcrumb_easy_breadcrumb_alter(&$data, $block) {
  $data['content']['easy_breadcrumb']['#theme'] = 'cambridge_easy_breadcrumb';
}

/**
 * Style the Easy Breadcrumb module's Easy Breadcrumb block.
 */
function theme_cambridge_easy_breadcrumb($variables) {
  $breadcrumbs = $variables['breadcrumb'];
  $segments_quantity = $variables['segments_quantity'];

  if (count($breadcrumbs) <= 1) {
    return '';
  }

  $html = '';

  if ($segments_quantity > 0) {
    $html .= '<div class="campl-breadcrumb" id="breadcrumb">';
    $html .= '<ul class="campl-unstyled-list campl-horizontal-navigation clearfix">';

    foreach ($breadcrumbs as $i => $breadcrumb) {
      if (isset($breadcrumb['url'])) {
        $content = $breadcrumb['content'];
        $class = $breadcrumb['class'];
        $url = $breadcrumb['url'];
        if (in_array('easy-breadcrumb_segment-front', $class)) {
          $class[] = 'campl-home ir';
        }
        if ($i == 0) {
          $html .= '<li class="first-child">';
        }
        else {
          $html .= '<li>';
        }
        $html .= l($content, $url, array('attributes' => array('class' => $class))) . '</li>';
      }
      else {
        $content = html_entity_decode($breadcrumb['content']);
        $class = implode(' ', $breadcrumb['class']);
        $html .= '<li class="' . $class . '">' . $content . '</li>';
      }
    }
    $html .= '</ul>';
    $html .= '</div>';
  }

  return $html;
}

/**
 * Find siblings for a menu link.
 *
 * @param $menu_link
 *   A menu link.
 *
 * @return
 *   An array of menu link siblings.
 */
function cambridge_theme_get_menu_siblings($menu_link) {
  $parent = _menu_link_find_parent($menu_link);

  if (!$parent) {
    // Top level, so fake what we need.
    $parent = array(
      'menu_name' => $menu_link['menu_name'],
      'mlid' => 0,
    );
  }

  return db_query(
    "SELECT mlid, plid, link_path, link_title FROM {menu_links} WHERE menu_name=:menu AND plid=:mlid AND hidden=0 ORDER BY weight, link_title",
    array(':menu' => $parent['menu_name'], ':mlid' => $parent['mlid'])
  )->fetchAllAssoc('mlid');
}

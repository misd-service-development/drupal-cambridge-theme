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
    'cambridge_theme_left_navigation_structure' => array(
      'function' => 'cambridge_theme_left_navigation_structure',
      'render element' => 'element',
    ),
    'cambridge_theme_left_navigation_splitter' => array(
      'function' => 'cambridge_theme_left_navigation_splitter',
      'render element' => 'element',
    ),
    'cambridge_theme_left_navigation_breadcrumb' => array(
      'function' => 'cambridge_theme_left_navigation_breadcrumb',
      'render element' => 'element',
    ),
    'cambridge_theme_left_navigation_navigation' => array(
      'function' => 'cambridge_theme_left_navigation_navigation',
      'render element' => 'element',
    ),
    'cambridge_theme_left_navigation_children' => array(
      'function' => 'cambridge_theme_left_navigation_children',
      'render element' => 'element',
    ),
    'cambridge_theme_menu_link__left_navigation_breadcrumb' => array(
      'function' => 'cambridge_theme_menu_link__left_navigation_breadcrumb',
      'render element' => 'element',
    ),
    'cambridge_easy_breadcrumb' => array(
      'variables' => array(
        'breadcrumb' => NULL,
        'segments_quantity' => NULL,
        'separator' => NULL,
        ),
      'template' => 'easy-breadcrumb',
      'path' => drupal_get_path('theme', 'cambridge_theme') . '/templates',
    ),

  );
}

/**
 * Implements template_preprocess_maintenance_page().
 */
function cambridge_theme_preprocess_maintenance_page(&$variables) {
  drupal_add_css(path_to_theme() . '/css/maintenance.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
}

/**
 * Implements template_preprocess_html().
 */
function cambridge_theme_preprocess_html(&$variables) {
  $variables['classes_array'][] = 'campl-theme-' . theme_get_setting('colour_scheme');

  drupal_add_html_head(
    array(
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'http-equiv' => 'X-UA-Compatible',
        'content' => 'IE=edge',
      ),
      '#weight' => -999, // Immediately after Content-Type.
    ),
    'x_ua_compatible'
  );

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

  $output = '<div class="campl-content-container campl-no-bottom-padding">';

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
 * Implements theme_table().
 */
function cambridge_theme_table($variables) {
  $variables['attributes']['class'][] = 'campl-table campl-table-bordered campl-table-striped campl-vertical-stacking-table';

  return theme_table($variables);
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

  if (_cambridge_theme_is_home_path($element['#href'])) {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    $list_menu = '<li' . drupal_attributes($element['#attributes']) . ' >' . $output . $sub_menu . "</li>\n";
  }

  return $list_menu;
}

/**
 * Implements template_preprocess_page().
 */
function cambridge_theme_preprocess_page(&$variables) {

  // Get the site slogan
  $slogan = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  $variables['site_slogan'] = ($slogan) ? '' : filter_xss_admin(variable_get('site_slogan', ''));

  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    // Taxonomy term listing page.
    if (FALSE === empty($variables['page']['content']['system_main']['term_heading']['term']['#term']->description)) {
      $variables['page']['content']['system_main']['term_heading']['#prefix'] = '<div class="campl-content-container campl-no-bottom-padding">' . $variables['page']['content']['system_main']['term_heading']['#prefix'];
      $variables['page']['content']['system_main']['term_heading']['#suffix'] .= '<hr></div>';
    }
    if (isset($variables['page']['content']['system_main']['no_content'])) {
      $variables['page']['content']['system_main']['no_content']['#prefix'] = '<div class="campl-content-container campl-no-top-padding">' . $variables['page']['content']['system_main']['no_content']['#prefix'];
      $variables['page']['content']['system_main']['no_content']['#suffix'] .= '</div>';
    }
  }
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
      // or a comment form
      isset($variables['elements']['comment_form'])
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
  elseif ($variables['block']->region === 'partnerships') {
    $variables['classes_array'][] = 'campl-content-container campl-logo-container campl-bottom-padding';
    $variables['title_attributes_array']['class'][] = 'campl-branding-title';
  }
  elseif (in_array($variables['block']->region, array('footer_1', 'footer_2', 'footer_3', 'footer_4'))) {
    $variables['classes_array'][] = 'campl-content-container campl-navigation-list';
    $variables['theme_hook_suggestions'][] = 'block__footer_x';
  }
}

/**
 * Implements hook_form_FORM_ID_alter() for a Views exposed form.
 */
function cambridge_theme_form_views_exposed_form_alter(&$form) {
  $form['#attributes']['class'][] = 'campl-content-container';
}

/**
 * Implements hook_menu_block_tree_alter().
 */
function cambridge_theme_menu_block_tree_alter(&$tree, &$config) {
  $block = _cambridge_theme_block_load('menu_block', $config['delta']);

  // If the block is enabled by Context, the region won't currently be set.
  if (BLOCK_REGION_NONE == $block->region && module_exists('context')) {
    if ($plugin = context_get_plugin('reaction', 'block')) {
      foreach (array('left_navigation', 'horizontal_navigation') as $region) {
        $context_blocks = $plugin->block_list($region);

        $key = sprintf('%s-%s', 'menu_block', $config['delta']);

        if (isset($context_blocks[$key])) {
          $block->region = $context_blocks[$key]->region;
        }
      }
    }
  }

  if ('left_navigation' === $block->region) {
    // Force menu block configuration.
    $config['level'] = 1;
    $config['follow'] = 0;
    $config['depth'] = 0;
    $config['sort'] = 1;

    $tree = _cambridge_theme_mark_active_item_in_tree($tree);
  }
  elseif ('horizontal_navigation' === $block->region) {
    // Force menu block configuration.
    $config['level'] = 1;
    $config['follow'] = 0;
    $config['depth'] = 0;
    $config['sort'] = 0;

    $tree = _cambridge_theme_mark_active_item_in_tree($tree);

    _cambridge_theme_add_overview_items($tree);

  }
}

/**
 * Cycle through the tree to find a faux-active item.
 */
function _cambridge_theme_mark_active_item_in_tree($tree) {
  foreach ($tree as $key => $item) {
    $tree[$key] = _cambridge_theme_mark_active_item($item);
  }

  return $tree;
}

/**
 * Add faux overview items in menu tree to allow clicking in mobile view
 */
function _cambridge_theme_add_overview_items(&$tree) {

    foreach ($tree as $key => &$value) {

        // Ignore disabled menu items
        if($value['link']['hidden'] == 0) {

            // Ignore childless items
            if($value['link']['has_children'] == 1) {

                // now recursively check any children
                _cambridge_theme_add_overview_items($tree[$key]['below']);

                // add the overview except for firstchild items
                if ('<firstchild>' !== $value['link']['link_path']) {

                    // create and overview page with same link data but nothing below
                    $overview = array('link' => $value['link'], 'below' => array());
                    //dpm('needs an overview page', $overview['link']['title']);
                    $overview['link']['title'] .= ' overview'; // append overview

                    // pre-pend it to existing tree
                    $temp = $value['below'];
                    $temp = array('overview' => $overview) + $temp;
                    $tree[$key]['below'] = $temp;
                }
            }
        }
    }
}


/**
 * Mark the end of active trails as faux active.
 */
function _cambridge_theme_mark_active_item($item) {
  if (TRUE == $item['link']['in_active_trail'] && 0 === count($item['below']) && $_GET['q'] != $item['link']['href']) {
    $item['link']['cambridge_theme_faux_active'] = TRUE;
  }

  foreach ($item['below'] as $key => $child) {
    $item['below'][$key] = _cambridge_theme_mark_active_item($child);
  }

  return $item;
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
        $type = 'alert';
        $name = t('Alert');
        break;
      default:
        $type = 'information';
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
  if (isset($variables['attributes']['class']) && FALSE === is_array($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array($variables['attributes']['class']);
  }

  // Make sure class is added to all images.
  $variables['attributes']['class'][] = 'campl-scale-with-grid';

  return theme_image($variables);
}

/**
 * Implements hook_block_view_alter().
 */
function cambridge_theme_block_view_alter(&$data, $block) {
  if ($block->module === 'menu_block') {
    $data['content']['#content'] = _cambridge_theme_add_active_item($data['content']['#content']);
  }

  if (in_array($block->region, array('footer_1', 'footer_2', 'footer_3', 'footer_4'))) {
    // Add wrapper to blocks in the local footer column regions.
    if (isset($data) && array_key_exists('content', $data) && is_array($data['content'])) {
      if ($block->module === 'menu_block') {
        $data['content']['#content']['#theme_wrappers'] = array('cambridge_theme_unstyled_list');
      }
      else {
        $data['content']['#theme_wrappers'] = array('cambridge_theme_unstyled_list');
      }
    }
  }
  elseif ($block->module === 'menu_block' && $block->region === 'horizontal_navigation') {
    // Forcibly disable the block title.
    $data['subject'] = NULL;
    $block->title = NULL;

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

    $data['content']['#content'] = _cambridge_theme_find_active_horizontal_navigation($data['content']['#content']);

    foreach ($data['content']['#content'] as $key => $item) {
      if (FALSE === is_int($key)) {
        continue;
      }
      if (in_array('active-trail', $item['#attributes']['class'])) {
        $data['content']['#content'][$key]['#localized_options']['attributes']['class'][] = 'campl-selected';
      }
    }
  }
  elseif ($block->module === 'menu_block' && $block->region === 'left_navigation') {
    if (FALSE === isset($data['content']['#content'])) {
      return;
    }

    // Forcibly disable the block title.
    $data['subject'] = NULL;
    $block->title = NULL;

    $content = $data['content']['#content'];

    $active = NULL;

    foreach ($content as $key => $item) {
      if (FALSE === is_int($key)) {
        continue;
      }

      if (TRUE === in_array('active', $item['#attributes']['class'])) {
        $active = $content[$key];
      }
    }

    if (NULL === $active) {
      foreach ($content as $key => $item) {
        if (FALSE === is_int($key)) {
          continue;
        }

        if (TRUE === in_array('active-trail', $item['#attributes']['class'])) {
          // Sometimes the menu has an active-trail without an active item (eg Feeds module's log pages. Cycle through
          // the items to make sure we have one. Not ideal, but the menu would break otherwise.

          $active = _cambridge_theme_left_navigation_has_active_item($content[$key]);

          break;
        }
      }
    }

    $breadcrumbs = array();

    if (NULL === $active) {
      // No active part, so just display the menu at the top level.
      $navigation = array();
      $siblings = $content;

      foreach ($siblings as $key => $sibling) {
        if (FALSE === is_int($key)) {
          continue;
        }
        if (_cambridge_theme_is_home_path($sibling['#href'])) {
          $breadcrumbs = array($key => $siblings[$key]) + $breadcrumbs;
          $breadcrumbs[$key]['#title'] = variable_get('site_name');
          break;
        }
      }

      // If there isn't a breadcrumb already (ie the top level doesn't have a 'Home' menu item), make one that points to
      // the front page.

      if (count($breadcrumbs) === 0) {
        $breadcrumbs['foo'] = array(
          '#theme' => array('menu_link'),
          '#title' => variable_get('site_name'),
          '#href' => '<front>',
          '#attributes' => array(),
        );
      }
    }
    else {
      $active['_siblings'] = $content;

      $navigation = array();

      // See if the top level has a 'Home' menu item, and make it the first breadcrumb level if found.

      foreach ($active['_siblings'] as $key => $sibling) {
        if (FALSE === is_int($key)) {
          continue;
        }
        if (_cambridge_theme_is_home_path($sibling['#href'])) {
          $breadcrumbs = array($key => $active['_siblings'][$key]) + $breadcrumbs;
          $breadcrumbs[$key]['#title'] = variable_get('site_name');
          break;
        }
      }

      // If there isn't a breadcrumb already (ie the top level doesn't have a 'Home' menu item), make one that points to
      // the front page.

      if (count($breadcrumbs) === 0) {
        $breadcrumbs['foo'] = array(
          '#theme' => array('menu_link'),
          '#title' => variable_get('site_name'),
          '#href' => '<front>',
          '#attributes' => array(),
        );
      }

      // Break up the menu into the breadcrumb and navigation sections.

      _cambridge_theme_left_navigation_break_up($active, $breadcrumbs, $navigation);

      // Stop the category being a link when on the page (unless it's a faux active item).

      $key = key($navigation);

      if (in_array('active', $navigation[$key]['#attributes']['class'])) {
        $navigation[$key]['#attributes']['class'][] = 'campl-selected';
        if (FALSE === isset($navigation[$key]['#original_link']['cambridge_theme_faux_active'])) {
          $navigation[$key]['#href'] = '<none>';
        }
      }

      // We don't want to display grandchildren.

      foreach ($navigation[$key]['#below'] as $childKey => $child) {
        if (FALSE === is_int($childKey)) {
          continue;
        }
        $navigation[$key]['#below'][$childKey]['#below'] = array();

        if (in_array('active', $child['#attributes']['class'])) {
          if (FALSE === isset($child['#original_link']['cambridge_theme_faux_active'])) {
            $navigation[$key]['#below'][$childKey]['#attributes']['class'][] = 'campl-selected';
          }
          else {
            $navigation[$key]['#below'][$childKey]['#attributes']['class'][] = 'campl-faux-selected';
          }
        }
      }

      // Pick out siblings.

      $siblings = $navigation[$key]['_siblings'];
      unset($siblings[$key]);

      if (_cambridge_theme_is_home_path($navigation[$key]['#href'])) {
        $navigation = array();
      }
    }

    foreach ($siblings as $key => $sibling) {
      if (FALSE === is_int($key)) {
        continue;
      }

      // We don't want to display children of the siblings.

      $siblings[$key]['#below'] = array();

      if (_cambridge_theme_is_home_path($sibling['#href'])) {
        unset($siblings[$key]);
      }
    }

    // Construct the two menu parts.

    $data['content']['#content'] = array();
    $data['content']['#content']['#theme'] = array('cambridge_theme_left_navigation_structure');
    $data['content']['#content']['#below']['breadcrumb']['#below'] = $breadcrumbs;
    $data['content']['#content']['#below']['breadcrumb']['#below']['#theme_wrappers'] = array('cambridge_theme_left_navigation_breadcrumb');
    $data['content']['#content']['#below']['breadcrumb']['#theme'] = array('cambridge_theme_left_navigation_splitter');
    $data['content']['#content']['#below']['breadcrumb']['#href'] = '<front>';
    $data['content']['#content']['#below']['breadcrumb']['#localized_options'] = array();
    $data['content']['#content']['#below']['breadcrumb']['#attributes'] = array();
    $data['content']['#content']['#below']['breadcrumb']['#bid'] = array('module' => 'menu_block', 'delta' => 2);
    foreach ($data['content']['#content']['#below']['breadcrumb']['#below'] as $key => $value) {
      if (FALSE === isset($data['content']['#content']['#below']['breadcrumb']['#below'][$key]['#theme'])) {
        continue;
      }
      array_unshift(
        $data['content']['#content']['#below']['breadcrumb']['#below'][$key]['#theme'],
        'menu_link__left_navigation_breadcrumb'
      );
    }
    $data['content']['#content']['#below']['navigation']['#below'] = array_merge($navigation, $siblings);
    $data['content']['#content']['#below']['navigation']['#below']['#theme_wrappers'] = array('cambridge_theme_left_navigation_navigation');
    $data['content']['#content']['#below']['navigation']['#theme'] = array('cambridge_theme_left_navigation_splitter');
    $data['content']['#content']['#below']['navigation']['#href'] = '<front>';
    $data['content']['#content']['#below']['navigation']['#localized_options'] = array();
    $data['content']['#content']['#below']['navigation']['#attributes'] = array();
    $data['content']['#content']['#below']['navigation']['#bid'] = array('module' => 'menu_block', 'delta' => 2);
    foreach ($data['content']['#content']['#below']['navigation']['#below'] as $key => $value) {
      if (FALSE === isset($data['content']['#content']['#below']['navigation']['#below'][$key]['#below']['#theme_wrappers'])) {
        continue;
      }
      $data['content']['#content']['#below']['navigation']['#below'][$key]['#below']['#theme_wrappers'] = array(array('cambridge_theme_left_navigation_children'));
    }
  }

}

/**
 * Cycle through a tree and make items marked as faux active as actually active.
 */
function _cambridge_theme_add_active_item($items) {
  foreach ($items as $key => $item) {
    if (FALSE === is_int($key)) {
      continue;
    }

    if (
      isset($item['#original_link']['cambridge_theme_faux_active'])
      &&
      FALSE === in_array('active', $item['#attributes']['class'])
    ) {
      $items[$key]['#attributes']['class'][] = 'active';
    }
    $items[$key]['#below'] = _cambridge_theme_add_active_item($items[$key]['#below']);
  }

  return $items;
}

/**
 * Add the campl-current-page class to the current page.
 */
function _cambridge_theme_find_active_horizontal_navigation($objects) {
  foreach ($objects as $key => $object) {
    if ('#' === substr($key, 0, 1)) {
      continue;
    }

    $has_children = is_array($object['#below']) && count($object['#below']);

    if (in_array('active', (array) $object['#attributes']['class'])) {
      $is_active = TRUE;

      // If the item is an overview/firstchild link the parent item will appear as active, so take a look at the
      // children to see if there's another active item.

      if (TRUE === $has_children) {
        foreach ($object['#below'] as $child) {
          if (isset($child['#attributes']['class']) && in_array('active', $child['#attributes']['class'])) {
            $is_active = FALSE;
            break;
          }
        }
      }

      if (TRUE === $is_active) {
        $objects[$key]['#attributes']['class'][] = 'campl-current-page';

        break;
      }
    }

    if (TRUE === $has_children) {
      $objects[$key]['#below'] = _cambridge_theme_find_active_horizontal_navigation($object['#below']);
    }
  }

  return $objects;
}

/**
 * Test whether the menu has an active item.
 */
function _cambridge_theme_left_navigation_has_active_item($item) {
  if (is_array($item['#attributes']['class']) && in_array('active', $item['#attributes']['class'])) {
    return $item;
  }

  if (is_array($item['#below'])) {
    foreach ($item['#below'] as $key => $child) {
      if (FALSE === is_int($key)) {
        continue;
      }

      if (NULL !== _cambridge_theme_left_navigation_has_active_item($child)) {
        return $item;
      }
    }
  }

  return NULL;
}

/**
 * Break up the left-hand navigation into the breadcrumb and navigation sections.
 */
function _cambridge_theme_left_navigation_break_up(&$item, &$breadcrumbs, &$navigation) {
  if (
    FALSE === in_array('active-trail', $item['#attributes']['class'])
    &&
    FALSE === in_array('active', $item['#attributes']['class'])
  ) {
    return;
  }

  $child_is_active = FALSE;

  foreach ($item['#below'] as $key => $child) {
    if (FALSE === is_int($key)) {
      continue;
    }

    $item['#below'][$key]['_siblings'] = $item['#below'];

    if (TRUE === in_array('active', $child['#attributes']['class'])) {
      $child_is_active = count($child['#below']) === 0;
      break;
    }
  }

  if (
    $child_is_active
    ||
    (
      in_array('active', $item['#attributes']['class'])
      &&
      $item['#original_link']['link_path'] !== '<firstchild>'
    )
  ) {
    $navigation[$item['#original_link']['mlid']] = $item;

    return;
  }

  $breadcrumbs[$item['#original_link']['mlid']] = $item;
  $breadcrumbs[$item['#original_link']['mlid']]['#below'] = array();

  foreach ($item['#below'] as $key => $child) {
    if (FALSE === is_int($key)) {
      continue;
    }

    _cambridge_theme_left_navigation_break_up($child, $breadcrumbs, $navigation);
    $item['#below'][$key] = $child;
  }
}

/**
 * Wrap the left navigation structure.
 */
function cambridge_theme_left_navigation_structure($variables) {
  $output = drupal_render($variables['element']['#below']);

  return '<div class="campl-tertiary-navigation-structure">' . $output . '</div>';
}

/**
 * Wrap the left navigation parts.
 */
function cambridge_theme_left_navigation_splitter($variables) {
  return drupal_render($variables['element']['#below']);
}

/**
 * Wrap the left navigation breadcrumb.
 */
function cambridge_theme_left_navigation_breadcrumb($variables) {
  return '<ul class="campl-unstyled-list campl-vertical-breadcrumb">' . $variables['element']['#children'] . '</ul>';
}

/**
 * Implements theme_menu_link__left_navigation_breadcrumb().
 */
function cambridge_theme_menu_link__left_navigation_breadcrumb(array $variables) {
  $element = $variables['element'];

  $element['#localized_options']['html'] = TRUE;

  $output = l(
    $element['#title'] . '<span class="campl-vertical-breadcrumb-indicator"></span>',
    $element['#href'],
    $element['#localized_options']
  );

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . '</li>';
}

/**
 * Wrap the left navigation navigation.
 */
function cambridge_theme_left_navigation_navigation($variables) {
  return '<ul class="campl-unstyled-list campl-vertical-breadcrumb-navigation">' . $variables['element']['#children'] . '</ul>';
}

/**
 * Wrap the left navigation navigation children.
 */
function cambridge_theme_left_navigation_children($variables) {
  return '<ul class="campl-unstyled-list campl-vertical-breadcrumb-children">' . $variables['element']['#children'] . '</ul>';
}

/**
 * Implements theme_menu_link().
 */
function cambridge_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  if ($element['#href'] === '<none>') {
    $output = $element['#title'];
  }
  else {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements theme_pager().
 */
function cambridge_theme_pager($variables) {
  global $pager_page_array, $pager_total;

  $element = $variables['element'];
  $parameters = $variables['parameters'];

  $pager_current_index = $pager_page_array[$element];
  $pager_current_index = $pager_current_index < 0 ? 0 : $pager_current_index;

  $pager_total_pages = $pager_total[$element];
  $pager_max_index = $pager_total_pages - 1;

  if ($pager_total_pages <= 1) {
    return '';
  }

  $li_previous = theme(
    'pager_previous',
    array('text' => 'previous', 'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );
  $li_first = theme(
    'pager_first',
    array('text' => 1, 'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );
  $li_last = theme(
    'pager_last',
    array('text' => $pager_total_pages, 'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );
  $li_next = theme(
    'pager_next',
    array('text' => 'next', 'element' => $element, 'interval' => 1, 'parameters' => $parameters)
  );

  if ($li_previous) {
    $items[] = array('class' => array('campl-previous-li'), 'data' => $li_previous,);
  }

  if ($li_first) {
    $items[] = array('data' => $li_first);
  }

  if ($pager_current_index == 2 && $pager_max_index > 2) {
    // On the third page, add in page 2 to prevent "1 ... 3".
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index,
          'page_new' => array($pager_current_index - 1),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }
  elseif ($pager_current_index == $pager_max_index && $pager_max_index == 3) {
    // On the last page of four, add page 2 to prevent "1 ... 3 4".
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index - 1,
          'page_new' => array($pager_current_index - 2),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }
  elseif ($pager_current_index > 1 && $pager_max_index > 2) {
    $items[] = array('data' => '<span class="campl-elipsis">&hellip;</span>');
  }

  if (!$li_last && $pager_current_index > 1) {
    // On the last page, try and add the penultimate.
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index,
          'page_new' => array($pager_current_index - 1),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }

  $items[] = array('class' => array('campl-active'), 'data' => '<span>' . ($pager_current_index + 1) . '</span>');

  if (!$li_previous && $pager_current_index < ($pager_max_index - 1)) {
    // On the first page, try and add the second.
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index + 2,
          'page_new' => array($pager_current_index + 1),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }

  if ($pager_current_index + 2 == $pager_max_index && $pager_max_index > 2) {
    // Two away from the end, add in the penultimate page to prevent the likes of "5 6 ... 8".
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index + 2,
          'page_new' => array($pager_current_index + 1),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }
  elseif (($pager_current_index == 0 && $pager_max_index == 3)) {
    // On the first page of four, add in page 3 to prevent "1 2 ... 4".
    $items[] = array(
      'data' => theme(
        'pager_link',
        array(
          'text' => $pager_current_index + 3,
          'page_new' => array($pager_current_index + 2),
          'element' => $element,
          'parameters' => $parameters,
        )
      )
    );
  }
  elseif (($pager_current_index + 1) < $pager_max_index && $pager_max_index > 2) {
    $items[] = array('data' => '<span class="campl-elipsis">&hellip;</span>');
  }

  if ($li_last) {
    $items[] = array('data' => $li_last);
  }

  if ($li_next) {
    $items[] = array('class' => array('campl-next-li'), 'data' => $li_next);
  }

  $pagination = theme('item_list', array('items' => $items, 'attributes' => array('class' => array('pager'))));

  return '<div class="campl-pagination campl-pagination-centered">' . $pagination . '</div>';
}

/**
 * Implements theme_views_mini_pager().
 */
function cambridge_theme_views_mini_pager($vars) {
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];

  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  if ($pager_total[$element] > 1) {

    $li_previous = theme(
      'pager_previous',
      array(
        'text' => (isset($tags[1]) ? $tags[1] : t('‹‹')),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
      )
    );

    $li_next = theme(
      'pager_next',
      array(
        'text' => (isset($tags[3]) ? $tags[3] : t('››')),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
      )
    );

    if (!empty($li_previous)) {
      $items[] = array('class' => array('campl-previous-li'), 'data' => $li_previous);
    }

    $items[] = array(
      'data' => t(
        '<span class="campl-elipsis">@current of @max</span>',
        array('@current' => $pager_current, '@max' => $pager_max)
      ),
    );

    if (!empty($li_next)) {
      $items[] = array('class' => array('campl-next-li'), 'data' => $li_next);
    }

    $pagination = theme(
      'item_list',
      array(
        'items' => $items,
        'title' => NULL,
        'type' => 'ul',
        'attributes' => array('class' => array('pager')),
      )
    );

    return '<div class="campl-pagination campl-pagination-centered">' . $pagination . '</div>';
  }
}

/**
 * Implements theme_pager_previous().
 */
function cambridge_theme_pager_previous($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array;

  if ($pager_page_array[$element] == 0) {
    return '';
  }

  $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

  return theme(
    'pager_link',
    array(
      'text' => $text,
      'prefix' => '<span class="campl-arrow-span"></span>',
      'page_new' => $page_new,
      'element' => $element,
      'parameters' => $parameters,
      'attributes' => array('class' => array('ir campl-pagination-btn campl-previous')),
    )
  );
}

/**
 * Implements theme_pager_next().
 */
function cambridge_theme_pager_next($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;

  if ($pager_page_array[$element] == ($pager_total[$element] - 1)) {
    return '';
  }

  $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);

  return theme(
    'pager_link',
    array(
      'text' => $text,
      'prefix' => '<span class="campl-arrow-span"></span>',
      'page_new' => $page_new,
      'element' => $element,
      'parameters' => $parameters,
      'attributes' => array('class' => array('ir campl-pagination-btn campl-next')),
    )
  );
}

/**
 * Implements theme_pager_link().
 */
function cambridge_theme_pager_link($variables) {
  $text = $variables['text'];
  $prefix = isset($variables['prefix']) ? $variables['prefix'] : '';
  $suffix = isset($variables['prefix']) ? $variables['prefix'] : '';
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  $attributes['href'] = url($_GET['q'], array('query' => $query));

  return '<a' . drupal_attributes($attributes) . '>' . $prefix . check_plain($text) . $suffix . '</a>';
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function cambridge_theme_preprocess_views_view_table(&$vars) {
  $vars['classes_array'][] = 'campl-table campl-table-bordered campl-table-striped campl-vertical-stacking-table';
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


/*
 * Implementation of a preprocess hook for easy breadcrumb module.
 * When easy breadcrumb changed from version 2.12 to 2.13, they changed the
 * module worked from a theme function to a tpl file and preprocess function.
 * We have had to adapt our theme to match their new setup.
 *
 * This function has replaced the theme easy breadcrumb function in the
 * earlier versions of the theme.
 * JAG212 - 26th July 2017.
 */
function cambridge_preprocess_easy_breadcrumb(&$variables) {
    $breadcrumbs = _easy_breadcrumb_build_items();
    if (module_exists('schemaorg')) {
        $variables['list_type'] = 'https://schema.org/BreadcrumbList';
    }
    else {
        $variables['list_type'] = 'http://data-vocabulary.org/Breadcrumb';
    }

    // Loop round all breadcrumbs
    foreach ($breadcrumbs as $i => $breadcrumb) {
        $content = decode_entities($breadcrumb['content']);

        if ($i == 0) {
            $list_html = '<li class="first-child">';
        }
        else {
            $list_html = '<li>';
        }

        if (in_array('easy-breadcrumb_segment-front', $breadcrumb['class'])) {
            // Set appropriate styling to allow home breadcrumb to appear
            // as a house image rather than the word home
            $breadcrumb['class'][] = 'campl-home ir';
        }

        if (isset($breadcrumb['url'])) {
            $variables['breadcrumb'][$i] = $list_html . '<span itemprop="title">';
            $variables['breadcrumb'][$i] .= l($content, $breadcrumb['url'], array(
                'attributes' => array('class' => $breadcrumb['class'])
            ));
            $variables['breadcrumb'][$i] .= '</span></li>';
        }
        else {
            // Last breadcrumb is plain text not a hyperlink
            $class = implode(' ', $breadcrumb['class']);
            $variables['breadcrumb'][$i] = $list_html . '<span class="' . $class . '" itemprop="title">' . check_plain($content) . '</span></li>';
        }
    }

    /* Segmentation handled by <li> styling background so we don't need this. */
    //$variables['segments_quantity'] = count($variables['breadcrumb']);
    //$variables['seperator_ending'] = variable_get(EasyBreadcrumbConstants::DB_VAR_SEPERATOR_ENDING, FALSE) ? 0 : 1;
    //$variables['separator'] = filter_xss(variable_get(EasyBreadcrumbConstants::DB_VAR_SEGMENTS_SEPARATOR, '>>'));
}

/**
 * Whether a path is equivalent to '<front>'.
 */
function _cambridge_theme_is_home_path($path) {
  return $path == '<front>' || $path == drupal_get_normal_path(variable_get('site_frontpage', 'node'));
}

/**
 * Loads a block object from the database for the current theme.
 *
 * This is a replica of block_load(), except that it uses the current theme.
 */
function _cambridge_theme_block_load($module, $delta) {
  global $theme;

  if (isset($delta)) {
    $block = db_query(
      'SELECT * FROM {block} WHERE module = :module AND delta = :delta AND theme = :theme',
      array(':module' => $module, ':delta' => $delta, ':theme' => $theme)
    )->fetchObject();
  }

  // If the block does not exist in the database yet return a stub block
  // object.
  if (empty($block)) {
    $block = new stdClass();
    $block->module = $module;
    $block->delta = $delta;
    $block->region = NULL;
  }

  return $block;
}

/**
 * Theme functions for 'Move to top' links.
 */
function cambridge_theme_toc_node_move_to_top_link($variables) {
  $content    = $variables['content'];
  $path_alias = drupal_get_path_alias($_GET['q']);
  $link       = '<div class="toc-top-links">';
  $link .= l(t('[top]'), $path_alias, array('fragment' => 'table-of-contents'));
  $link .= '</div>';

  $output = str_ireplace('</h2>', '</h2>' . $link, $content);

  return $output;
}

/**
 * Theme functions for aggregator block items.
 *
 * Adds date to standard output.
 */
function cambridge_theme_aggregator_block_item($variables) {

  $output = '<span class="campl-aggregator-item"> <a href="' . check_url($variables['item']->link) . '">' . check_plain($variables['item']->title) . "</a><br>";
  $output .= '<span class="campl-datestamp">' . format_date($variables['item']->timestamp, 'custom', 'd M Y') .'</span></span>';

  return $output;
}

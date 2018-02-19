<?php

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function cambridge_theme_form_system_theme_settings_alter(&$form, $form_state) {
  global $base_url;

  $form['cambridge'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme settings'),
    '#weight' => 0,
  );
  $form['cambridge']['colour_scheme'] = array(
    '#type' => 'select',
    '#title' => t('Colour scheme'),
    '#options' => array(
      1 => 'Blue',
      2 => 'Turquoise',
      3 => 'Purple',
      4 => 'Green',
      5 => 'Orange',
      6 => 'Red',
      7 => 'Grey',
      8 => 'Lime',
      9 => 'Blue-grey',
    ),
    '#default_value' => theme_get_setting('colour_scheme'),
  );
  $form['cambridge']['search_box'] = array(
    '#type' => 'radios',
    '#title' => t('Search box'),
    '#description' => t('Choose what the search box in the global navigation searches.'),
    '#options' => array(
      0 => t('Whole University'),
      1 => t('This site (ie ' . $base_url . ')'),
      2 => t('Search engine filter'),
    ),
    '#default_value' => theme_get_setting('search_box'),
  );
  $form['cambridge']['search_box_filter'] = array(
    '#type' => 'fieldset',
    '#title' => t('Filter settings'),
    '#description' => t('These details must match a filter configured in the University\'s search engine.'),
    '#states' => array(
      'visible' => array(
        ':input[name="search_box"]' => array('value' => 2),
      ),
    ),
  );
  $form['cambridge']['search_box_filter']['search_box_filter_inst'] = array(
    '#type' => 'textfield',
    '#title' => t('Institution filter code'),
    '#default_value' => theme_get_setting('search_box_filter_inst'),
    '#states' => array(
      'visible' => array(
        ':input[name="search_box"]' => array('value' => 2),
      ),
      'required' => array(
        ':input[name="search_box"]' => array('value' => 2),
      ),
    ),
  );
  $form['cambridge']['search_box_filter']['search_box_filter_tag'] = array(
    '#type' => 'textfield',
    '#title' => t('Tag'),
    '#default_value' => theme_get_setting('search_box_filter_tag'),
    '#states' => array(
      'visible' => array(
        ':input[name="search_box"]' => array('value' => 2),
      ),
    ),
  );

  // Hide reference to non-existent default logo.
  $form['logo']['default_logo']['#type'] = 'hidden';
  $form['logo']['default_logo']['#default_value'] = 0;
  unset($form['logo']['settings']['#states']);
  $form['logo']['settings']['logo_path']['#description'] =
    t('The path to the file you would like to use as your logo file.');
}

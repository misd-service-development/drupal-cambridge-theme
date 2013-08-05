<?php

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function cambridge_theme_form_system_theme_settings_alter(&$form, $form_state) {
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
      7 => 'Gray',
    ),
    '#default_value' => theme_get_setting('colour_scheme'),
  );

  unset($form['logo']['default_logo']);
}

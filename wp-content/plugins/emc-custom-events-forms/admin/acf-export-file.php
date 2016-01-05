<?php

/**
 * ACF exported code to be executed on activation only.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/includes
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_568af8278fd8f',
  'title' => 'Coach',
  'fields' => array (
    array (
      'key' => 'field_568af8ef635d4',
      'label' => 'Coach',
      'name' => 'coach',
      'type' => 'user',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'role' => array (
        0 => 'coach',
      ),
      'allow_null' => 0,
      'multiple' => 1,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'user_role',
        'operator' => '==',
        'value' => 'teacher',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

endif;

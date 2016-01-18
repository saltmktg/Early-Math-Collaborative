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

acf_add_local_field_group(array (
  'key' => 'group_56951e5fcdc88',
  'title' => 'Event custom fields',
  'fields' => array (
    array (
      'key' => 'field_56951e633abce',
      'label' => 'Event Coach',
      'name' => 'event_coach',
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
        0 => 'coach-events',
      ),
      'allow_null' => 0,
      'multiple' => 0,
    ),
    array (
      'key' => 'field_569cd6d23db6d',
      'label' => 'Event Form',
      'name' => 'event_form',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => '',
      'max' => '',
      'layout' => 'table',
      'button_label' => 'Add Row',
      'sub_fields' => array (
        array (
          'key' => 'field_569cd6f67ee79',
          'label' => 'Form',
          'name' => 'form',
          'type' => 'gravity_forms_field',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'allow_null' => 0,
          'allow_multiple' => 0,
        ),
      ),
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'tribe_events',
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

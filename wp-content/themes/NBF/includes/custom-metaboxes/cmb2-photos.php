<?php

$photo_details = new_cmb2_box([
  'id'           => 'photo_details',
  'title'        => __('Photo Details', 'nbf'),
  'object_types' => ['photos'],
  'context'      => 'normal',
  'priority'     => 'high',
  'show_names'   => true
]);

$photo_details->add_field([
  'desc' => __('Enter the date', 'nbf'),
  'id'   => $prefix . 'photo_date',
  'type' => 'text'
]);

$photo_details->add_field([
  'desc' => __('Enter the location', 'nbf'),
  'id'   => $prefix . 'photo_location',
  'type' => 'text'
]);

$photo_details->add_field([
  'desc' => __('Enter the crew names', 'nbf'),
  'id'   => $prefix . 'photo_crew',
  'type' => 'textarea'
]);

$photo_details->add_field([
  'desc' => __('Enter the technical details', 'nbf'),
  'id'   => $prefix . 'photo_techs',
  'type' => 'textarea'
]);

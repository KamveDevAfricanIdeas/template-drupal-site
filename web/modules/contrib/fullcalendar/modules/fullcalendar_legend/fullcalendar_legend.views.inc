<?php

/**
 * @file
 * Provide views data for the Fullcalendar Legend module.
 */

/**
 * Implements hook_views_data().
 */
function fullcalendar_legend_views_data(): array {

  $data['views']['fullcalendar_legend'] = [
    'title' => t('Fullcalendar Legend'),
    'help' => t('Show a legend for color options used in a Fullcalendar display.'),
    'area' => [
      'id' => 'fullcalendar_legend',
    ],
  ];

  return $data;
}

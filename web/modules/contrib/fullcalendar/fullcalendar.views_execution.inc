<?php

/**
 * @file
 * Contains Views module runtime hooks.
 */

use Drupal\Component\Utility\Html;
use Drupal\views\Plugin\views\query\QueryPluginBase;
use Drupal\views\Plugin\views\query\Sql;
use Drupal\views\ViewExecutable;

/**
 * Implements hook_views_pre_view().
 *
 * Add an argument that provides the current date for each date field present.
 */
function fullcalendar_views_pre_view(ViewExecutable $view, string $display_id, array $args): void {
  $style = $view->display_handler->getOption('style');

  if ($style['type'] !== 'fullcalendar') {
    return;
  }

  // Get the current view settings.
  $view->initStyle();
  /** @var \Drupal\fullcalendar\Plugin\views\style\FullCalendar $view_style */
  $view_style = $view->style_plugin;

  $settings = $view->style_plugin->options;

  foreach ($view_style->getPlugins() as $plugin) {
    $plugin->preView($settings);
  }

  if (empty($view->display_handler->getOption('use_ajax'))) {
    $view->style_plugin->options = $settings;
    return;
  }

  $settings['fullcalendar_fields_count'] = 0;
  $exposed_input = $view->getExposedInput();

  /** @var \Drupal\Core\Entity\EntityFieldManagerInterface $field_manager */
  $field_manager = \Drupal::service('entity_field.manager');

  $entity_type = $view->getBaseEntityType();
  $entity_type_id = $entity_type->id();

  $field_storages = $field_manager->getFieldStorageDefinitions($entity_type_id);

  // Loop through each date field and provide an argument for it.
  foreach ($view->display_handler->getHandlers('field') as $field) {
    /** @var \Drupal\views\Plugin\views\field\EntityField $field */
    if (!fullcalendar_field_is_date($field)) {
      continue;
    }

    $field_storage = $field_storages[$field->definition['field_name']];

    // Default table name for the field.
    $field_table = $field_storage->getTargetEntityTypeId() . '__' . $field_storage->getName();

    // If the field is a DateRecur field, need to apply table prefix.
    if ($field_storage->getType() === 'date_recur') {
      $field_table = 'date_recur__' . $field_table;
    }

    $field_value = $field_storage->getName() . '_value';

    // @todo The next 24 lines are a duplicate of
    //   \Drupal\fullcalendar\Plugin\views\style\FullCalendar::getExposedDates
    //   Lines 509ff.
    // Min and Max dates for exposed filter.
    $dateMin = new DateTime();
    $dateMax = new DateTime();

    // First, we try to set initial Min and Max date values based on the
    // exposed form values.
    // @todo These offsets don't seem to be possible.
    // @phpstan-ignore-next-line
    if (isset($exposed_input[$field_value]['min'], $exposed_input[$field_value]['max'])) {
      $dateMin->setTimestamp(strtotime($exposed_input[$field_value]['min']));
      $dateMax->setTimestamp(strtotime($exposed_input[$field_value]['max']));
    }
    // If no exposed values set, use user-defined date values.
    elseif (!empty($settings['date']['month']) && !empty($settings['date']['year'])) {
      $ts = mktime(0, 0, 0, $settings['date']['month'] + 1, 1, $settings['date']['year']);

      $dateMin->setTimestamp($ts);
      $dateMax->setTimestamp($ts);

      $dateMin->modify('first day of this month');
      $dateMax->modify('first day of next month');
    }
    // Use default 1 month date-range.
    else {
      $dateMin->modify('first day of this month');
      $dateMax->modify('first day of next month');
    }

    $options = [
      'exposed'   => TRUE,
      'form_type' => 'date_select',
      'operator'  => 'between',
      'value'     => [
        'type' => 'date',
        'min'  => $dateMin->format('Y-m-d'),
        'max'  => $dateMax->format('Y-m-d'),
      ],
      'group'     => 'fullcalendar',
    ];

    if (!empty($field->options['relationship'])) {
      $options['relationship'] = $field->options['relationship'];
    }

    $option_id = $view->addHandler($display_id, 'filter', $field_table, $field_value, $options);

    $settings['fullcalendar_fields'][$option_id] = Html::getClass($option_id);
    $settings['fullcalendar_fields_count']++;

    $view->setHandlerOption($display_id, 'filter', $option_id, 'expose', [
      'identifier' => $option_id,
      'operator'   => $option_id . '_op',
    ]);
  }

  // Needs for JavaScript.
  $settings['ajax'] = $view->display_handler->getOption('use_ajax');

  $view->style_plugin->options = $settings;
}

/**
 * Implements hook_views_query_alter().
 */
function fullcalendar_views_query_alter(ViewExecutable $view, QueryPluginBase $query): void {
  $style = $view->display_handler->getOption('style');

  if ($style['type'] !== 'fullcalendar') {
    return;
  }

  if (!$query instanceof Sql) {
    return;
  }

  // Force the query to be distinct.
  $query->distinct = TRUE;

  // Try to add additional condition to the query.
  foreach ($query->where as $group => &$condition_group) {
    if ($group !== 'fullcalendar') {
      continue;
    }

    // Prepare array for extracted query data.
    $data = [
      'field_min' => NULL,
      'field_max' => NULL,
      'date_min'  => NULL,
      'date_max'  => NULL,
    ];

    foreach ($condition_group['conditions'] as $condition) {
      // Try to extract field names from the current condition.
      $parts = explode(' BETWEEN ', $condition['field']);
      if (count($parts) !== 2) {
        continue;
      }

      $data['field_min'] = $parts[0];
      $data['field_max'] = str_replace('_value,', '_end_value,', $data['field_min']);

      // Try to extract dates from the current condition.
      $parts = explode(' AND ', $parts[1]);
      if (count($parts) !== 2) {
        continue;
      }

      $data['date_min'] = $parts[0];
      $data['date_max'] = $parts[1];
    }

    // If 'date_max' exists, then all required values exist, so we can add our
    // custom conditions.
    if (!empty($data['date_max'])) {
      // Change condition group type to 'OR'.
      $condition_group['type'] = 'OR';

      $or_conditions = [];

      // If event starts before and ends after the first day of the calendar.
      // 'event_start' <= 'calendar_start' AND 'event_end' >= 'calendar_start'.
      $or_conditions[] = $data['field_min'] . ' <= ' . $data['date_min'] . ' AND ' . $data['field_max'] . ' >= ' . $data['date_min'];

      // Add additional condition to the group.
      $condition_group['conditions'][] = [
        'field'    => '(' . implode(') OR (', $or_conditions) . ')',
        'value'    => [],
        'operator' => 'formula',
      ];
    }
  }
}

/**
 * Implements hook_views_ajax_data_alter().
 */
function fullcalendar_views_ajax_data_alter(array &$commands, ViewExecutable $view): void {
  // @todo This hook doesn't seem to exist, does it?
  $style = $view->display_handler->getOption('style');

  if ($style['type'] !== 'fullcalendar') {
    $commands = [];
  }
}

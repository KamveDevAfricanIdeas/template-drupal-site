<?php

/**
 * @file
 * Hooks provided by the FullCalendar module.
 */

/**
 * @addtogroup hooks
 * @{
 */

use Drupal\Core\Entity\EntityInterface;
use Drupal\views\Entity\View;

/**
 * Constructs CSS classes for an entity.
 *
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   Object representing the entity.
 *
 * @return array
 *   Array of CSS classes.
 */
function hook_fullcalendar_classes(EntityInterface $entity): array {
  // Add the entity type as a class.
  return [
    $entity->getEntityTypeId(),
  ];
}

/**
 * Alter the CSS classes for an entity.
 *
 * @param array $classes
 *   Array of CSS classes.
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   Object representing the entity.
 */
function hook_fullcalendar_classes_alter(array &$classes, EntityInterface $entity): void {
  // Remove all classes set by modules.
  $classes = [];
}

/**
 * Declare that you provide a droppable callback.
 *
 * Implementing this hook will cause a checkbox to appear on the view settings,
 * when checked FullCalendar will search for JS callbacks in the form
 * Drupal.fullcalendar.droppableCallbacks.MODULENAME.callback.
 *
 * @see http://arshaw.com/fullcalendar/docs/dropping/droppable
 */
function hook_fullcalendar_droppable(): bool {
  // This hook will never be executed.
  return TRUE;
}

/**
 * Allows your module to affect the edit ability of the calendar.
 *
 * If any module implementing this hook returns FALSE, the value will be set to
 * FALSE. Use hook_fullcalendar_editable_alter() to override this if necessary.
 *
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   Object representing the entity.
 * @param \Drupal\views\Entity\View $view
 *   Object representing the view.
 *
 * @return bool
 *   A Boolean value dictating whether of not the calendar is editable.
 */
function hook_fullcalendar_editable(EntityInterface $entity, View $view): bool {
  return TRUE;
}

/**
 * Allows your module to forcibly override the editability of the calendar.
 *
 * @param bool $editable
 *   A Boolean value dictating whether of not the calendar is editable.
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   Object representing the entity.
 * @param \Drupal\views\Entity\View $view
 *   Object representing the view.
 */
function hook_fullcalendar_editable_alter(bool &$editable, EntityInterface $entity, View $view): void {
  $editable = FALSE;
}

/**
 * Alter the dates after they're loaded, before they're added for rendering.
 *
 * @param \DateTime $date1
 *   The start date object.
 * @param \DateTime $date2
 *   The end date object.
 * @param array $context
 *   An associative array containing the following key-value pairs:
 *   - instance: The field instance.
 *   - entity: The entity object for this date.
 *   - field: The field info.
 */
function hook_fullcalendar_process_dates_alter(\DateTime &$date1, \DateTime &$date2, array $context): void {
  // Always display dates only on one day.
  if ($date1->format('Y-m-d-H-i-s') !== $date2->format('Y-m-d-H-i-s')) {
    $date2 = $date1;
  }
}

/**
 * @} End of "addtogroup hooks".
 */

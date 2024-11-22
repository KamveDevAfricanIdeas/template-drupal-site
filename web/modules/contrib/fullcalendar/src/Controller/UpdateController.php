<?php

namespace Drupal\fullcalendar\Controller;

use Drupal\Core\Access\CsrfTokenGenerator;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\DependencyInjection\ClassResolverInterface;
use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\Core\Link;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Render\Renderer;
use Drupal\Core\Url;
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItemInterface;
use Drupal\smart_date_recur\Controller\Instances;
use Drupal\smart_date_recur\Entity\SmartDateOverride;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller to drop an entity from the calendar.
 */
class UpdateController extends ControllerBase {

  /**
   * The class resolver service.
   *
   * @var \Drupal\Core\DependencyInjection\ClassResolverInterface
   */
  protected $classResolver;

  /**
   * CSRF Token.
   *
   * @var \Drupal\Core\Access\CsrfTokenGenerator
   */
  protected $csrfToken;

  // Fullcalendar is using defaultTimedEventDuration parameter
  // for event objects without a specified end value:
  // see https://fullcalendar.io/docs/v4/defaultTimedEventDuration -
  // so taking the value of 1 hour in seconds here,
  // not sure how to get this from the JS here.
  // @todo Get this from the configuration of Fullcalendar somehow.
  /**
   * The default duration for a new event.
   *
   * @var int
   */
  protected $defaultTimedEventDuration = 60 * 60;

  /**
   * Whether or not to convert timezones.
   *
   * @var bool
   */
  protected $convertTzs = TRUE;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected Renderer $renderer;

  /**
   * Construct a FullCalendar controller.
   *
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerFactory
   *   Logger factory object.
   * @param \Drupal\Core\Access\CsrfTokenGenerator $csrfToken
   *   CSRF token factory object.
   * @param \Drupal\Core\DependencyInjection\ClassResolverInterface $classResolver
   *   The class resolver service.
   */
  final public function __construct(
    LoggerChannelFactoryInterface $loggerFactory,
    CsrfTokenGenerator $csrfToken,
    ClassResolverInterface $classResolver,
  ) {
    $this->loggerFactory = $loggerFactory;
    $this->csrfToken = $csrfToken;
    $this->classResolver = $classResolver;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('logger.factory'),
      $container->get('csrf_token'),
      $container->get('class_resolver'),
    );
  }

  /**
   * Drops an entity from the calendar.
   *
   * @param \Drupal\Core\Entity\FieldableEntityInterface $entity
   *   The entity.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The json response.
   */
  public function drop(FieldableEntityInterface $entity, Request $request): JsonResponse {
    // Extract data from JSON request.
    $json = $request->getContent();
    $new_data = json_decode($json, TRUE);
    $domId = $new_data['token'] ?? '';

    // Validate the CSRF token.
    $user = $this->currentUser();
    if (!$user->isAnonymous()) {
      $csrf_token = $new_data['token'];
      if (!$this->csrfToken->validate($csrf_token)) {
        return $this->createError($this->t('Access denied!'), $domId);
      }
    }

    // Validate user access to make the change.
    if (!$entity->access('update')) {
      return $this->createError($this->t('Access denied!'), $domId);
    }

    if (empty($new_data)) {
      return $this->createError($this->t('Invalid data'), $domId, 400);
    }

    if (!isset($new_data['eid']) || empty($new_data['start']) || empty($new_data['startField'])) {
      return $this->createError($this->t('Necessary data is missing'), $domId, 400);
    }
    if (!$entity->hasField($new_data['startField'])) {
      return $this->createError($this->t('Invalid date field'), $domId, 400);
    }

    $this->convertTzs = $new_data['convertTzs'] ?? TRUE;

    switch ($new_data['type']) {
      // @todo write functions for other field types.
      case 'smartdate':
        $this->updateSmartDate($entity, $new_data);
        break;

      default:
        $this->updateDatetime($entity, $new_data);
    }

    $url = Url::fromUserInput('/');
    $link = Link::fromTextAndUrl($this->t('Close'), $url);
    $link = $link->toRenderable();
    $link['#attributes']['class'][] = 'fullcalendar-status-close';

    $message = $this->t('The new event time has been saved.');

    return new JsonResponse([
      'msg'    => $message,
      'dom_id' => $request->request->get('dom_id'),
    ]);
  }

  /**
   * Helper function to return a JSON error.
   *
   * @param string $message
   *   The message to display to the user.
   * @param string $domId
   *   The target element.
   * @param int $status
   *   HTTP status code to return.
   */
  protected function createError(string $message, string $domId, int $status = 403): JsonResponse {
    return new JsonResponse([
      'error'    => $message,
      'dom_id' => $domId,
    ],
    $status,
    );
  }

  /**
   * Helper function to update Datetime fields.
   *
   * @param \Drupal\Core\Entity\FieldableEntityInterface $entity
   *   The entity to be updated.
   * @param array $new_data
   *   The data to use for the update.
   */
  protected function updateDatetime(FieldableEntityInterface $entity, array $new_data): void {
    $delta = $new_data['eid'];
    $start_field = $new_data['startField'];
    $end_field = $new_data['endField'];
    $start_date = $new_data['start'];
    $end_date = $new_data['end'];

    // Ignore time zones for all day events.
    if ($new_data['allDay']) {
      $start_date = substr($start_date, 0, 10);
      $end_date = ($end_date) ? substr($end_date, 0, 10) : $start_date;
    }
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);
    if ($new_data['allDay']) {
      // Fullcalendar sets the time of all day events to 12am of the last day.
      $end_date += 1440 * 60 - 1;
    }

    // If necessary, convert the time values for storage.
    if ($new_data['type'] !== 'timestamp') {
      $start_date = $this->prepareDatetime($start_date);
      $end_date = $this->prepareDatetime($end_date);
    }

    $entity->{$start_field}[$delta]->value = $start_date;
    if ($start_field === $end_field) {
      $entity->{$start_field}[$delta]->end_value = $end_date;
    }
    else {
      $entity->{$end_field}[$delta]->value = $end_date;
    }
    $entity->save();
  }

  /**
   * Helper function to update Smart Date fields.
   *
   * @param \Drupal\Core\Entity\FieldableEntityInterface $entity
   *   The entity to be updated.
   * @param array $new_data
   *   The data to use for the update.
   */
  protected function updateSmartDate(FieldableEntityInterface $entity, array $new_data): void {
    $eid = $new_data['eid'];
    $start_field = $new_data['startField'];
    $end_field = $new_data['endField'];
    $start_date = $new_data['start'];
    $end_date = $new_data['end'];

    $empty_end = FALSE;
    if (empty($end_date)) {
      $end_date = $start_date;
      $empty_end = TRUE;
    }
    // Ignore time zones for all day events.
    if ($new_data['allDay']) {
      $start_date = substr($start_date, 0, 10);
      $end_date = substr($end_date, 0, 10);
    }
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);
    if ($new_data['allDay']) {
      if ($empty_end) {
        // Cloned from start, so set to end of day.
        $end_date += 1439 * 60;
      }
      else {
        // Fullcalendar sets the time of all day events to 12am of the last day.
        $end_date -= 60;
      }
    }
    else {
      if ($empty_end) {
        // Add the default duration from the field configuration.
        $end_date += $this->getDefaultDuration($end_field, $entity);
      }
    }
    $duration = round(($start_date - $end_date) / 60);

    // Recurring event eid values start with "R-".
    if (strpos($eid, 'R-') === 0) {
      $id = explode('-', $eid);
      /** @var \Drupal\smart_date_recur\Entity\SmartDateRule $rule */
      $rule = $this->entityTypeManager()
        ->getStorage('smart_date_rule')
        ->load($id[1]);

      $timezone = $rule->getTimeZone() ?? '';
      if ($new_data['allDay'] || ($empty_end && $timezone && !$this->convertTzs)) {
        $start_date = $this->remapToTimezone($start_date, $timezone);
        $end_date = $this->remapToTimezone($end_date, $timezone);
      }

      // Load overridden instances from rule object.
      $instances = $rule->getRuleInstances();
      $rrule_index = $id[3];
      $instance = $instances[$rrule_index];

      if (isset($instance['oid'])) {
        $override = SmartDateOverride::load($instance['oid']);
        $override->set('value', $start_date);
        $override->set('end_value', $end_date);
        $override->set('duration', $duration);
      }
      else {
        $values = [
          'rrule'       => $rule->id(),
          'rrule_index' => $rrule_index,
          'value'       => $start_date,
          'end_value'   => $end_date,
          'duration'    => $duration,
        ];
        $override = SmartDateOverride::create($values);
      }
      $override->save();
      /** @var \Drupal\smart_date_recur\Controller\Instances $instancesController */
      $instancesController = $this->classResolver->getInstanceFromDefinition(Instances::class);
      $instancesController->applyChanges($rule);
    }
    else {
      $delta = $eid;

      $timezone = $entity->{$start_field}[$delta]->timezone ?? '';
      if ($new_data['allDay'] || ($empty_end && $timezone && !$this->convertTzs)) {
        $start_date = $this->remapToTimezone($start_date, $timezone);
        $end_date = $this->remapToTimezone($end_date, $timezone);
      }

      $entity->{$start_field}[$delta]->value = $start_date;
      $entity->{$end_field}[$delta]->end_value = $end_date;
      $entity->{$start_field}[$delta]->duration = $duration;
      $entity->save();
    }
  }

  /**
   * Conditionally convert a DrupalDateTime object to a timestamp.
   *
   * @param int $time
   *   The time to be converted.
   */
  public static function prepareDatetime(int $time): string {
    $storage_timezone = new \DateTimeZone(DateTimeItemInterface::STORAGE_TIMEZONE);
    $datetime = DrupalDateTime::createFromTimestamp($time);
    return $datetime->setTimezone($storage_timezone)->format(DateTimeItemInterface::DATETIME_STORAGE_FORMAT);
  }

  /**
   * Get the configured default duration.
   *
   * @param string $field_name
   *   The field from which to retrieve the default.
   * @param \Drupal\Core\Entity\FieldableEntityInterface $entity
   *   The entity to be updated.
   *
   * @return int|false
   *   The configured duration, or FALSE if it could not be retrieved.
   */
  protected function getDefaultDuration(string $field_name, FieldableEntityInterface $entity): int|false {
    $definitions = $entity->getFieldDefinitions();
    if (isset($definitions[$field_name])) {
      $defaults_set = $definitions[$field_name]->getDefaultValueLiteral();
      $defaults = array_shift($defaults_set);
      return $defaults['default_duration'] * 60;
    }
    return FALSE;
  }

  /**
   * Remap a timestamp to the same time of day in a different timezone.
   *
   * @param int $time
   *   The timestamp to remap.
   * @param string $timezone
   *   The timezone into which the time should be changed.
   *
   * @return int
   *   A new timestamp representing the same time in the new timezone.
   */
  protected function remapToTimezone(int $time, string $timezone): int {
    $date = DrupalDateTime::createFromTimestamp($time);
    $date_array = [
      'year' => $date->format('Y'),
      'month' => $date->format('n'),
      'day' => $date->format('j'),
      'hour' => $date->format('H'),
      'minute' => $date->format('i'),
      'second' => $date->format('s'),
    ];
    $remapped_date = DrupalDateTime::createFromArray($date_array, $timezone);
    return (int) $remapped_date->format('U');
  }

}

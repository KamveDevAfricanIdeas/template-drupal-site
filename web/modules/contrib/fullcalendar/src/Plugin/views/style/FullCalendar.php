<?php

namespace Drupal\fullcalendar\Plugin\views\style;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Component\Render\MarkupInterface;
use Drupal\Component\Utility\Html;
use Drupal\Core\Access\AccessManagerInterface;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\fullcalendar\Plugin\FullcalendarBase;
use Drupal\fullcalendar\Plugin\FullcalendarPluginCollection;
use Drupal\fullcalendar\Plugin\fullcalendar\type\OptionsFormHelperTrait;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the FullCalendar views style plugin.
 *
 * @ViewsStyle(
 *   id = "fullcalendar",
 *   title = @Translation("FullCalendar"),
 *   help = @Translation("Displays items on a calendar."),
 *   theme = "views_view--fullcalendar",
 *   display_types = {"normal"}
 * )
 */
class FullCalendar extends StylePluginBase {

  use OptionsFormHelperTrait;

  /**
   * {@inheritdoc}
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesGrouping = FALSE;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected ModuleHandlerInterface $moduleHandler;

  /**
   * Entity Field Manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected EntityFieldManagerInterface $fieldManager;

  /**
   * Stores the FullCalendar plugins used by this style plugin.
   *
   * @var \Drupal\fullcalendar\Plugin\FullcalendarPluginCollection
   */
  protected FullcalendarPluginCollection $pluginBag;

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   *   The date formatter service.
   */
  protected DateFormatter $dateFormatter;

  /**
   * The date and time service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected TimeInterface $dateTime;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected LanguageManagerInterface $languageManager;

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected EntityFieldManagerInterface $entityFieldManager;

  /**
   * The access manager.
   *
   * @var \Drupal\Core\Access\AccessManagerInterface
   */
  protected AccessManagerInterface $accessManager;

  /**
   * The CSRF token generator.
   *
   * @var \Drupal\Core\Access\CsrfTokenGenerator
   */
  protected $tokenGenerator;

  /**
   * An array of color mappings.
   *
   * @var array
   */
  protected $eventColors = [];

  /**
   * Whether or not to convert timezones.
   *
   * @var bool
   */
  protected $convertTzs = TRUE;

  /**
   * {@inheritdoc}
   */
  public function evenEmpty(): bool {
    return TRUE;
  }

  /**
   * Get all available FullCalendar plugins.
   *
   * @return \Drupal\fullcalendar\Plugin\FullcalendarPluginCollection
   *   The available plugins.
   */
  public function getPlugins(): FullcalendarPluginCollection {
    return $this->pluginBag;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): static {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->pluginBag = new FullcalendarPluginCollection($container->get('plugin.manager.fullcalendar'), $instance);
    $instance->moduleHandler = $container->get('module_handler');
    $instance->fieldManager = $container->get('entity_field.manager');
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->messenger = $container->get('messenger');
    $instance->dateTime = $container->get('datetime.time');
    $instance->languageManager = $container->get('language_manager');
    $instance->entityFieldManager = $container->get('entity_field.manager');
    $instance->accessManager = $container->get('access_manager');
    $instance->tokenGenerator = $container->get('csrf_token');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions(): array {
    $options = parent::defineOptions();

    /** @var \Drupal\fullcalendar\Plugin\fullcalendar\type\FullCalendar $plugin */
    foreach ($this->getPlugins() as $plugin) {
      if ($plugin instanceof FullcalendarBase) {
        $options += $plugin->defineOptions();
      }
    }

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state): void {
    parent::buildOptionsForm($form, $form_state);

    /** @var \Drupal\fullcalendar\Plugin\fullcalendar\type\FullCalendar $plugin */
    foreach ($this->getPlugins() as $plugin) {
      if ($plugin instanceof FullcalendarBase) {
        $plugin->buildOptionsForm($form, $form_state);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state): void {
    parent::submitOptionsForm($form, $form_state);

    /** @var \Drupal\fullcalendar\Plugin\fullcalendar\type\FullCalendar $plugin */
    foreach ($this->getPlugins() as $plugin) {
      if ($plugin instanceof FullcalendarBase) {
        $plugin->submitOptionsForm($form, $form_state);
      }
    }
  }

  /**
   * Extracts date fields from the view.
   */
  public function parseFields(): array {
    $this->view->initHandlers();
    $labels = $this->displayHandler->getFieldLabels();

    $date_fields = [];

    /** @var \Drupal\views\Plugin\views\field\EntityField $field */
    foreach ($this->view->field as $id => $field) {
      if (fullcalendar_field_is_date($field)) {
        $date_fields[$id] = $labels[$id];
      }
    }

    return $date_fields;
  }

  /**
   * {@inheritdoc}
   */
  public function validate() {
    $settings = $this->prepareSettings();
    if ($this->displayHandler->display['display_plugin'] !== 'default' && empty($settings['google']['googleCalendarApiKey']) && !$this->parseFields()) {
      $this->messenger->deleteAll();
      $this->messenger->addWarning($this->t('Display "@display" requires at least one date field unless you are displaying data from a Google Calendar.', [
        '@display' => $this->displayHandler->display['display_title'],
      ]), TRUE);
    }

    return parent::validate();
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    return [
      '#theme' => $this->themeFunctions(),
      '#view' => $this->view,
      '#options' => $this->options,
      '#attached' => $this->prepareAttached(),
    ];
  }

  /**
   * Load libraries.
   *
   * @throws \Exception
   */
  protected function prepareAttached(): array {
    $attached['library'][] = 'fullcalendar/drupal.fullcalendar';

    $settings = $this->prepareSettings();

    if (!empty($settings['options']['themeSystem']) && ($settings['options']['themeSystem'] !== 'standard')) {
      $attached['library'][] = 'fullcalendar/fullcalendar.' . $settings['options']['themeSystem'];
    }

    if (!empty($settings['locale']) && $settings['locale'] !== 'en') {
      $attached['library'][] = 'fullcalendar/fullcalendar.locales';
    }

    $attached['drupalSettings']['fullcalendar'] = [
      'js-view-dom-id-' . $this->view->dom_id => $settings,
    ];

    return $attached;
  }

  /**
   * Prepare JavaScript settings.
   *
   * @throws \Exception
   */
  protected function prepareSettings(): array {
    $settings = &drupal_static(__METHOD__, []);

    if (empty($settings)) {
      /** @var \Drupal\fullcalendar\Plugin\fullcalendar\type\FullCalendar $plugin */
      foreach ($this->getPlugins() as $plugin) {
        $plugin->process($settings);
      }
    }

    // Google Calendar events.
    if (!empty($settings['options']['googleCalendarApiKey'])) {
      $ids = array_map('trim', explode(',', trim($settings['googleCalendarId'])));
      foreach ($ids as $id) {
        $settings['options']['eventSources'][] = [
          'googleCalendarId' => $id,
          'className' => 'fc-event-default',
        ];
      }
    }

    // Make any color settings available for event processing.
    if ($settings['colors']) {
      $this->eventColors = $settings['colors'];
    }

    if (isset($settings['convert_timezones'])) {
      $this->convertTzs = $settings['convert_timezones'];
    }

    // Drupal events.
    $events = $this->prepareEvents();
    if ($events) {
      $settings['options']['eventSources'][] = $events;
    }
    $settings['entityType'] = $this->view->getBaseEntityType()->id();
    if (!empty($settings['bundle_type'])) {
      // Can the user add a new event?
      if ($settings['entityType'] === 'node') {
        if ($this->accessManager->checkNamedRoute('node.add', ['node_type' => 'article'])) {
          $settings['addLink'] = 'node/add/' . $settings['bundle_type'];
        }
      }
      else {
        $entity_type = $this->view->getBaseEntityType();
        $entity_links = $entity_type->get('links');
        if (isset($entity_links['add-form'])) {
          $settings['addLink'] = str_replace('{' . $entity_type->id() . '}', $settings['bundle_type'], $entity_links['add-form']);
        }
        elseif (isset($entity_links['add-page'])) {
          $settings['addLink'] = str_replace('{' . $entity_type->id() . '}', $settings['bundle_type'], $entity_links['add-page']);
        }
      }
    }
    // Current user.
    $user = $this->view->getUser();
    // CSRF token.
    $token = '';
    if (!$user->isAnonymous()) {
      $token = $this->tokenGenerator->get();
    }
    $settings['token'] = $token;
    $settings['timeZone'] = date_default_timezone_get();

    $settings['locale'] = $this->languageManager->getCurrentLanguage()->getId();
    $settings['convertTzs'] = $this->convertTzs;

    return $settings;
  }

  /**
   * Prepare events for calendar.
   *
   * @return array
   *   Array of events ready for fullcalendar.
   *
   * @throws \Exception
   */
  protected function prepareEvents(): array {
    $events = [];

    $title_field = $this->options['title_field'] ?? '';

    foreach ($this->view->result as $delta => $row) {
      $this->view->row_index = $row->index;

      /** @var \Drupal\Core\Entity\EntityInterface $entity */
      $entity = $row->_entity;

      // Collect only date fields.
      $date_fields = [];
      // Collect prepared events.
      $event = [];

      // Prepare title.
      $title = '';
      if ($title_field && $entity instanceof FieldableEntityInterface && $entity->hasField($title_field)) {
        // Retrieve the rewritten field value.
        $title = $this->view->style_plugin->getField($row->index, $title_field);
        if ($title instanceof MarkupInterface) {
          $title = strip_tags($title->__toString());
        }
      }
      // Default to the entity label if no other value found.
      if (!$title) {
        $title = $entity->label();
      }

      /** @var \Drupal\views\Plugin\views\field\EntityField $field */
      foreach ($this->view->field as $field_name => $field) {
        if (fullcalendar_field_is_date($field)) {
          $field_storage_definitions = $this->fieldManager->getFieldStorageDefinitions($field->definition['entity_type']);
          $field_definition = $field_storage_definitions[$field->definition['field_name']];

          $values = $field->getItems($row);
          if (!empty($values)) {
            $date_fields[$field_name] = [
              'value' => $values,
              'field_alias' => $field->field_alias,
              'field_name' => $field_definition->getName(),
              'field_info' => $field_definition,
              'timezone_override' => $field->options['settings']['timezone_override'],
            ];
          }
        }
      }

      // @todo custom date field?
      // If using a custom date field, filter the fields to process.
      if (!empty($this->options['fields']['date'])) {
        $date_fields = array_intersect_key($date_fields, $this->options['fields']['date_field']);
      }

      // If there are no date fields, return.
      if (empty($date_fields)) {
        return $events;
      }

      foreach ($date_fields as $field) {
        /** @var \Drupal\Core\Field\FieldStorageDefinitionInterface $field_definition */
        $field_definition = $field['field_info'];
        // Get 'min' and 'max' dates appear in the Calendar.
        $date_range = $this->getExposedDates($field['field_name']);

        // "date_recur" field (with recurring date).
        if ($field_definition->getType() === 'date_recur') {
          /** @var \Drupal\date_recur\Plugin\Field\FieldType\DateRecurFieldItemList $field_items */
          $field_items = $row->_entity->{$field['field_name']};

          $isRecurring = FALSE;

          /** @var \Drupal\date_recur\Plugin\Field\FieldType\DateRecurItem $item */
          foreach ($field_items as $index => $item) {
            // @todo The method getOccurrenceHandler does not exist.
            // Get DateRecur Occurrence Handler.
            // @phpstan-ignore-next-line
            $occurrenceHandler = $item->getOccurrenceHandler();

            // If this field is a DateRecur field.
            if ($occurrenceHandler->isRecurring()) {
              // Get a list of occurrences for display.
              $occurrences = $occurrenceHandler->getOccurrencesForDisplay($date_range['min'], $date_range['max']);

              foreach ($occurrences as $occurrence) {
                /** @var \DateTime $start */
                $start = $occurrence['value'];
                /** @var \DateTime $end */
                $end = $occurrence['end_value'];

                $event = $this->prepareEvent($entity, $title, $field, (int) $index);
              }

              $isRecurring = TRUE;
            }
          }

          if ($isRecurring === TRUE) {
            // At this point, all DateRecur occurrences are merged into $rows
            // so we can continue adding date items with the next field.
            continue;
          }
        }

        // "datetime" and "daterange" fields or "date_recur" field (without
        // recurring date).
        foreach ($field['value'] as $index => $item) {
          // Start time is required!
          if (empty($item['raw']->value)) {
            continue;
          }

          $event = $this->prepareEvent($entity, $title, $date_fields, (int) $index);
          if (!empty($event)) {
            // @todo more sophisticated key assignment needed?
            $events[] = $event;
          }
        }
      }

      if (empty($events) && !empty($event)) {
        $events[$delta] = $event;
      }
    }

    return $events;
  }

  /**
   * Helper method to prepare an event.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   Event entity.
   * @param string $title
   *   The event title.
   * @param array $fields
   *   The fields.
   * @param int $delta
   *   Field delta.
   *
   * @return array
   *   The prepared event.
   */
  private function prepareEvent(EntityInterface $entity, string $title, array $fields, int $delta): array {
    $classes = $this->moduleHandler->invokeAll('fullcalendar_classes', [$entity]);
    $this->moduleHandler->alter('fullcalendar_classes', $classes, $entity);

    $classes = array_map([
      Html::class,
      'getClass',
    ], $classes);
    $class = (count($classes)) ? implode(' ', array_unique($classes)) : '';

    // Start/end dates.
    $event_start_end = $this->getEventStartEndDates($fields, $delta);

    $event_start = $event_start_end['start'];
    $event_end = $event_start_end['end'];

    $all_day = $this->isAllDayEvent($event_start_end);

    // Truncate all day events to reduce time zone issues.
    if ($all_day) {
      $event_start = substr($event_start, 0, 10);
      $end = new \DateTime(substr($event_end, 0, 10));
      // Fullcalendar reads end time as exclusive, so add a day.
      $end->modify('+1 day');
      $event_end = $end->format('Y-m-d');
    }

    $request_time = $this->dateTime->getRequestTime();
    $current_time = new \DateTime();
    $current_time->setTimestamp($request_time)->format(\DateTime::ATOM);

    // Add a class if the event was in the past or is in the future, based
    // on the end time. We can't do this in hook_fullcalendar_classes()
    // because the date hasn't been processed yet.
    if (($all_day && $event_start < $current_time) || (!$all_day && $event_end < $current_time)) {
      $time_class = 'fc-event-past';
    }
    elseif ($event_start > $current_time) {
      $time_class = 'fc-event-future';
    }
    else {
      $time_class = 'fc-event-now';
    }

    $editable = $entity->access('update', NULL, TRUE)->isAllowed();

    $event = [
      'id' => $entity->id(),
      'eid' => $event_start_end['eid'],
      'startField' => $event_start_end['startField'],
      'endField' => $event_start_end['endField'],
      'allDay' => $all_day,
      'start' => $event_start,
      'end' => $event_end,
      'editable' => $editable,
      'type' => $event_start_end['type'],
      'className' => $class . ' ' . $time_class,
      'title' => strip_tags(htmlspecialchars_decode($title, ENT_QUOTES)),
      'url' => $entity->toUrl('canonical', [
        'language' => $this->languageManager->getCurrentLanguage(),
      ])->toString(),
    ];

    if (!empty($this->eventColors)) {
      $event_style = [];
      // Look for a bundle style override.
      $bundle = $entity->bundle();
      $event_style = $this->eventColors['color_bundle'][$bundle] ?? [];
      // Emulate new structure if old config passed.
      if (!is_array($event_style)) {
        $event_style = ['color' => $event_style];
      }
      // Look for a taxonomy style override.
      if (!empty($this->eventColors['tax_field']) && $entity->hasField($this->eventColors['tax_field'])) {
        $term = $entity->get($this->eventColors['tax_field'])?->first();
        $term_id = $term?->getValue()['target_id'] ?? NULL;
        if ($term_id && !empty($this->eventColors['color_taxonomies'][$term_id])) {
          $term_style = $this->eventColors['color_taxonomies'][$term_id];
          if (!is_array($term_style)) {
            $term_style = ['color' => $term_style];
          }
          // Merge the styles found, with the term styles taking precedence.
          $event_style = $term_style + $event_style;
        }
      }
      if ($event_style) {
        foreach ($event_style as $key => $value) {
          $event[$key] = $value;
        }
      }
    }

    return $event;
  }

  /**
   * Get 'min' and 'max' dates appear in the calendar.
   *
   * @param string $field_name
   *   Field machine name.
   *
   * @return array
   *   An array with min and max dates.
   */
  public function getExposedDates(string $field_name): array {
    $dates = &drupal_static(__METHOD__, []);

    if (empty($dates[$field_name])) {
      $entity_type = $this->view->getBaseEntityType();
      $entity_type_id = $entity_type->id();

      $settings = $this->view->style_plugin->options;

      /** @var \Drupal\Core\Field\FieldStorageDefinitionInterface[] $field_storages */
      $field_storages = $this->entityFieldManager->getFieldStorageDefinitions($entity_type_id);
      /** @var \Drupal\Core\Field\FieldStorageDefinitionInterface $field_storage */
      $field_storage = $field_storages[$field_name];
      $field_value = $field_storage->getName() . '_value';

      $exposed_input = $this->view->getExposedInput();

      // Min and Max dates for exposed filter.
      $dateMin = new \DateTime();
      $dateMax = new \DateTime();

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

      $dates[$field_name] = [
        'min' => $dateMin,
        'max' => $dateMax,
      ];
    }

    return $dates[$field_name];
  }

  /**
   * Get start/end dates for an event.
   *
   * @param array $fields
   *   Array of date fields for the event.
   * @param int $delta
   *   Field delta.
   *
   * @return array
   *   The array of dates with 'start' and 'end' keys.
   */
  public function getEventStartEndDates(array $fields, $delta = 0): array {
    $event_start_end_date = [];
    $field = current($fields);
    $event_start_end_date['startField'] = key($fields);
    $event_start_end_date['endField'] = $event_start_end_date['startField'];
    $event_start_end_date['eid'] = $delta;
    /** @var \Drupal\Core\Field\FieldStorageDefinitionInterface $field_info */
    $field_info = $field['field_info'];

    $type = $field_info->getType();
    switch ($type) {
      case 'datetime':
        $field_names = array_keys($fields);

        if (count($field_names) === 1) {
          $event_start_end_date['start'] = $this->updateEventTimezone($field['value'][0]['raw']->value, $field['timezone_override']);
          $event_start_end_date['end'] = '';
        }
        else {
          $first = $this->updateEventTimezone($fields[$field_names[0]]['value'][0]['raw']->value, $fields[$field_names[0]]['timezone_override']);
          $second = $this->updateEventTimezone($fields[$field_names[1]]['value'][0]['raw']->value, $fields[$field_names[1]]['timezone_override']);

          if ($first > $second) {
            $event_start_end_date['start'] = $second;
            $event_start_end_date['end'] = $first;
          }
          else {
            $event_start_end_date['start'] = $first;
            $event_start_end_date['end'] = $second;
          }

          $event_start_end_date['endField'] = $field_names[1];
        }
        break;

      case 'daterange':
        $event_start_end_date['start'] = $this->updateEventTimezone($field['value'][0]['raw']->value, $field['timezone_override']);
        $end = $field['value'][0]['raw']->end_value;
        $event_start_end_date['end'] = !empty($end) ? $this->updateEventTimezone($end, $field['timezone_override']) : '';
        break;

      case 'date_recur':
        // @todo This needs to be implemented.
        break;

      case 'smartdate':
        $value = $field['value'][$delta]['raw']->getValue();
        // Append the id with necessary additional data.
        if (!empty($value['rrule'])) {
          $event_start_end_date['eid'] = 'R-' . $value['rrule'] . '-I-' . $value['rrule_index'];
        }

        $timezone = NULL;
        if (!$this->convertTzs && !empty($value['timezone'])) {
          $timezone = $value['timezone'];
        }
        $event_start_end_date['start'] = $this->dateFormatter->format($value['value'], 'custom', 'c', $timezone);
        $event_start_end_date['end'] = $this->dateFormatter->format($value['end_value'], 'custom', 'c', $timezone);
        break;
    }
    $event_start_end_date['type'] = $type;

    return $event_start_end_date;

  }

  /**
   * Update a date with timezone.
   *
   * @param string $datetime
   *   A datetime string.
   * @param string|null $tz_override
   *   Any timezone override for the date.
   *
   * @return string
   *   Formatted datetime with timezone applied.
   */
  public function updateEventTimezone(string $datetime, ?string $tz_override): string {
    $tz = (!$this->convertTzs && !empty($tz_override)) ? $tz_override : date_default_timezone_get();
    $timezone = new \DateTimeZone($tz);

    $dateTimezone = new \DateTime($datetime, new \DateTimeZone('UTC'));
    $dateTimezone->setTimezone($timezone);

    return $dateTimezone->format(\DateTime::ATOM);
  }

  /**
   * Check whether this is an all-day event.
   *
   * @param array $start_end_date
   *   Array of the start/end dates for the event.
   *
   * @return bool
   *   TRUE, if all day, otherwise FALSE.
   */
  public function isAllDayEvent(array $start_end_date): bool {
    if (empty($start_end_date['end'])) {
      $allDay = TRUE;
    }
    else {
      $allDay = FALSE;
      switch ($start_end_date['type']) {
        case 'smartdate':
          $start_time = substr($start_end_date['start'], 11, 5);
          $end_time = substr($start_end_date['end'], 11, 5);
          if ($start_time === '00:00' && $end_time === '23:59') {
            $allDay = TRUE;
          }
          break;

        default:
          $start_time = substr($start_end_date['start'], 11, 8);
          $end_time = substr($start_end_date['end'], 11, 8);
          if ($start_time === '00:00:00' && $end_time === '23:59:59') {
            $allDay = TRUE;
          }
      }
    }

    return $allDay;
  }

}

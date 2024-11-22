<?php

namespace Drupal\fullcalendar\Plugin\fullcalendar\type;

use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Trait with generic functions for FullCalendar plugins.
 */
trait OptionsFormHelperTrait {

  public const FC_DOCS_URL = 'https://fullcalendar.io/docs';

  public const COMMA_REPLACEMENT = '_COMMA_';

  /**
   * Get all FC default options that are supported.
   *
   * @return array
   *   Array of view options.
   */
  public function getDefaultOptions(): array {
    return [
      'header' => ['default' => "left:'title', center:'', right:'today prev,next'"],
      'footer' => ['default' => ''],
      'titleFormat' => ['default' => ''],
      'titleRangeSeparator' => ['default' => '\u2013'],
      'buttonText' => ['default' => "today:'today', month:'month', week:'week', day:'day', list:'list'"],
      'buttonIcons' => ['default' => "prev:'left-single-arrow', next:'right-single-arrow', prevYear:'left-double-arrow', nextYear:'right-double-arrow'"],
      'month_view' => ['default' => TRUE],
      'timegrid_view' => ['default' => TRUE],
      'list_view' => ['default' => TRUE],
      'daygrid_view' => ['default' => TRUE],
      'fields' => [
        'contains' => [
          'title' => ['default' => FALSE],
          'url' => ['default' => FALSE],
          'date' => ['default' => FALSE],
        ],
      ],
      'links' => [
        'contains' => [
          'navLinks' => ['default' => FALSE],
          'navLinkDayClick' => ['default' => ''],
          'navLinkWeekClick' => ['default' => ''],
          'updateConfirm' => ['default' => FALSE],
          'showMessages' => ['default' => FALSE],
        ],
      ],
      'event_format' => [
        'contains' => [
          'eventColor' => ['default' => '#3788d8'],
          'eventDisplay' => ['default' => 'auto'],
          'displayEventTime' => ['default' => TRUE],
          'nextDayThreshold' => ['default' => '00:00:00'],
        ],
      ],
      'month_view_settings' => [
        'contains' => [
          'fixedWeekCount' => ['default' => TRUE],
          'showNonCurrentDates' => ['default' => TRUE],
        ],
      ],
      'timegrid_view_settings' => [
        'contains' => [
          'allDaySlot' => ['default' => TRUE],
          'allDayContent' => ['default' => 'all-day'],
          'slotEventOverlap' => ['default' => TRUE],
          'timeGridEventMinHeight' => ['default' => ''],
        ],
      ],
      'list_view_settings' => [
        'contains' => [
          'listDayFormat' => ['default' => "weekday:'long'"],
          'listDayAltFormat' => ['default' => "month:'long', day:'numeric', year:'numeric'"],
          'noEventsMessage' => ['default' => 'No events to display'],
        ],
      ],
      'display' => [
        'contains' => [
          'initialView' => ['default' => 'dayGridMonth'],
          'firstDay' => ['default' => 0],
        ],
      ],
      'times' => [
        'contains' => [
          'weekends' => ['default' => TRUE],
          'hiddenDays' => ['default' => ''],
          'dayHeaders' => ['default' => TRUE],
        ],
      ],
      'views_year' => [
        'contains' => [
          'listYear_buttonText' => ['default' => "buttonText: 'list'"],
          'listYear_titleFormat' => ['default' => "year: 'numeric'"],
        ],
      ],
      'views_month' => [
        'contains' => [
          'listMonth_buttonText' => ['default' => "buttonText: 'list'"],
          'listMonth_titleFormat' => ['default' => "year: 'numeric', month: 'long'"],
          'dayGridMonth_buttonText' => ['default' => "buttonText: 'month'"],
          'dayGridMonth_titleFormat' => ['default' => "year: 'numeric', month: 'long'"],
          'dayGridMonth_dayHeaderFormat' => ['default' => "weekday:'short'"],
        ],
      ],
      'views_week' => [
        'contains' => [
          'listWeek_buttonText' => ['default' => "buttonText: 'list'"],
          'listWeek_titleFormat' => ['default' => "year: 'numeric', month: 'short', day: 'numeric'"],
          'dayGridWeek_buttonText' => ['default' => "buttonText: 'week'"],
          'dayGridWeek_titleFormat' => ['default' => "year: 'numeric', month: 'short', day: 'numeric'"],
          'dayGridWeek_dayHeaderFormat' => ['default' => "weekday:'short', month:'numeric', day:'numeric', omitCommas:true"],
          'timeGridWeek_buttonText' => ['default' => "buttonText: 'week'"],
          'timeGridWeek_titleFormat' => ['default' => "year: 'numeric', month: 'short', day: 'numeric'"],
          'timeGridWeek_dayHeaderFormat' => ['default' => "weekday:'short', month:'numeric', day:'numeric', omitCommas:true"],
        ],
      ],
      'views_day' => [
        'contains' => [
          'listDay_buttonText' => ['default' => "buttonText: 'list'"],
          'listDay_titleFormat' => ['default' => "year: 'numeric', month: 'long', day: 'numeric'"],
          'dayGridDay_buttonText' => ['default' => "buttonText: 'day'"],
          'dayGridDay_titleFormat' => ['default' => "year: 'numeric', month: 'long', day: 'numeric'"],
          'dayGridDay_dayHeaderFormat' => ['default' => "weekday:'long'"],
          'timeGridDay_buttonText' => ['default' => "buttonText: 'day'"],
          'timeGridDay_titleFormat' => ['default' => "year: 'numeric', month: 'long', day: 'numeric'"],
          'timeGridDay_dayHeaderFormat' => ['default' => "weekday:'long'"],
        ],
      ],
      'axis' => [
        'contains' => [
          'slotDuration' => ['default' => ''],
          'slotLabelInterval' => ['default' => ''],
          'slotLabelFormat' => ['default' => ''],
          'slotMinTime' => ['default' => ''],
          'slotMaxTime' => ['default' => ''],
          'scrollTime' => ['default' => ''],
        ],
      ],
      'nav' => [
        'contains' => [
          'initialDate' => ['default' => ''],
          'dateAlignment' => ['default' => ''],
          'validRange' => ['default' => ''],
        ],
      ],
      'week' => [
        'contains' => [
          'weekNumbers' => ['default' => FALSE],
          'weekNumberCalculation' => ['default' => 'local'],
          'weekText' => ['default' => 'W'],
        ],
      ],
      'now' => [
        'contains' => [
          'nowIndicator' => ['default' => FALSE],
          'now' => ['default' => FALSE],
        ],
      ],
      'business' => [
        'contains' => [
          'businessHours' => ['default' => FALSE],
          'businessHours2' => ['default' => ''],
        ],
      ],
      'style' => [
        'contains' => [
          'themeSystem' => ['default' => 'standard'],
          'height' => ['default' => ''],
          'contentHeight' => ['default' => ''],
          'aspectRatio' => ['default' => '1.35'],
          'handleWindowResize' => ['default' => TRUE],
          'windowResizeDelay' => ['default' => 100],
        ],
      ],
      'google' => [
        'contains' => [
          'googleCalendarApiKey' => ['default' => ''],
          'googleCalendarId' => ['default' => ''],
        ],
      ],
    ];
  }

  /**
   * Build a fieldset form element.
   *
   * @param string $title
   *   The title of the fieldset.
   * @param string $description
   *   The description.
   * @param bool $open
   *   If TRUE, the fieldset is open when the form loads.
   * @param string $fieldset
   *   The name of the parent fieldset.
   * @param array $states
   *   The FAPI states property.
   *
   * @return array
   *   Drupal FAPI array.
   */
  public function getFieldsetElement(string $title, string $description = '', bool $open = FALSE, string $fieldset = '', array $states = []): array {
    $details = [
      '#type' => 'details',
      '#title' => $title,
      '#collapsible' => TRUE,
      '#open' => $open,
      '#prefix' => '<div class="clearfix" style="overflow: hidden;">',
      '#suffix' => '</div>',
    ];

    if ($description) {
      $details['#description'] = $description;
    }
    if ($fieldset) {
      $details['#fieldset'] = $fieldset;
    }
    if ($states) {
      $details['#states'] = $states;
    }

    return $details;
  }

  /**
   * Get a title format element.
   *
   * @param mixed $default
   *   The default value.
   * @param string $fieldset
   *   The name of the fieldset.
   * @param string $title
   *   The field title.
   *
   * @return array
   *   Drupal FAPI array.
   */
  public function getTitleFormatElement(mixed $default, string $fieldset, string $title = ''): array {
    return [
      '#type' => 'textfield',
      '#title' => !empty($title) ? $title : $this->t('Title format'),
      '#description' => $this->t("Determines the text that will be displayed in the header's title. Enter comma-separated key:value pairs for object properties e.g. year:'numeric', month:'long'. Each view has a specific default. This setting will set the value for all views.   @more-info", [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/titleFormat', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ]),
      '#default_value' => $default,
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
      '#size' => '60',
      '#fieldset' => $fieldset,
    ];
  }

  /**
   * Get a button text element.
   *
   * @param mixed $default
   *   The default value.
   * @param string $fieldset
   *   The name of the fieldset.
   * @param string $title
   *   The field title.
   *
   * @return array
   *   Drupal FAPI array.
   */
  public function getButtonTextElement(mixed $default, string $fieldset, string $title = ''): array {
    return [
      '#type' => 'textfield',
      '#title' => !empty($title) ? $title : $this->t('Button text'),
      '#description' => $this->t("Text that will be displayed on buttons of the header/footer. Use key:value pairs for view-specific formats e.g. buttonText: 'list day'. @more-info",
        [
          '@more-info' => Link::fromTextAndUrl(
            $this->t('More info'),
            Url::fromUri(self::FC_DOCS_URL . '/buttonText', ['attributes' => ['target' => '_blank']])
          )->toString(),
        ]),
      '#default_value' => $default,
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
      '#size' => '60',
      '#fieldset' => $fieldset,
    ];
  }

  /**
   * Get a column header format element.
   *
   * @param mixed $default
   *   The default value.
   * @param string $fieldset
   *   The name of the fieldset.
   * @param string $title
   *   The field title.
   *
   * @return array
   *   Drupal FAPI array.
   */
  public function getColumnHeaderFormatElement(mixed $default, string $fieldset, string $title = ''): array {
    return [
      '#type' => 'textfield',
      '#title' => !empty($title) ? $title : t('Column header format'),
      '#description' => $this->t('Determines the text that will be displayed the calendar\’s column headings. Use comma-separated key:value pairs for @formatting properties e.g. weekday:short. @more-info',
        [
          '@formatting' => Link::fromTextAndUrl(
            $this->t('date-formatting object'),
            Url::fromUri(self::FC_DOCS_URL . '/date-formatting', ['attributes' => ['target' => '_blank']])
          )->toString(),
          '@more-info' => Link::fromTextAndUrl(
            $this->t('More info'),
            Url::fromUri(self::FC_DOCS_URL . '/columnHeaderFormat', ['attributes' => ['target' => '_blank']])
          )->toString(),
        ]),
      '#default_value' => $default,
      '#size' => '60',
      '#fieldset' => $fieldset,
    ];
  }

  /**
   * Get supported FC properties.
   *
   * @return array
   *   Associative array of array of properties keyed by the data type.
   */
  public function getCalendarProperties(): array {
    return [
      'scalar' => [
        'googleCalendarApiKey',
        'initialView',
        'timeZone',
        'locale',
        'themeSystem',
        'firstDay',
        'weekends',
        'editable',
        'eventLimit',
        'businessHours',
        'weekNumbers',
        'weekNumbersWithinDays',
        'weekNumberCalculation',
        'weekText',
        'columnHeader',
        'initialDate',
        'navLinks',
        'navLinkDayClick',
        'navLinkWeekClick',
        'scrollTime',
        'aspectRatio',
        'nowIndicator',
        'now',
        'slotDuration',
        'slotMinTime',
        'slotMaxTime',
        'titleRangeSeparator',
        'eventOverlap',
        'eventColor',
        'eventDisplay',
        'displayEventTime',
        'nextDayThreshold',
      ],
      'array' => [
        'hiddenDays',
      ],
      'object' => [
        'plugins',
        'validRange',
        'slotLabelFormat',
        'slotLabelInterval',
        'header',
        'footer',
        'buttonText',
      ],
    ];
  }

  /**
   * Check for valid Google Calendar API settings.
   *
   * @param array $settings
   *   The settings.
   *
   * @return bool
   *   TRUE, if the settings contains Google Calendar API information, FALSE
   *   otherwise.
   */
  public function isGoogleCalendar(array $settings): bool {
    return !empty($settings['google']['googleCalendarApiKey']) && !empty($settings['google']['googleCalendarId']);
  }

  /**
   * Flattens a multi dimensional array.
   *
   * @param array $array
   *   The input array.
   *
   * @return array
   *   The flattened array.
   */
  public function flattenMultidimensionalArray(array $array): array {
    $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
    return iterator_to_array($it);
  }

}

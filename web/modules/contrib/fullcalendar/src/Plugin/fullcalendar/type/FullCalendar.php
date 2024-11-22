<?php

namespace Drupal\fullcalendar\Plugin\fullcalendar\type;

use Drupal\Core\Datetime\DateHelper;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfo;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\fullcalendar\Plugin\FullcalendarBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * The full calender type plugin.
 *
 * @FullcalendarOption(
 *   id = "fullcalendar",
 *   module = "fullcalendar",
 *   js = TRUE,
 *   weight = "-20"
 * )
 */
class FullCalendar extends FullcalendarBase implements ContainerFactoryPluginInterface {

  use OptionsFormHelperTrait;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected ModuleHandlerInterface $moduleHandler;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected LanguageManagerInterface $languageManager;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfo
   */
  protected $entityTypeBundleInfo;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected $entityFieldManager;

  /**
   * The entity display repository.
   *
   * @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface
   */
  protected $entityDisplayRepository;

  /**
   * The default color for events in Fullcalendar.
   *
   * @var string
   */
  protected $defaultColor = '#3788d8';

  /**
   * The display options available in the FullCalendar library.
   *
   * @var array
   */
  protected $displayOptions = [
    'auto' => 'Automatic',
    'block' => 'Block',
    'list-item' => 'List item',
    'background' => 'Background',
    'inverse-background' => 'Inverse background',
    'none' => 'None',
  ];

  /**
   * Constructor for the full calendar type plugin.
   *
   * @param array $configuration
   *   The configuration.
   * @param string $plugin_id
   *   The plugin ID.
   * @param array $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfo $entity_type_bundle_info
   *   The entity type bundle info.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityFieldManagerInterface $entity_field_manager
   *   The entity field manager.
   * @param \Drupal\Core\Entity\EntityDisplayRepositoryInterface $entity_display_repository
   *   The entity display repository.
   */
  final public function __construct(
    array $configuration,
    string $plugin_id,
    array $plugin_definition,
    ModuleHandlerInterface $module_handler,
    LanguageManagerInterface $language_manager,
    EntityTypeBundleInfo $entity_type_bundle_info,
    EntityTypeManagerInterface $entity_type_manager,
    EntityFieldManagerInterface $entity_field_manager,
    EntityDisplayRepositoryInterface $entity_display_repository,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleHandler = $module_handler;
    $this->languageManager = $language_manager;
    $this->entityTypeBundleInfo = $entity_type_bundle_info;
    $this->entityTypeManager = $entity_type_manager;
    $this->entityFieldManager = $entity_field_manager;
    $this->entityDisplayRepository = $entity_display_repository;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): static {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('module_handler'),
      $container->get('language_manager'),
      $container->get('entity_type.bundle.info'),
      $container->get('entity_type.manager'),
      $container->get('entity_field.manager'),
      $container->get('entity_display.repository')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defineOptions(): array {
    $options = $this->getDefaultOptions();

    // Override Fullcalendar / base defaults.
    $options['header'] = ['default' => "left:'dayGridMonth,timeGridWeek,timeGridDay', center:'title', right:'today prev,next'"];
    $options['links']['contains']['showMessages'] = ['default' => TRUE];
    $options['links']['contains']['navLinks'] = ['default' => TRUE];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function process(array &$settings): void {
    static $fc_dom_id = 1;

    if (empty($this->style->view->dom_id)) {
      $this->style->view->dom_id = 'fc-' . $fc_dom_id++;
    }

    $options = $this->style->options;
    // We no longer need custom fields.
    unset($options['fields']);

    $settings += $options + [
      'view_name' => $this->style->view->storage->id(),
      'view_display' => $this->style->view->current_display,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(array &$form, FormStateInterface $form_state): void {
    /** @var \Drupal\fullcalendar\Plugin\views\style\FullCalendar $style_plugin */
    $style_plugin = $this->style;

    $entity_type = $this->style->view->getBaseEntityType()->id();
    // All bundle types.
    $bundles = $this->entityTypeBundleInfo->getBundleInfo($entity_type);
    // Options list.
    $bundlesList = [];
    foreach ($bundles as $id => $bundle) {
      $label = $bundle['label'];
      $bundlesList[$id] = $label;
    }
    $field_options = $style_plugin->displayHandler->getFieldLabels();

    $form['intro'] = [
      '#markup' => $this->t('Fullcalendar defaults have been provided where appropriate. See the "more info" links for the documentation of settings.'),
    ];

    // Get the date fields.
    $date_fields = $style_plugin->parseFields();

    $form['fields'] = $this->getFieldsetElement($this->t('Customize fields'), $this->t('Customize the Drupal fields to use in the Calendar view. Appropriate fields will be determined if not set explicitly.'));

    $form['fields']['title'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use a custom title'),
      '#default_value' => $style_plugin->options['fields']['title'],
      '#data_type' => 'bool',
      '#fieldset' => 'fields',
    ];

    $form['fields']['title_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Title field'),
      '#options' => $field_options,
      '#default_value' => $style_plugin->options['fields']['title_field'],
      '#empty_option' => $this->t('- Select -'),
      '#description' => $this->t('Choose the field with the custom title.'),
      '#process' => ['\Drupal\Core\Render\Element\Select::processSelect'],
      '#states' => [
        'visible' => [
          ':input[name="style_options[fields][title]"]' => ['checked' => TRUE],
        ],
      ],
      '#fieldset' => 'fields',
    ];

    $form['fields']['url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use a custom URL'),
      '#default_value' => $style_plugin->options['fields']['url'],
      '#data_type' => 'bool',
      '#fieldset' => 'fields',
    ];

    $form['fields']['url_field'] = [
      '#type' => 'select',
      '#title' => $this->t('URL field'),
      '#options' => $field_options,
      '#default_value' => $style_plugin->options['fields']['url_field'],
      '#empty_option' => $this->t('- Select -'),
      '#description' => $this->t('Choose the field with the custom link.'),
      '#process' => ['\Drupal\Core\Render\Element\Select::processSelect'],
      '#states' => [
        'visible' => [
          ':input[name="style_options[fields][url]"]' => ['checked' => TRUE],
        ],
      ],
      '#fieldset' => 'fields',
    ];

    $form['fields']['date'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use a custom date field'),
      '#default_value' => $style_plugin->options['fields']['date'],
      '#data_type' => 'bool',
      '#fieldset' => 'fields',
    ];

    $form['fields']['date_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Date fields'),
      '#options' => $date_fields,
      '#default_value' => $style_plugin->options['fields']['date_field'],
      '#description' => $this->t('Select one or more date fields.'),
      '#multiple' => TRUE,
      '#size' => count($date_fields),
      '#process' => ['\Drupal\Core\Render\Element\Select::processSelect'],
      '#states' => [
        'visible' => [
          ':input[name="style_options[fields][date]"]' => ['checked' => TRUE],
        ],
      ],
      '#fieldset' => 'fields',
    ];

    // Disable form elements when not needed.
    if (empty($field_options)) {
      $form['fields']['#description'] = $this->t('All the options are hidden, you need to add fields first.');
      $form['fields']['title']['#type'] = 'hidden';
      $form['fields']['url']['#type'] = 'hidden';
      $form['fields']['date']['#type'] = 'hidden';
      $form['fields']['title_field']['#disabled'] = TRUE;
      $form['fields']['url_field']['#disabled'] = TRUE;
      $form['fields']['date_field']['#disabled'] = TRUE;
    }
    elseif (empty($date_fields)) {
      $form['fields']['date']['#type'] = 'hidden';
      $form['fields']['date_field']['#disabled'] = TRUE;
    }

    // Fieldset for interactive options including links, drag-and-drop, etc.
    $form['links'] = $this->getFieldsetElement($this->t('Interactive Options'));

    $form['links']['navLinks'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable nav links'),
      '#description' => $this->t(
        'Determines if day names and week names are clickable. When true, day headings and weekNumbers will become clickable. Default: false. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/navLinks', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]
      ),
      '#default_value' => $style_plugin->options['links']['navLinks'],
      '#data_type' => 'bool',
      '#fieldset' => 'links',
    ];

    $form['links']['navLinkDayClick'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Day click function'),
      '#description' => $this->t(
        'Determines what happens upon a day heading nav-link click. By default, the user is taken to the first day-view that appears in the header. Enter the name of a function you have written for this feature. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/navLinkDayClick', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]
      ),
      '#default_value' => $style_plugin->options['links']['navLinkDayClick'],
      '#size' => '40',
      '#fieldset' => 'links',
      '#states' => [
        'visible' => [
          ':input[name="style_options[links][navLinks]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['links']['navLinkWeekClick'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Week click function'),
      '#description' => $this->t(
        'Determines what happens upon a week-number nav-link click. By default, the user is taken to the a the first week-view that appears in the header. Enter the name of a function you have written for this feature. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/navLinkWeekClick', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]
      ),
      '#default_value' => $style_plugin->options['links']['navLinkWeekClick'],
      '#size' => '40',
      '#fieldset' => 'links',
      '#states' => [
        'visible' => [
          ':input[name="style_options[links][navLinks]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['links']['bundle_type'] = [
      '#title' => $this->t('Event bundle (Content) type'),
      '#description' => $this->t('The bundle (content) type of a new event. Once this is set, you can create a new event by double clicking a calendar entry.'),
      '#type' => 'select',
      '#options' => array_merge(['' => t('None')], $bundlesList),
      '#default_value' => $style_plugin->options['links']['bundle_type'] ?: '',
    ];

    // If the Form Mode Control module is installed, expose an option to use it.
    if ($this->moduleHandler->moduleExists('form_mode_control')) {
      $form_modes = $this->entityDisplayRepository->getFormModeOptions($entity_type);
      // Only expose the form element if our entity type has more than one
      // form mode.
      if ($form_modes && is_array($form_modes) && count($form_modes) > 1) {
        $form['links']['formMode'] = [
          '#title' => $this->t('Form mode'),
          '#description' => $this->t('The form mode to use for adding an entity.'),
          '#type' => 'select',
          '#options' => $form_modes,
          '#default_value' => $style_plugin->options['links']['formMode'] ?? '',
          '#states' => [
            'invisible' => [
              ':input[name="style_options[links][bundle_type]"]' => ['value' => ''],
            ],
          ],
        ];
      }
    }
    $target_options = [
      '' => 'Same window',
      'modal' => 'Modal dialog',
    ];
    $form['links']['createTarget'] = [
      '#title' => $this->t('Where to create'),
      '#description' => $this->t('Where a double-click should open the form to create a new event. Choose "Same window" to take the user away from the calendar, or "Modal dialog" to open the form in an overlay with the calendar still visible.'),
      '#type' => 'select',
      '#options' => $target_options,
      '#default_value' => $style_plugin->options['links']['createTarget'] ?: '',
      '#states' => [
        'invisible' => [
          ':input[name="style_options[links][bundle_type]"]' => ['value' => ''],
        ],
      ],
    ];

    $form['links']['modalWidth'] = [
      '#title' => $this->t('Modal Width'),
      '#description' => $this->t('How wide (in pixels) the dialog should appear.'),
      '#type' => 'number',
      '#min' => '100',
      '#default_value' => $style_plugin->options['links']['modalWidth'] ?? '600',
      '#states' => [
        // Show this number field only if a dialog is chosen above.
        'visible' => [
          ':input[name="style_options[links][createTarget]"]' => ['value' => 'modal'],
        ],
      ],
    ];

    $form['links']['updateConfirm'] = [
      '#type' => 'checkbox',
      '#title' => t('Confirm before updating'),
      '#description' => $this->t(
        'Require confirmation before performing drag-and-drop updates.'
      ),
      '#default_value' => $style_plugin->options['links']['updateConfirm'] ?? 0,
      '#data_type' => 'bool',
      '#fieldset' => 'links',
    ];

    $form['links']['showMessages'] = [
      '#type' => 'checkbox',
      '#title' => t('Show message on drag-and-drop'),
      '#description' => $this->t(
        'Display a message on success or failure of updating the data.'
      ),
      '#default_value' => $style_plugin->options['links']['showMessages'] ?? 0,
      '#data_type' => 'bool',
      '#fieldset' => 'links',
    ];

    // Fields to override the colors in which events will display.
    $form['event_format'] = $this->getFieldsetElement($this->t('Event Formatting'), $this->t('Control how events will appear.'));

    $form['event_format']['eventColor'] = [
      '#title' => $this->t('Default Color'),
      '#description' => $this->t('The color in which events will appear, unless overridden.'),
      '#type' => 'color',
      '#fieldset' => 'event_format',
      '#default_value' => $style_plugin->options['event_format']['eventColor'] ?? $this->defaultColor,
    ];

    $form['event_format']['eventDisplay'] = [
      '#title' => $this->t('Display Format'),
      '#description' => $this->t('How events should be displayed. @more-info', [
        '@more-info' => '<a href="https://fullcalendar.io/docs/eventDisplay" target="_blank">More info</a>',
      ]),
      '#type' => 'select',
      '#options' => $this->displayOptions,
      '#fieldset' => 'event_format',
      '#default_value' => $style_plugin->options['event_format']['eventDisplay'] ?? 'auto',
    ];

    $form['event_format']['displayEventTime'] = [
      '#title' => $this->t('Display Times'),
      '#description' => $this->t("Use the calendar's time output. You might want to disable this to include a formatted output of the time in the title instead. @more-info", [
        '@more-info' => '<a href="https://fullcalendar.io/docs/displayEventTime" target="_blank">More info</a>',
      ]),
      '#type' => 'checkbox',
      '#fieldset' => 'event_format',
      '#default_value' => $style_plugin->options['event_format']['displayEventTime'] ?? TRUE,
    ];

    $form['event_format']['nextDayThreshold'] = [
      '#title' => $this->t('Next Day Threshold'),
      '#description' => $this->t('The time at which events should be considered to have crossed into another day. @more-info', [
        '@more-info' => '<a href="https://fullcalendar.io/docs/nextDayThreshold" target="_blank">More info</a>',
      ]),
      '#type' => 'textfield',
      '#fieldset' => 'event_format',
      '#default_value' => $style_plugin->options['event_format']['nextDayThreshold'] ?? '00:00:00',
    ];

    // Fields to override the colors in which events will display.
    $form['colors'] = $this->getFieldsetElement($this->t('Event Color Overrides'), $this->t('Customize the colors in which events will appear.'));

    $bundle_label = $this->style->view->getBaseEntityType()->getBundleLabel();

    // Content type colors.
    $form['colors']['color_bundle'] = [
      '#type' => 'details',
      '#title' => $this->t('Color by @bundle', ['@bundle' => $bundle_label]),
      '#description' => $this->t('Specify colors for each bundle type. If taxonomy color is specified, this settings would be ignored.'),
      '#fieldset' => 'colors',
    ];
    // All bundle types.
    $bundles = $this->entityTypeBundleInfo->getBundleInfo($entity_type);
    // Options list.
    foreach ($bundlesList as $id => $label) {
      // Content type colors.
      $defaultValues = $style_plugin->options['colors']['color_bundle'][$id] ?? [];
      // Emulate new structure if old config passed.
      if (!is_array($defaultValues)) {
        $defaultValues = ['color' => $defaultValues];
      }
      $color = $defaultValues['color'] ?? $this->defaultColor;
      $textcolor = $defaultValues['textColor'] ?? $this->defaultColor;
      $display = $defaultValues['display'] ?? '';
      $form['colors']['color_bundle'][$id] = [
        'color' => [
          '#title' => $this->t('Color'),
          '#default_value' => $color,
          '#type' => 'color',
          '#prefix' => '<div class="fullcalendar--style-group">',
        ],
        'textColor' => [
          '#title' => $this->t('Text'),
          '#default_value' => $textcolor,
          '#type' => 'color',
        ],
        'display' => [
          '#title' => $this->t('Display Style'),
          '#default_value' => $display,
          '#type' => 'select',
          '#options' => $this->displayOptions,
          '#suffix' => '</div>',
        ],
        '#type' => 'html_tag',
        '#tag' => 'h3',
        '#value' => $label,
      ];
    }

    // Get the regular fields.
    $moduleHandler = $this->moduleHandler;
    if ($moduleHandler->moduleExists('taxonomy')) {
      // All vocabularies.
      $cabNames = $this->entityTypeManager->getStorage('taxonomy_vocabulary')->getQuery()->accessCheck(TRUE)->execute();
      // Taxonomy reference field.
      $tax_fields = [];
      // Find out all taxonomy reference fields of this View.
      foreach ($field_options as $field_name => $label) {
        $field_conf = FieldStorageConfig::loadByName($entity_type, $field_name) ?: FieldStorageConfig::loadByName('user', $field_name);
        if (empty($field_conf)) {
          continue;
        }
        if ($field_conf->getType() == 'entity_reference') {
          $tax_fields[$field_name] = $label;
        }
      }
      // Field name of event taxonomy.
      $form['colors']['tax_field'] = [
        '#title' => $this->t('Event Taxonomy Field'),
        '#description' => $this->t('In order to specify colors for event taxonomies, you must select a taxonomy reference field for the View.'),
        '#type' => 'select',
        '#options' => $tax_fields,
        '#empty_value' => '',
        '#disabled' => empty($tax_fields),
        '#fieldset' => 'colors',
        '#default_value' => $style_plugin->options['colors']['tax_field'] ?? '',
      ];
      // Color for vocabularies.
      $vocabulary = $style_plugin->options['colors']['vocabularies'] ?? '';
      $form['colors']['vocabularies'] = [
        '#title' => $this->t('Vocabularies'),
        '#type' => 'select',
        '#options' => $cabNames,
        '#empty_value' => '',
        '#fieldset' => 'colors',
        '#description' => $this->t('Specify which vocabulary is using for calendar event color. If the vocabulary selected is not the one that the taxonomy field belonging to, the color setting would be ignored.'),
        '#default_value' => $vocabulary,
        '#states' => [
          // Only show this field when the 'tax_field' is selected.
          'invisible' => [
            [':input[name="style_options[colors][tax_field]"]' => ['value' => '']],
          ],
        ],
        '#ajax' => [
          // 'callback' => '::taxonomyColorCallback',
          'callback' => [$this, 'taxonomyColorCallback'],
          // 'callback' => [static::class, 'taxonomyColorCallback'],
          'disable-refocus' => FALSE,
          'event' => 'change',
          'wrapper' => 'color-taxonomies-div',
          'progress' => [
            'type' => 'throbber',
            'message' => $this->t('Verifying entry...'),
          ],
        ],
      ];

      $taxonomies = $style_plugin->options['colors']['color_taxonomies'] ?? [];
      $form['colors']['color_taxonomies'] = $this->colorInputBoxes($vocabulary, $taxonomies);
    }

    // Toolbar settings.
    $form['toolbar'] = $this->getFieldsetElement($this->t('Toolbar'));

    $form['header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header'),
      '#description' => $this->t("Defines the buttons and title at the top of the calendar. Enter comma-separated key:value pairs for object properties e.g. left: 'title', center: '', right: 'today prev,next' @more-info",
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/header', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['header'],
      '#size' => '40',
      '#fieldset' => 'toolbar',
    ];

    $form['footer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Footer'),
      '#description' => $this->t('Defines the controls at the bottom of the calendar. These settings accept the same exact values as the header option. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/footer', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ]),
      '#default_value' => $style_plugin->options['footer'],
      '#size' => '40',
      '#fieldset' => 'toolbar',
    ];

    $form['titleFormat'] = $this->getTitleFormatElement($style_plugin->options['titleFormat'], 'toolbar');

    $form['titleRangeSeparator'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title range separator'),
      '#description' => $this->t('Determines the separator text when formatting the date range in the toolbar title. Default: \u2013 (en dash)'),
      '#default_value' => $style_plugin->options['titleRangeSeparator'],
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
      '#size' => '40',
      '#fieldset' => 'toolbar',
    ];

    $form['buttonText'] = $this->getButtonTextElement($style_plugin->options['buttonText'], 'toolbar');

    $form['buttonIcons'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button icons'),
      '#description' => $this->t("Icons that will be displayed in buttons of the header/footer. Enter comma-separated key:value pairs for object properties e.g. prev:'left-single-arrow', next:'right-single-arrow', prevYear:'left-double-arrow', nextYear:'right-double-arrow'  @more-info",
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/buttonIcons', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['buttonIcons'],
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
      '#size' => '40',
      '#fieldset' => 'toolbar',
    ];

    // FC Views.
    $form['views'] = $this->getFieldsetElement($this->t('Views'), $this->t('Select the Fullcalendar views to enable on this calendar.'));

    $form['month_view'] = [
      '#type' => 'checkbox',
      '#title' => t('Month View'),
      '#default_value' => $style_plugin->options['month_view'],
      '#data_type' => 'bool',
      '#fieldset' => 'views',
      '#prefix' => '<div class="views-left-25">',
      '#suffix' => '</div>',
    ];

    $form['timegrid_view'] = [
      '#type' => 'checkbox',
      '#title' => t('TimeGrid View'),
      '#default_value' => $style_plugin->options['timegrid_view'],
      '#data_type' => 'bool',
      '#fieldset' => 'views',
      '#prefix' => '<div class="views-left-25">',
      '#suffix' => '</div>',
    ];

    $form['list_view'] = [
      '#type' => 'checkbox',
      '#title' => t('List View'),
      '#default_value' => $style_plugin->options['list_view'],
      '#data_type' => 'bool',
      '#fieldset' => 'views',
      '#prefix' => '<div class="views-left-25">',
      '#suffix' => '</div>',
    ];

    $form['daygrid_view'] = [
      '#type' => 'checkbox',
      '#title' => t('DayGrid View'),
      '#default_value' => $style_plugin->options['daygrid_view'],
      '#data_type' => 'bool',
      '#fieldset' => 'views',
      '#prefix' => '<div class="views-left-25">',
      '#suffix' => '</div>',
    ];

    // View.
    $form['view_settings'] = $this->getFieldsetElement($this->t('View settings'), '', FALSE, '', [
      'visible' => [':input[name="style_options[month_view]"]' => ['checked' => TRUE]],
    ]);

    // Month View.
    $form['month_view_settings'] = $this->getFieldsetElement($this->t('Month View settings'), '', FALSE, 'view_settings', [
      'visible' => [':input[name="style_options[month_view]"]' => ['checked' => TRUE]],
    ]);

    $form['month_view_settings']['fixedWeekCount'] = [
      '#type' => 'checkbox',
      '#title' => t('Number of weeks'),
      '#description' => $this->t('Determines the number of weeks displayed in a month view (true). If true, the calendar will always be 6 weeks tall. If false, the calendar will have either 4, 5, or 6 weeks, depending on the month.'),
      '#default_value' => $style_plugin->options['month_view_settings']['fixedWeekCount'],
      '#data_type' => 'bool',
      '#fieldset' => 'month_view_settings',
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
    ];

    $form['month_view_settings']['showNonCurrentDates'] = [
      '#type' => 'checkbox',
      '#title' => t('Number of weeks'),
      '#description' => $this->t('In month view, whether dates in the previous or next month should be rendered at all. (true). Days that are disabled will not render events.'),
      '#default_value' => $style_plugin->options['month_view_settings']['showNonCurrentDates'],
      '#data_type' => 'bool',
      '#fieldset' => 'month_view_settings',
      '#prefix' => '<div class="views-left-50">',
      '#suffix' => '</div>',
    ];

    // TimeGrid View.
    $form['timegrid_view_settings'] = $this->getFieldsetElement($this->t('TimeGrid View settings'), '', FALSE, 'view_settings', [
      'visible' => [':input[name="style_options[timegrid_view]"]' => ['checked' => TRUE]],
    ]);

    $form['timegrid_view_settings']['allDaySlot'] = [
      '#type' => 'checkbox',
      '#title' => t('Display "all-day" slot'),
      '#description' => $this->t('Determines the number of weeks displayed in a month view (true). When hidden with false, all-day events will not be displayed in TimeGrid views.'),
      '#default_value' => $style_plugin->options['timegrid_view_settings']['allDaySlot'],
      '#data_type' => 'bool',
      '#fieldset' => 'timegrid_view_settings',
    ];

    $form['timegrid_view_settings']['allDayContent'] = [
      '#type' => 'textfield',
      '#title' => $this->t('"All-day" content'),
      '#description' => $this->t('The title of the “all-day” slot at the top of the calendar (default: all-day). Accepts HTML in a JS object notation.'),
      '#default_value' => $style_plugin->options['timegrid_view_settings']['allDayContent'],
      '#size' => '40',
      '#fieldset' => 'timegrid_view_settings',
    ];

    $form['timegrid_view_settings']['slotEventOverlap'] = [
      '#type' => 'checkbox',
      '#title' => t('Determines if timed events in TimeGrid view should visually overlap.'),
      '#description' => $this->t('When set to true (the default), events will overlap each other.'),
      '#default_value' => $style_plugin->options['timegrid_view_settings']['slotEventOverlap'],
      '#data_type' => 'bool',
      '#fieldset' => 'timegrid_view_settings',
    ];

    $form['timegrid_view_settings']['timeGridEventMinHeight'] = [
      '#type' => 'textfield',
      '#title' => t('Guaranteed minimum height.'),
      '#description' => $this->t('Guarantees that events within the TimeGrid views will be a minimum height. An integer pixel value can be specified to force all TimeGrid view events to be at least the given pixel height. (default: null). If not specified (the default), all events will have a height determined by their start and end times.'),
      '#default_value' => $style_plugin->options['timegrid_view_settings']['timeGridEventMinHeight'],
      '#size' => '40',
      '#fieldset' => 'timegrid_view_settings',
    ];

    // List View.
    $form['list_view_settings'] = $this->getFieldsetElement($this->t('List View settings'), '', FALSE, 'view_settings', [
      'visible' => [':input[name="style_options[list_view]"]' => ['checked' => TRUE]],
    ]);

    $form['list_view_settings']['listDayFormat'] = [
      '#type' => 'textfield',
      '#title' => t('Day format (left)'),
      '#description' => $this->t('A @more-info that affects the text on the left side of the day headings in list view. If false is specified, no text is displayed.',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('Date Formatter'), Url::fromUri(self::FC_DOCS_URL . '/listDayFormat', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['list_view_settings']['listDayFormat'],
      '#size' => '40',
      '#fieldset' => 'list_view_settings',
    ];

    $form['list_view_settings']['listDayAltFormat'] = [
      '#type' => 'textfield',
      '#title' => t('Day format (right)'),
      '#description' => $this->t('A @more-info that affects the text on the right side of the day headings in list view. If false is specified, no text is displayed.',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('Date Formatter'), Url::fromUri(self::FC_DOCS_URL . '/listDayFormat', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['list_view_settings']['listDayAltFormat'],
      '#size' => '40',
      '#fieldset' => 'list_view_settings',
    ];

    $form['list_view_settings']['noEventsMessage'] = [
      '#type' => 'textfield',
      '#title' => t('No events message'),
      '#description' => $this->t('The text that is displayed in the middle of list view, alerting the user that there are no events within the given range.'),
      '#default_value' => $style_plugin->options['list_view_settings']['noEventsMessage'],
      '#size' => '40',
      '#fieldset' => 'list_view_settings',
    ];

    $form['views_options'] = $this->getFieldsetElement(
      $this->t('View-Specific Options'),
      $this->t('Options that apply only to specific calendar views, provided as options objects in the views option, keyed by the name of the view. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/view-specific-options', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ]));

    $form['views_year'] = $this->getFieldsetElement($this->t('Year'), $this->t('Options that apply only to Year views'), FALSE, 'views_options');
    $form['views_year']['listYear_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_year']['listYear_buttonText'], 'views_year', $this->t('Button text (Year - List)'));
    $form['views_year']['listYear_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_year']['listYear_titleFormat'], 'views_year', $this->t('Title format (Year - List)'));

    $form['views_month'] = $this->getFieldsetElement($this->t('Month'), $this->t('Options that apply only to Month views'), FALSE, 'views_options');
    $form['views_month']['listMonth_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_month']['listMonth_buttonText'], 'views_month', $this->t('Button text (Month - List)'));
    $form['views_month']['listMonth_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_month']['listMonth_titleFormat'], 'views_month', $this->t('Title format (Month - List)'));

    $form['views_month']['dayGridMonth_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_month']['dayGridMonth_buttonText'], 'views_month', $this->t('Button text (Month - Day Grid)'));
    $form['views_month']['dayGridMonth_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_month']['dayGridMonth_titleFormat'], 'views_month', $this->t('Title format (Month - Day Grid)'));
    $form['views_month']['dayGridMonth_dayHeaderFormat'] = $this->getColumnHeaderFormatElement($style_plugin->options['views_month']['dayGridMonth_dayHeaderFormat'], 'views_month', $this->t('Column header format (Month - Day Grid)'));

    $form['views_week'] = $this->getFieldsetElement($this->t('Week'), $this->t('Options that apply only to Week views'), FALSE, 'views_options');
    $form['views_week']['listWeek_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_week']['listWeek_buttonText'], 'views_week', $this->t('Button text (Week - List)'));
    $form['views_week']['listWeek_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_week']['listWeek_titleFormat'], 'views_week', $this->t('Title format (Week - List)'));

    $form['views_week']['dayGridWeek_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_week']['dayGridWeek_buttonText'], 'views_week', $this->t('Button text (Week - Day Grid)'));
    $form['views_week']['dayGridWeek_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_week']['dayGridWeek_titleFormat'], 'views_week', $this->t('Title format (Week - Day Grid)'));
    $form['views_week']['dayGridWeek_dayHeaderFormat'] = $this->getColumnHeaderFormatElement($style_plugin->options['views_week']['dayGridWeek_dayHeaderFormat'], 'views_week', $this->t('Column header format (Week - Day Grid)'));

    $form['views_week']['timeGridWeek_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_week']['timeGridWeek_buttonText'], 'views_week', $this->t('Button text (Week - Time Grid)'));
    $form['views_week']['timeGridWeek_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_week']['timeGridWeek_titleFormat'], 'views_week', $this->t('Title format (Week - Time Grid)'));
    $form['views_week']['timeGridWeek_dayHeaderFormat'] = $this->getColumnHeaderFormatElement($style_plugin->options['views_week']['timeGridWeek_dayHeaderFormat'], 'views_week', $this->t('Column header format (Week - Time Grid)'));

    $form['views_day'] = $this->getFieldsetElement($this->t('Day'), $this->t('Options that apply only to Day views'), FALSE, 'views_options');
    $form['views_day']['listDay_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_day']['listDay_buttonText'], 'views_day', $this->t('Button text (Day - List)'));
    $form['views_day']['listDay_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_day']['listDay_titleFormat'], 'views_day', $this->t('Title format (Day - List)'));

    $form['views_day']['dayGridDay_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_day']['dayGridDay_buttonText'], 'views_day', $this->t('Button text (Day - Day Grid)'));
    $form['views_day']['dayGridDay_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_day']['dayGridDay_titleFormat'], 'views_day', $this->t('Title format (Day - Day Grid)'));
    $form['views_day']['dayGridDay_dayHeaderFormat'] = $this->getColumnHeaderFormatElement($style_plugin->options['views_day']['dayGridDay_dayHeaderFormat'], 'views_day', $this->t('Column header format (Day - Day Grid)'));

    $form['views_day']['timeGridDay_buttonText'] = $this->getButtonTextElement($style_plugin->options['views_day']['timeGridDay_buttonText'], 'views_day', $this->t('Button text (Day - Time Grid)'));
    $form['views_day']['timeGridDay_titleFormat'] = $this->getTitleFormatElement($style_plugin->options['views_day']['timeGridDay_titleFormat'], 'views_day', $this->t('Title format (Day - Time Grid)'));
    $form['views_day']['timeGridDay_dayHeaderFormat'] = $this->getColumnHeaderFormatElement($style_plugin->options['views_day']['timeGridDay_dayHeaderFormat'], 'views_day', $this->t('Column header format (Day - Time Grid)'));

    // Display settings.
    $form['display'] = $this->getFieldsetElement($this->t('Display settings'));

    $form['display']['initialView'] = [
      '#type' => 'select',
      '#title' => $this->t('Initial display'),
      '#options' => [
        'dayGridMonth' => $this->t('Month'),
        'timeGridWeek' => $this->t('Week (Agenda)'),
        'dayGridWeek' => $this->t('Week (Basic)'),
        'timeGridDay' => $this->t('Day (Agenda)'),
        'dayGridDay' => $this->t('Day (Basic)'),
        'listYear' => $this->t('Year (List)'),
        'listMonth' => $this->t('Month (List)'),
        'listWeek' => $this->t('Week (List)'),
        'listDay' => $this->t('Day (List)'),
      ],
      '#empty_option' => $this->t('- Select -'),
      '#description' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/intro', [
        'attributes' => [
          'target' => '_blank',
        ],
      ])),
      '#default_value' => $style_plugin->options['display']['initialView'],
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
      '#fieldset' => 'display',
    ];

    $form['display']['firstDay'] = [
      '#type' => 'select',
      '#title' => $this->t('Week starts on'),
      '#options' => DateHelper::weekDays(TRUE),
      '#default_value' => $style_plugin->options['display']['firstDay'],
      '#prefix' => '<div class="views-left-30">',
      '#suffix' => '</div>',
      '#fieldset' => 'display',
    ];

    // Date/Time display.
    $form['times'] = $this->getFieldsetElement(
      $this->t('Date & Time Display'),
      $this->t('Settings that control presence/absence of dates as well as their styling and text. These settings work across a variety of different views. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/date-display', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ])
    );

    $form['times']['convert_timezones'] = [
      '#type' => 'checkbox',
      '#title' => t('Convert Timezones'),
      '#description' => $this->t('Convert events in other timezones so that they show accurately for the site/user timezone.'),
      '#default_value' => $style_plugin->options['times']['convert_timezones'] ?? TRUE,
      '#data_type' => 'bool',
      '#fieldset' => 'times',
    ];

    $form['times']['weekends'] = [
      '#type' => 'checkbox',
      '#title' => t('Weekends'),
      '#description' => $this->t('Whether to include Saturday/Sunday columns in any of the calendar views (true).'),
      '#default_value' => $style_plugin->options['times']['weekends'],
      '#data_type' => 'bool',
      '#fieldset' => 'times',
    ];

    $form['times']['hiddenDays'] = [
      '#type' => 'textfield',
      '#title' => t('Exclude days'),
      '#description' => $this->t('Exclude certain days-of-the-week from being displayed. By default, no days are hidden, unless weekends is set to false. Enter comma-separated numbers e.g. 2, 4 @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/hiddenDays', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ]),
      '#default_value' => $style_plugin->options['times']['hiddenDays'],
      '#size' => '40',
      '#fieldset' => 'times',
    ];

    $form['times']['dayHeaders'] = [
      '#type' => 'checkbox',
      '#title' => t('Column header'),
      '#description' => $this->t('Whether the day headers should appear. For the Month, TimeGrid, and DayGrid views (true).'),
      '#default_value' => $style_plugin->options['times']['dayHeaders'],
      '#data_type' => 'bool',
      '#fieldset' => 'times',
    ];

    $form['axis'] = $this->getFieldsetElement(
      $this->t('Time-axis settings'),
      $this->t('Settings that control display of times along the side of the calendar. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/date-display', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ])
    );

    $form['axis']['slotDuration'] = [
      '#type' => 'textfield',
      '#title' => t('Duration of slots'),
      '#description' => $this->t('The frequency for displaying time slots. (default: 00:30:00) @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/slotDuration', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['slotDuration'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['axis']['slotLabelInterval'] = [
      '#type' => 'textfield',
      '#title' => t('Interval of slot labels'),
      '#description' => $this->t('The frequency that the time slots should be labelled with text. If not specified, a reasonable value will be automatically computed based on slotDuration. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/slotLabelInterval', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['slotLabelInterval'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['axis']['slotLabelFormat'] = [
      '#type' => 'textfield',
      '#title' => t('Format of slot labels'),
      '#description' => $this->t('Determines the text that will be displayed within a time slot. Enter comma-separated, object properties e.g. hour:numeric, minute:2-digit, omitZeroMinute:true, meridiem:short @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/slotLabelFormat', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['slotLabelFormat'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['axis']['slotMinTime'] = [
      '#type' => 'textfield',
      '#title' => t('First time slot'),
      '#description' => $this->t('Determines the first time slot that will be displayed for each day. (default: 00:00:00) @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/slotMinTime', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['slotMinTime'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['axis']['slotMaxTime'] = [
      '#type' => 'textfield',
      '#title' => t('Last time slot'),
      '#description' => $this->t('Determines the last time slot that will be displayed for each day. This MUST be specified as an exclusive end time. (default: 24:00:00) @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/slotMaxTime', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['slotMaxTime'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['axis']['scrollTime'] = [
      '#type' => 'textfield',
      '#title' => t('Scroll time'),
      '#description' => $this->t('Determines how far forward the scroll pane is initially scrolled. The user will be able to scroll back to see events before this time. (default: 06:00:00) @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/scrollTime', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['axis']['scrollTime'],
      '#size' => '40',
      '#fieldset' => 'axis',
    ];

    $form['nav'] = $this->getFieldsetElement($this->t('Date navigation'));

    $form['nav']['initialDate'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default date'),
      '#description' => $this->t('The initial date displayed when the calendar first loads. When not specified, this value defaults to the current date. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/initialDate', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['nav']['initialDate'],
      '#size' => '40',
      '#fieldset' => 'nav',
    ];

    $form['nav']['validRange'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Valid date range'),
      '#description' => $this->t('Limits which dates the user can navigate to and where events can go. Dates outside of the valid range will be grayed-out. Enter comma-separated key:value properties e.g. start:2017-05-01, end:2017-06-01 @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/validRange', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['nav']['validRange'],
      '#size' => '40',
      '#fieldset' => 'nav',
    ];

    $form['week'] = $this->getFieldsetElement($this->t('Week Numbers'));

    $form['week']['weekNumbers'] = [
      '#type' => 'checkbox',
      '#title' => t('Display week numbers'),
      '#description' => $this->t('Determines if week numbers should be displayed on the calendar. If set to true, week numbers will be displayed in a separate left column in the Month/DayGrid views as well as at the top-left corner of the TimeGrid views. Default: false. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/weekNumbers', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['week']['weekNumbers'],
      '#data_type' => 'bool',
      '#fieldset' => 'week',
    ];

    $form['week']['weekNumberCalculation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Week label'),
      '#description' => $this->t('The method for calculating week numbers that are displayed with the weekNumbers setting e.g. local, ISO, or name of function you have written for this feature. Default: "local" @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/weekNumberCalculation', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['week']['weekNumberCalculation'],
      '#size' => '40',
      '#fieldset' => 'week',
    ];

    $form['week']['weekText'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Week label'),
      '#description' => $this->t('The heading text for week numbers. Also affects weeks in date formatting. Default: "W" @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/weekText', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['week']['weekText'],
      '#size' => '40',
      '#fieldset' => 'week',
    ];

    $form['now'] = $this->getFieldsetElement($this->t('Now Indicator'));

    $form['now']['nowIndicator'] = [
      '#type' => 'checkbox',
      '#title' => t('Now indicator'),
      '#description' => $this->t('Whether or not to display a marker indicating the current time. Default: false. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/nowIndicator', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['now']['nowIndicator'],
      '#data_type' => 'bool',
      '#fieldset' => 'now',
    ];

    $form['now']['now'] = [
      '#type' => 'checkbox',
      '#title' => t('Now'),
      '#description' => $this->t('Explicitly sets the "today" date of the calendar - the day that is normally highlighted in yellow. Enter a @parsable-date or name of function you have written for this feature. @more-info',
        [
          '@parsable-date' => Link::fromTextAndUrl($this->t('parsable date'), Url::fromUri(self::FC_DOCS_URL . '/date-parsing',
            [
              'attributes' => ['target' => '_blank'],
            ]))->toString(),
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/now',
            [
              'attributes' => ['target' => '_blank'],
            ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['now']['now'],
      '#data_type' => 'bool',
      '#fieldset' => 'now',
    ];

    $form['business'] = $this->getFieldsetElement($this->t('Business Hours'));

    $form['business']['businessHours'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Business Hours'),
      '#description' => $this->t('Emphasizes certain time slots on the calendar. By default, Monday-Friday, 9am-5pm. For better control, see below. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/businessHours', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['business']['businessHours'],
      '#data_type' => 'bool',
      '#fieldset' => 'business',
    ];

    $form['business']['businessHours2'] = [
      '#type' => 'textfield',
      '#title' => t('Business hours format'),
      '#description' => $this->t('For fine-grain control over business hours enter key:value pairs for object properties. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/businessHours', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ]),
      '#default_value' => $style_plugin->options['business']['businessHours2'],
      '#size' => '40',
      '#fieldset' => 'business',
      '#states' => [
        'visible' => [
          ':input[name="style_options[business][businessHours]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['style'] = $this->getFieldsetElement($this->t('Calendar Appearance/Sizing'));

    $form['style']['themeSystem'] = [
      '#type' => 'select',
      '#title' => $this->t('Theme'),
      '#options' => [
        'standard' => $this->t('Standard'),
        'bootstrap4' => $this->t('Bootstrap 4'),
        'bootstrap5' => $this->t('Bootstrap 5'),
      ],
      '#default_value' => $style_plugin->options['style']['themeSystem'],
      '#fieldset' => 'style',
    ];

    $form['style']['height'] = [
      '#type' => 'textfield',
      '#title' => t('Height'),
      '#description' => $this->t('Sets the height of the entire calendar, including header and footer. Enter a number, "parent", "auto" or name of function you have written for this feature. Default: This option is unset and the calendar\'s height is calculated by aspectRatio. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/sizing', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['style']['height'],
      '#size' => '40',
      '#fieldset' => 'style',
    ];

    $form['style']['contentHeight'] = [
      '#type' => 'textfield',
      '#title' => t('View area height'),
      '#description' => $this->t('Sets the height of the view area of the calendar. Enter a number, "auto" or name of function you have written for this feature. Default: This option is unset and the calendar\'s height is calculated by aspectRatio. @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/sizing', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['style']['contentHeight'],
      '#size' => '40',
      '#fieldset' => 'style',
    ];

    $form['style']['aspectRatio'] = [
      '#type' => 'textfield',
      '#title' => t('Width-height ratio'),
      '#description' => $this->t('Sets the width-to-height aspect ratio of the calendar. Enter a float. Default: 1.35 @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/sizing', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['style']['aspectRatio'],
      '#size' => '40',
      '#fieldset' => 'style',
    ];

    $form['style']['handleWindowResize'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Resize calendar'),
      '#description' => $this->t('Automatically resize the calendar when the browser window resizes. Default: true @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/sizing', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['style']['handleWindowResize'],
      '#data_type' => 'bool',
      '#fieldset' => 'style',
    ];

    $form['style']['windowResizeDelay'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Resize delay'),
      '#description' => $this->t('The time the calendar will wait to adjust its size after a window resize occurs, in milliseconds. Default: 100 @more-info',
        [
          '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/sizing', [
            'attributes' => ['target' => '_blank'],
          ]))->toString(),
        ]),
      '#default_value' => $style_plugin->options['style']['windowResizeDelay'],
      '#size' => '40',
      '#fieldset' => 'style',
    ];

    $form['google'] = $this->getFieldsetElement(
      $this->t('Google Calendar Settings'),
      $this->t('Display events from a public Google Calendar you have configured. @more-info', [
        '@more-info' => Link::fromTextAndUrl($this->t('More info'), Url::fromUri(self::FC_DOCS_URL . '/google-calendar', [
          'attributes' => ['target' => '_blank'],
        ]))->toString(),
      ])
    );

    $form['google']['googleCalendarApiKey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google Calendar API key'),
      '#default_value' => $style_plugin->options['google']['googleCalendarApiKey'],
      '#size' => '60',
      '#fieldset' => 'google',
    ];

    $form['google']['googleCalendarId'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google Calendar ID(s)'),
      '#description' => $this->t('You can specify multiple, comma-separated Google Calendar IDs'),
      '#default_value' => $style_plugin->options['google']['googleCalendarId'],
      '#size' => '60',
      '#fieldset' => 'google',
    ];

    // Custom CSS.
    $form['#attached']['library'][] = 'fullcalendar/drupal.fullcalendar.admin';
  }

  /**
   * {@inheritdoc}
   */
  public function submitOptionsForm(array &$form, FormStateInterface $form_state, array &$options = []): void {
    $options = $form_state->getValue('style_options');

    // Don't store default color values.
    $style_options = $form_state->getValue('style_options');
    if (!empty($style_options['colors'])) {
      if (!empty($style_options['colors']['color_bundle'])) {
        foreach ($style_options['colors']['color_bundle'] as $bundle_id => $styles) {
          $style_options['colors']['color_bundle'][$bundle_id] = $this->removeDefaultStyles($styles);
        }
      }
      // Clear color_taxonomies if the color vocabulary has been unset.
      if (empty($style_options['colors']['vocabularies'])) {
        $style_options['colors']['color_taxonomies'] = [];
      }
      if (!empty($style_options['colors']['color_taxonomies'])) {
        foreach ($style_options['colors']['color_taxonomies'] as $term_id => $styles) {
          $style_options['colors']['color_taxonomies'][$term_id] = $this->removeDefaultStyles($styles);
        }
      }
      $form_state->setValue('style_options', $style_options);
    }

    // These field options have empty defaults, make sure they stay that way.
    foreach (['title', 'url', 'date'] as $field) {
      if (empty($options['fields'][$field]) && isset($options['fields'][$field . '_field'])) {
        unset($options['fields'][$field . '_field']);
      }
    }
  }

  /**
   * Helper function to omit values that match FullCalendar defaults.
   *
   * @param array $styles
   *   The array to process.
   *
   * @return array
   *   The cleansed array.
   */
  protected function removeDefaultStyles(array $styles): array {
    $def_values = [
      'color' => $this->defaultColor,
      'textColor' => $this->defaultColor,
      'display' => 'auto',
    ];

    foreach ($def_values as $key => $def_value) {
      if (isset($styles[$key]) && $styles[$key] === $def_value) {
        unset($styles[$key]);
      }
    }

    return $styles;
  }

  /**
   * {@inheritdoc}
   */
  public function preView(array &$settings): void {
    $options = [];

    // Grab color settings before they're filtered out or flattened.
    $colors = [];
    if (!empty($settings['colors'])) {
      $colors = $settings['colors'];
      unset($settings['colors']);
    }

    // Grab timezone conversion setting before being filtered out or flattened.
    $convert_timezones = FALSE;
    if (!empty($settings['times']['convert_timezones'])) {
      $convert_timezones = $settings['times']['convert_timezones'];
      unset($settings['times']['convert_timezones']);
    }

    // Save any fields specified for the view.
    $fields = $settings['fields']['date_field'] ?? [];

    // Get updated settings.
    $settings = $this->filterSettings($settings);

    $defaultKeys = $this->getCalendarProperties();

    // buttonIcons - true, false or object.
    if (isset($settings['buttonIcons'])) {
      $_type = in_array($settings['buttonIcons'], [
        'true',
        'false',
      ]) ? 'scalar' : 'object';
      $defaultKeys[$_type][] = 'buttonIcons';
      unset($_type);
    }

    // Prepare FC view-specific options.
    $views = [];
    foreach ([
      'views_year',
      'views_month',
      'views_week',
      'views_day',
    ] as $_views) {
      if (!empty($settings[$_views])) {
        foreach ($settings[$_views] as $key => $value) {
          [$_view, $_option] = explode('_', $key);
          $array = $this->convertKeyValuePairsToArray($value);

          if ($_option === 'buttonText') {
            $views[$_view][$array['key']] = $array['value'];
          }
          else {
            $views[$_view][$_option][$array['key']] = $array['value'];
          }
        }
      }
      unset($settings[$_views]);
    }

    if ($views) {
      $options['views'] = $views;
    }

    // Prepare other FC options.
    $settings = $this->flattenMultidimensionalArray($settings);

    $keys = array_keys($settings);
    foreach ($defaultKeys as $type => $properties) {
      foreach ($properties as $property) {
        if (in_array($property, $keys, TRUE)) {
          switch ($type) {
            case 'scalar':
              $value = match ($settings[$property]) {
                'true' => TRUE,
                'false' => FALSE,
                default => $settings[$property],
              };
              $options[$property] = $value;
              unset($value);

              break;

            case 'array':
              $items = explode(',', $settings[$property]);
              $options[$property] = array_map('trim', $items);
              break;

            case 'object':
              $string = $this->fixCommaSeparatedValues($settings[$property]);
              $values = explode(',', $string);
              foreach ($values as $value) {
                $value = str_replace('_COMMA_', ',', $value);
                $array = $this->convertKeyValuePairsToArray($value);
                $options[$property][$array['key']] = $array['value'];
              }
              break;
          }
        }
        unset($settings[$property]);
      }
    }

    // Add back any color settings.
    if ($colors) {
      $settings['colors'] = $colors;
    }

    // Add back the timezone conversion setting.
    $settings['convert_timezones'] = $convert_timezones;

    // If an event bundle was specified find the appropriate field.
    $start_field = '';
    if ($settings['bundle_type']) {
      $entity_type = $this->style->view->getBaseEntityType()->id();
      // Look first for a specified date field.
      if (!count($fields)) {
        // Find all fields defined in this view as a backup.
        /** @var \Drupal\fullcalendar\Plugin\views\style\FullCalendar $style */
        $style = $this->style;
        $fields = $style->parseFields();
      }
      if (count($fields)) {
        // Use the first field in the content type that aligns with settings.
        $bundle_fields = $this->entityFieldManager->getFieldDefinitions($entity_type, $settings['bundle_type']);
        $date_fields = array_intersect(array_keys($fields), array_keys($bundle_fields));
        $start_field = array_shift($date_fields);
      }
    }
    if ($start_field) {
      $settings['startField'] = $start_field;
    }

    $settings['options'] = $options;

  }

  /**
   * Check for differences in default settings for this view.
   *
   * @param array $settings
   *   Array of view settings.
   *
   * @return array
   *   Settings that are different from the defaults.
   */
  public function filterSettings(array $settings): array {
    // Prepare default options - move 'default' and 'contains' keys a level up.
    $defaults = [];
    $_defaults = $this->getDefaultOptions();
    foreach ($_defaults as $key => $value) {
      if (isset($value['default'])) {
        $defaults[$key] = $value['default'];
      }
      elseif (isset($value['contains'])) {
        foreach ($value['contains'] as $key1 => $value1) {
          $defaults[$key][$key1] = $value1['default'];
        }
      }
    }

    // Diff current settings against default.
    return $this->arrayRecursiveDiff($settings, $defaults);
  }

  /**
   * Check nested arrays for differences.
   *
   * @param array $array1
   *   The original array to check against.
   * @param array $array2
   *   The array to check for in the original one.
   *
   * @return array
   *   Elements in $array1 that are different in $array2.
   */
  public function arrayRecursiveDiff(array $array1, array $array2): array {
    $aReturn = [];

    foreach ($array1 as $mKey => $mValue) {
      if (array_key_exists($mKey, $array2)) {
        if (is_array($mValue)) {
          $aRecursiveDiff = $this->arrayRecursiveDiff($mValue, $array2[$mKey]);
          if (count($aRecursiveDiff)) {
            $aReturn[$mKey] = $aRecursiveDiff;
          }
        }
        elseif ($mValue !== $array2[$mKey]) {
          $aReturn[$mKey] = $mValue;
        }
      }
      else {
        $aReturn[$mKey] = $mValue;
      }
    }
    return $aReturn;
  }

  /**
   * Helper function to check for empty values.
   *
   * @param array $array
   *   The array with values.
   * @param mixed $value
   *   The value.
   * @param string $depth1
   *   The first level key.
   * @param string $depth2
   *   The optional second level key.
   */
  public function filterEmptyValue(array &$array, mixed $value, string $depth1, string $depth2 = ''): void {
    if ($value === '') {
      return;
    }
    if ($depth2 === '') {
      $array[$depth1] = $value;
    }
    else {
      $array[$depth1][$depth2] = $value;
    }
  }

  /**
   * Split a key:value pair into array.
   *
   * @param string $value
   *   A string with key:value pairs.
   *
   * @return array
   *   Associative array of values.
   */
  public function convertKeyValuePairsToArray(string $value): array {
    if (!str_contains($value, self::COMMA_REPLACEMENT)) {
      $value = $this->fixCommaSeparatedValues($value);
    }

    $items = explode(',', $value);
    $items = array_map('trim', $items);
    $array = [];
    foreach ($items as $item) {
      [$key, $value] = explode(':', $item);
      $array['key'] = $key;
      $array['value'] = str_replace([self::COMMA_REPLACEMENT, "'"], [
        ',',
        '',
      ], $value);
    }

    return $array;
  }

  /**
   * Replace commas in quoted strings with _COMMA_.
   *
   * This is to allow us split comma-separated values into arrays later.
   *
   * @param string $value
   *   The comma-separates value.
   *
   * @return string
   *   The string with any commas "," between quotes replaced with _COMMA_.
   */
  public function fixCommaSeparatedValues(string $value): string {
    // Match and replace "," commas between single quotes.
    preg_match_all("/('[^',]+),([^']+')/", $value, $matches);
    foreach ($matches[0] as $match) {
      $_match = str_replace(',', self::COMMA_REPLACEMENT, $match);
      $value = str_replace($match, $_match, $value);
    }
    return $value;
  }

  /**
   * Get list of enabled FC plugins.
   *
   * @param array $settings
   *   Settings for the view.
   *
   * @return array
   *   The list of plugins.
   */
  public function getEnabledFullcalendarPlugins(array $settings): array {
    $plugins = [];
    $form_fields = [
      'month_view' => 'dayGrid',
      'timegrid_view' => 'timeGrid',
      'list_view' => 'list',
      'daygrid_view' => 'dayGrid',
    ];
    foreach ($form_fields as $field => $fcPlugin) {
      if (isset($settings[$field]) && ((bool) $settings[$field] === TRUE)) {
        $plugins[] = $fcPlugin;
      }
    }

    if (!empty($settings['google']['googleCalendarApiKey'])) {
      $plugins[] = 'googleCalendar';
    }

    return $plugins;
  }

  /**
   * Taxonomy colors Ajax callback function.
   */
  public function taxonomyColorCallback(array &$form, FormStateInterface $form_state): array {
    $options = $form_state->getValue('style_options');
    $vid = $options['colors']['vocabularies'];

    if (empty($vid)) {
      return ['#markup' => '<div id="color-taxonomies-div"></div>'];
    }
    else {
      return ['#markup' => '<div id="color-taxonomies-div">Saved and reopen this form to assign colors.</div>'];
    }
  }

  /**
   * Color input box for taxonomy terms of a vocabulary.
   */
  public function colorInputBoxes(string $vid, array $defaultValues, bool $open = FALSE): array {
    if (empty($vid)) {
      return ['#markup' => '<div id="color-taxonomies-div"></div>'];
    }
    // Taxonomy color details.
    $elements = [
      '#type' => 'details',
      '#title' => $this->t('Color by Taxonomy Term'),
      '#fieldset' => 'colors',
      '#open' => $open,
      '#prefix' => '<div id="color-taxonomies-div">',
      '#suffix' => '</div>',
    ];
    // Term IDs of the vocabulary.
    $terms = $this->getTermIds($vid);
    if (isset($terms[$vid])) {
      // Create a color box for each term.
      foreach ($terms[$vid] as $taxonomy) {
        // If the term name is a valid hex color, use as initial default color.
        $initial_color = preg_match('/^#[a-fA-F0-9]{6}$/', $taxonomy->name->value) ? $taxonomy->name->value : $this->defaultColor;
        $defaults = $defaultValues[$taxonomy->id()];
        // Emulate new structure if old config passed.
        if (!is_array($defaults)) {
          $defaults = ['color' => $defaults];
        }
        $color = $defaults['color'] ?? $initial_color;
        $textcolor = $defaults['textColor'] ?? $this->defaultColor;
        $display = $defaults['display'] ?? '';
        $elements[$taxonomy->id()] = [
          'color' => [
            '#title' => $this->t('Color'),
            '#default_value' => $color,
            '#type' => 'color',
            '#prefix' => '<div class="fullcalendar--style-group">',
          ],
          'textColor' => [
            '#title' => $this->t('Text'),
            '#default_value' => $textcolor,
            '#type' => 'color',
          ],
          'display' => [
            '#title' => $this->t('Display Style'),
            '#default_value' => $display,
            '#type' => 'select',
            '#options' => $this->displayOptions,
            '#suffix' => '</div>',
          ],
          '#type' => 'html_tag',
          '#tag' => 'h3',
          '#value' => $taxonomy->name->value,
        ];
      }
    }

    return $elements;
  }

  /**
   * Get all terms of a vocabulary.
   */
  public function getTermIds(string $vid): array {
    if (empty($vid)) {
      return [];
    }
    $terms = &drupal_static(__FUNCTION__);
    // Get taxonomy terms from database if they haven't been loaded.
    if (!isset($terms[$vid])) {
      // Get terms Ids.
      $query = $this->entityTypeManager->getStorage('taxonomy_term')->getQuery();
      $query->condition('vid', $vid);
      $tids = $query->accessCheck(TRUE)->execute();
      $terms[$vid] = $this->entityTypeManager->getStorage('taxonomy_term')->loadMultiple($tids);
    }

    return $terms;
  }

}

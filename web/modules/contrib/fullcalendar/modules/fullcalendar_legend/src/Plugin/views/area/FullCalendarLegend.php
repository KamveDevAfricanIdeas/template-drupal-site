<?php

namespace Drupal\fullcalendar_legend\Plugin\views\area;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\area\AreaPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines an area plugin to display a bundle-specific node/add link.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("fullcalendar_legend")
 */
class FullCalendarLegend extends AreaPluginBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new plugin instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_field_manager
   *   The entity type manager.
   */
  final public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityTypeManagerInterface $entity_field_manager,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityTypeManager = $entity_field_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition,
  ) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['heading_level'] = ['default' => 'h3'];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state): void {
    parent::buildOptionsForm($form, $form_state);

    $form['heading_level'] = [
      '#title' => $this->t('Heading level'),
      '#description' => $this->t('The semantic heading level to use for the section headings.'),
      '#type' => 'select',
      '#options' => [
        'h2' => 'level 2',
        'h3' => 'level 3',
        'h4' => 'level 4',
        'h5' => 'level 5',
      ],
      '#default_value' => $this->options['heading_level'] ?? 'h3',
      '#required' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    $options = $this->view->style_plugin->options;
    if (empty($options) || empty($options['colors'])) {
      return [];
    }
    $element = [
      '#type' => 'container',
      '#attached' => [
        'library' => ['fullcalendar_legend/fullcalendar_legend'],
      ],
      '#attributes' => [
        'class' => ['fullcalendar-legend'],
      ],
    ];
    // Generate a legend for any bundle color overrides.
    if (!empty($options['colors']['color_bundle'])) {
      // Build header.
      $element['bundle'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['fullcalendar-legend--section'],
        ],
      ];
      $bundle_label = $this->view->getBaseEntityType()->getBundleLabel();
      $element['bundle']['heading'] = [
        '#type' => 'html_tag',
        '#tag' => $this->options['heading_level'] ?? 'h3',
        '#value' => $bundle_label,
      ];

      // Generate items, starting with a restructured array.
      $bundle_type = $this->view->getBaseEntityType()->getBundleEntityType();
      $bundle_items = $this->extractList($options['colors']['color_bundle'], $bundle_type);
      $element['bundle']['list'] = $this->generateLegendList($bundle_items);
    }

    // Generate a legend for any taxonomy color overrides.
    if (!empty($options['colors']['color_taxonomies'])) {
      $element['vocab'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['fullcalendar-legend--section'],
        ],
      ];
      // Build header.
      $bundle_label = $this->view->getBaseEntityType()->getBundleLabel();
      $vocab = $options['colors']['vocabularies'];
      $vocab_label = $this->entityTypeManager->getStorage('taxonomy_vocabulary')->load($vocab)->label();
      $element['vocab']['heading'] = [
        '#type' => 'html_tag',
        '#tag' => $this->options['heading_level'] ?? 'h3',
        '#value' => $vocab_label,
      ];

      // Generate items, starting with a restructured array.
      $vocab_items = $this->extractList($options['colors']['color_taxonomies'], 'taxonomy_term');
      $element['vocab']['list'] = $this->generateLegendList($vocab_items);
    }

    return $element;
  }

  /**
   * Massage the incoming config into a more useful structure.
   *
   * @param array $config_items
   *   The source array of configuration.
   * @param string $entity_type
   *   The ID of the entity types being referenced.
   *
   * @return array
   *   The array of massaged values.
   */
  protected function extractList(array $config_items, string $entity_type): array {
    $return_array = [];
    foreach ($config_items as $id => $styles) {
      if (empty($styles)) {
        continue;
      }
      // Emulate new structure if old config passed.
      if (!is_array($styles)) {
        $styles = ['color' => $styles];
      }
      $item = $this->entityTypeManager->getStorage($entity_type)->load($id);
      $label = $item->label();
      $return_array[$id] = $styles + [
        'label' => $label,
      ];
    }
    return $return_array;
  }

  /**
   * Create a list item render array from passed items.
   *
   * @param array $bundle_items
   *   The associative array of items.
   *
   * @return array
   *   A render array of the markup.
   */
  protected function generateLegendList(array $bundle_items): array {
    if (empty($bundle_items)) {
      return [];
    }
    $items = [
      'background' => [],
      'block' => [],
      'default' => [],
    ];
    foreach ($bundle_items as $bundle_item) {
      $color = $bundle_item['color'] ?? '';
      $textColor = 'currentColor';
      $priority = 'default';
      $item = [
        '#markup' => $bundle_item['label'],
        '#wrapper_attributes' => [
          'style' => '--dot-color: ' . $color,
        ],
      ];
      if (!empty($bundle_item['display'])) {
        $item['#wrapper_attributes']['class'][] = 'fc-display--' . $bundle_item['display'];
        if ($bundle_item['display'] === 'block') {
          $textColor = 'white';
        }
        if (array_key_exists($bundle_item['display'], $items)) {
          $priority = $bundle_item['display'];
        }
      }
      if (!empty($bundle_item['textColor'])) {
        $textColor = $bundle_item['textColor'];
      }
      $item['#wrapper_attributes']['style'] .= '; --text-color: ' . $textColor;
      $items[$priority][] = $item;
    }
    $flattened_array = [];
    foreach ($items as $section => $nested_items) {
      foreach ($nested_items as $nested_item) {
        $flattened_array[] = $nested_item;
      }
    }
    return [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#items' => $flattened_array,
    ];
  }

}

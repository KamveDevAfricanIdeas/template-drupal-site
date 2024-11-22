<?php

namespace Drupal\fullcalendar\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\fullcalendar\Annotation\FullcalendarOption;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Plugin type manager for FullCalendar plugins.
 */
class FullcalendarManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  protected $defaults = [
    'css' => FALSE,
    'js'  => FALSE,
  ];

  /**
   * Constructs a FullcalendarManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/fullcalendar/type',
      $namespaces,
      $module_handler,
      FullcalendarInterface::class,
      FullcalendarOption::class
    );
    $this->alterInfo('fullcalendar_type_info');
    $this->setCacheBackend($cache_backend, 'fullcalendar_type_plugins', ['fullcalendar_type_plugins']);
  }

  /**
   * {@inheritdoc}
   */
  public function createInstance($plugin_id, array $configuration = [], ?StylePluginBase $style = NULL) {
    /** @var \Drupal\fullcalendar\Plugin\FullcalendarInterface $plugin */
    $plugin = parent::createInstance($plugin_id, $configuration);

    if ($style !== NULL) {
      $plugin->setStyle($style);
    }

    return $plugin;
  }

}

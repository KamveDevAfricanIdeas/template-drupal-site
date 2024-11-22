<?php

namespace Drupal\fullcalendar\Plugin;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Plugin\DefaultLazyPluginCollection;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Provides the list of all available plugins.
 */
class FullcalendarPluginCollection extends DefaultLazyPluginCollection {

  /**
   * The style plugin.
   *
   * @var \Drupal\views\Plugin\views\style\StylePluginBase
   */
  protected StylePluginBase $style;

  /**
   * Local storage of display IDs.
   */
  protected array $instanceIDs;

  /**
   * Constructs a FullcalendarPluginCollection object.
   *
   * @param \Drupal\Component\Plugin\PluginManagerInterface $manager
   *   The manager to be used for instantiating plugins.
   * @param \Drupal\views\Plugin\views\style\StylePluginBase $style
   *   The style plugin that contains these plugins.
   */
  public function __construct(PluginManagerInterface $manager, StylePluginBase $style) {
    $this->style = $style;
    // Store all display IDs to access them easy and fast.
    $instance_ids = array_keys($manager->getDefinitions());
    $this->instanceIDs = array_combine($instance_ids, $instance_ids);

    parent::__construct($manager, $this->instanceIDs);
  }

  /**
   * {@inheritdoc}
   */
  protected function initializePlugin($instance_id): void {
    if (isset($this->pluginInstances[$instance_id])) {
      return;
    }
    if ($this->manager instanceof FullcalendarManager) {
      $this->pluginInstances[$instance_id] = $this->manager->createInstance($instance_id, [], $this->style);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguration(): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function setConfiguration($configuration): FullcalendarPluginCollection {
    return $this;
  }

}

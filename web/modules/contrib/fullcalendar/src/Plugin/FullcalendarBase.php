<?php

namespace Drupal\fullcalendar\Plugin;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginBase;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Abstract class for FullCalendar type plugins.
 */
abstract class FullcalendarBase extends PluginBase implements FullcalendarInterface {

  /**
   * The style plugin.
   *
   * @var \Drupal\views\Plugin\views\style\StylePluginBase
   */
  protected StylePluginBase $style;

  /**
   * {@inheritdoc}
   */
  public function setStyle(StylePluginBase $style): FullcalendarInterface {
    $this->style = $style;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function submitOptionsForm(array &$form, FormStateInterface $form_state): void {
  }

  /**
   * {@inheritdoc}
   */
  public function process(array &$settings): void {
  }

  /**
   * {@inheritdoc}
   */
  public function preView(array &$settings): void {
  }

}

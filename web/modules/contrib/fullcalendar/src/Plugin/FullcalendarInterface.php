<?php

namespace Drupal\fullcalendar\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Interface for Fullcalendar type plugins.
 */
interface FullcalendarInterface extends PluginInspectionInterface {

  /**
   * Sets the style plugin.
   *
   * @param \Drupal\views\Plugin\views\style\StylePluginBase $style
   *   The style plugin.
   *
   * @return self
   *   This plugin.
   */
  public function setStyle(StylePluginBase $style): FullcalendarInterface;

  /**
   * Gets all FC default options that are supported.
   *
   * @return array
   *   The options.
   */
  public function defineOptions(): array;

  /**
   * Builds the option form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function buildOptionsForm(array &$form, FormStateInterface $form_state): void;

  /**
   * Submits the options form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function submitOptionsForm(array &$form, FormStateInterface $form_state): void;

  /**
   * Processes the plugin.
   *
   * @param array $settings
   *   The settings.
   */
  public function process(array &$settings): void;

  /**
   * Previews the plugin.
   *
   * @param array $settings
   *   The settings.
   */
  public function preView(array &$settings): void;

}

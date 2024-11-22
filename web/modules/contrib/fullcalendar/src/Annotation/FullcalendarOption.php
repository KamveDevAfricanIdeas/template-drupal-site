<?php

namespace Drupal\fullcalendar\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Fullcalendar option annotation object.
 *
 * @Annotation
 */
class FullcalendarOption extends Plugin {

  /**
   * The ID.
   *
   * @var string
   */
  public string $id;

  /**
   * Whether javascript is supported.
   *
   * @var bool
   */
  public bool $js = FALSE;

  /**
   * Whether CSS is supported.
   *
   * @var bool
   */
  public bool $css = FALSE;

  /**
   * The weight.
   *
   * @var int
   */
  public int $weight = 0;

}

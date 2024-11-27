<?php

namespace Drupal\test_custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'My Custom Block' block.
 *
 * @Block(
 *   id = "test_custom_block",
 *   admin_label = @Translation("My Custom Block"),
 *   category = @Translation("Custom")
 * )
 */
class TestBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('This is a custom block created through code!'),
    ];
  }

}
/* 
    To enable this custom block:
        drush en test_custom_block -y
*/
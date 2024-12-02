<?php
  namespace Drupal\cs_img_slideshow\Plugin\Block;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Block\BlockPluginInterface;

   /**
     * Provides a 'My Custom Block' block.
     *
     * @Block(
     *   id = "cs_img_slideshow",
     *   admin_label = @Translation("Custom Slideshow"),
     *   category = @Translation("Custom")
     * )
     */

  class cs_img_slideshow extends BlockBase implements BlockPluginInterface{
    /**
     * {@inheritdoc}
     */
    public function build(){
      return [
        '#markup'=>$this->t('My custom block plugin'),
        '#attached' => [
            'library' => [
                'cs_img_slideshow/slideshow_library',
            ],
        ],
        '#theme' => 'slideshow_block',
      ];
    }
  }
<?php
  namespace Drupal\kamve_image_slideshow\Plugin\Block;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Block\BlockPluginInterface;
  /**
     * Provides a 'My Custom Block' block.
     *
     * @Block(
     *   id = "kamve_image_slideshow",
     *   admin_label = @Translation("Kamve Image Carousel"),
     *   category = @Translation("Custom")
     * )
     */

  class kamve_image_slideshow extends BlockBase implements BlockPluginInterface{
    /** * {@inheritdoc} **/
    public function build(){

      $carousel_block = array (
        '#theme' => 'image_carousel_hook', //must match name in .module file
        '#custom_data' => [
            'carousel_title' => 'Kamve Image Carousel',
            'image_one' => 'The image(s) will go here...',
        ],
        '#custom_banner_info' => 'Hero Banner Information',
        '#attached' => [
            'library' => [
                'kamve_image_slideshow/image_carousel_library' // Reference a custom library in .libraries file.
            ],
        ],
      );
      return $carousel_block;
    }
  }
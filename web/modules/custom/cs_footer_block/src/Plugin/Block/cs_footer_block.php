<?php
  namespace Drupal\cs_footer_block\Plugin\Block;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Block\BlockPluginInterface;
    /**
     * Provides a 'My Custom Block' block.
     *
     * @Block(
     *   id = "cs_footer_block",
     *   admin_label = @Translation("Custom Footer"),
     *   category = @Translation("Custom")
     * )
     */
  class cs_footer_block extends BlockBase implements BlockPluginInterface{
    /**
     * {@inheritdoc}
     */
    public function build(){
        return [
            '#attached' => [
                'library' => [
                    'cs_footer_block/footer_library', // Reference a custom library.
                ],
            ],
            '#theme' => 'footer_block',
            '#custom_data' => [
                'message' => 'Hello Footer',
            ],
        ];
    }
  }
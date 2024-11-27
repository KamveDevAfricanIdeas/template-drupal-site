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
            '#markup' => $this->t('Hi There, Footer'),
            //'#theme' => 'footer_theme',
            // '#data' => [
            //     'message' => 'Hello Footer',
            // ],
            // '#attached' => [
            //     'library' => [
            //         'cs_footer_block/footer_library', // Reference a custom library.
            //     ],
            // ],
        ];
    }
  }

  /* 
  '<section class="">
                        <!-- Footer -->
                        <footer class="text-center" style="color: #f5f6fa; background-color: #2f3640;">
                            <!-- Grid container -->
                            <div class="container p-4 pb-0">
                            <!-- Section: CTA -->
                            <section class="">
                                <p class="d-flex justify-content-center align-items-center">
                                <span class="me-3">Subscribe to stay up-to-date</span>
                                <button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">
                                    Subscribe
                                </button>
                                </p>
                            </section>
                            <!-- Section: CTA -->
                            </div>
                            <!-- Grid container -->
                            <!-- Copyright -->
                            <div class="text-center p-3"
                                style="background-color: rgba(0, 0, 0, 0.2);">
                            © 2024 Copyright:
                            <a class="" style="color: #f5f6fa;" href="#">KhulaZA.gov</a>
                            </div>
                            <!-- Copyright -->
                        </footer>
                        <!-- Footer -->
                        </section>'
  */
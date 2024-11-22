<?php

namespace Drupal\fullcalendar\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Renderer;
use Drupal\fullcalendar\Ajax\ResultsCommand;
use Drupal\views\Entity\View;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for handling ajax requests.
 */
class ResultsController extends ControllerBase {

  /**
   * The current request.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected Request $request;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected Renderer $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): static {
    $instance = parent::create($container);
    $instance->request = $container->get('request_stack')->getCurrentRequest();
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Ajax callback to refresh calendar view.
   *
   * @param \Drupal\views\Entity\View $viewEntity
   *   Fully-loaded view entity.
   * @param string $display_id
   *   Display ID.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   The response.
   */
  public function getResults(View $viewEntity, string $display_id): AjaxResponse {
    $response = new AjaxResponse();
    $view = $viewEntity->getExecutable();

    if (!$view->access($display_id)) {
      return $response;
    }

    if (!$view->setDisplay($display_id)) {
      return $response;
    }

    $args = $this->request->request->get('view_args', '');
    $args = explode('/', $args);

    $view->setExposedInput($this->request->request->all());
    $view->preExecute($args);
    $view->execute($display_id);
    $content = $view->buildRenderable($display_id, $args);

    $rendered = $this->renderer->renderRoot($content);
    $response->addCommand(new ResultsCommand($rendered));

    return $response;
  }

}

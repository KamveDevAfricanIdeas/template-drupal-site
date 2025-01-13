<?php

use Drupal\Core\Entity\EntityTypeManager;

require_once 'core/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$entity_types = \Drupal::entityTypeManager()->getDefinitions();
print_r(array_keys($entity_types));

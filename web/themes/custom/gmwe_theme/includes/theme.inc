<?php

/**
 * @file
 * Custom theme hooks.
 */

function gmwe_theme_preprocess_showcase(&$variables) {
  $counter = &drupal_static(__FUNCTION__, 0);
  $variables['counter'] = ++$counter;
}

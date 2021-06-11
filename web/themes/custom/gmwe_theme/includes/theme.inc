<?php

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Render\Element;

/**
 * @file
 * Custom theme hooks.
 */

function gmwe_theme_preprocess_showcase(&$variables) {
  $variables['image_res'] = [900, 480];
  /** @var ContentEntityInterface|null $entity */
  $entity = NULL;
  foreach (Element::children($variables['content']) as $section) {
    foreach (Element::children($variables['content'][$section]) as $key) {
      $element = $variables['content'][$section][$key];
      if (isset($element['#object']) && $element['#object'] instanceof ContentEntityInterface) {
        $entity = $element['#object'];
        break 2;
      }
    }
  }
  if ($entity !== NULL) {
    $pictureField = Element::children($variables['content']['picture'], TRUE)[0];
    if ($pictureField !== NULL) {
      /** @noinspection NullPointerExceptionInspection */
      $minRes = $entity->getFieldDefinition($pictureField)->getSetting('min_resolution');
      if (substr_count($minRes, 'x')) {
        $variables['image_res'] = explode('x', $minRes);
      }
    }
  }
}

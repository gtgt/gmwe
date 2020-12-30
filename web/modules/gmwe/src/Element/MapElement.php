<?php
namespace Drupal\gmwe\Element;

use Drupal\Core\Render\Annotation\RenderElement;
use Drupal\Core\Render\Element\Container;
use Drupal\Core\Render\Markup;

/**
 * Class MapElement
 *
 * @RenderElement("map")
 */
class MapElement extends Container {

  /**
   * @param array $element
   *
   * @return array
   *
   * @noinspection HtmlDeprecatedAttribute
   */
  public static function preRenderContainer($element) {
    $element['map'] = [
      '#markup' => Markup::create('<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=18.839460611343384%2C47.631579449900805%2C18.843001127243046%2C47.63325680894649&amp;layer=mapnik&amp;marker=47.632418136153476%2C18.841230869293213"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=47.63242&amp;mlon=18.84123#map=19/47.63242/18.84123&amp;layers=ND" target="_blank">Nagyobb térkép</a></small>')
    ];
    return parent::preRenderContainer($element);
  }
}

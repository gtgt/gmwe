<?php

namespace Drupal\gmwe\Plugin\FormAlter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\pluginformalter\Annotation\FormAlter;
use Drupal\pluginformalter\Plugin\FormAlterBase;

/**
 * Class GmweContactFormAlter
 *
 * @FormAlter(
 *   id="gmwe_contact_form_alter",
 *   form_id={"contact_message_default_form"}
 * )
 */
class GmweContactFormAlter extends FormAlterBase {

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * @param string $form_id
   *
   */
  public function formAlter(array &$form, FormStateInterface $form_state, $form_id) {
    $form['info'] = [
      '#theme' => 'item_list',
      '#weight' => -62,
      '#attributes' => [
        'class' => ['list-group', 'list-group-flush', 'mb-5'],
      ],
      '#items' => array_map(static function($item) {
        return is_string($item) ? ['#wrapper_attributes' => ['class' => 'list-group-item'], '#markup' => $item] : $item;
      }, [
        'Telefonszám: (+36) 70 634 7386',
        'Postacím: 2081 Piliscsaba, Béla Király útja 79.',
        Link::fromTextAndUrl('E-mail cím: ovoda@gmwe.hu', Url::fromUri('mailto:ovoda@gmwe.hu'))
      ]),
    ];
    $form['map'] = [
      '#type' => 'map',
      '#weight' => -61,
    ];
    $form['title'] = [
      '#type' => 'html_tag',
      '#weight' => -60,
      '#tag' => 'h2',
      '#value' => 'Írjon nekünk!',
    ];
  }

}

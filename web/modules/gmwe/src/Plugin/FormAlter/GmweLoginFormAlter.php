<?php

namespace Drupal\gmwe\Plugin\FormAlter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\pluginformalter\Annotation\FormAlter;
use Drupal\pluginformalter\Plugin\FormAlterBase;

/**
 * Class GmweContactFormAlter
 *
 * @FormAlter(
 *   id="gmwe_login_form_alter",
 *   form_id={"user_login_form"}
 * )
 */
class GmweLoginFormAlter extends FormAlterBase {

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * @param string $form_id
   *
   */
  public function formAlter(array &$form, FormStateInterface $form_state, $form_id) {
    \Drupal::request()->request->set('destination', Url::fromRoute('gmwe.group.index')->toString());
  }
}

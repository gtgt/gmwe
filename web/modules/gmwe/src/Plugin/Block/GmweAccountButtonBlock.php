<?php

namespace Drupal\gmwe\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an off-canvas 'Login' Block.
 *
 * @Block(
 *   id = "gmwe_account_button_block",
 *   admin_label = @Translation("Account button"),
 *   category = "GMWE",
 * )
 */
class GmweAccountButtonBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new UserLoginBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match')
    );
  }

  /**
   * @return array|false[]
   */
  protected function baseConfigurationDefaults() {
    return ['label_display' => FALSE] + parent::baseConfigurationDefaults();
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $button = [
      '#type' => 'link',
      '#wrapper_attributes' => [
        'class' => ['nav-item', 'mdi', 'mdi-24px', 'mdi-light'],
      ],
      '#attributes' => [
        'class' => ['nav-link'],
      ],
      '#attached' => [
        'library' => [
          'gmwe/icons',
        ],
      ]
    ];
    if (\Drupal::currentUser()->isAnonymous()) {
      $button = array_merge_recursive($button, [
        '#title' => t('User login'),
        '#url' => Url::fromRoute('user.login'),
        '#wrapper_attributes' => [
          'class' => ['mdi-account-circle'],
        ],
        '#attributes' => [
          'class' => ['use-ajax'],
          'data-dialog-renderer' => 'off_canvas',
          'data-dialog-type' => 'dialog',
          'data-dialog-options' => '{"width":"30%"}',
        ],
        '#attached' => [
          'library' => [
            'core/drupal.dialog.ajax',
          ],
        ]
      ]);
    } else {
      $button = array_merge_recursive($button, [
        '#title' => t('Member center'),
        '#url' => Url::fromRoute('gmwe.group.index'),
        '#wrapper_attributes' => [
          'class' => ['mdi-account-circle-outline'],
        ],
      ]);
    }
    return [
      '#attributes' => [
        'class' => 'login-button',
      ],
      'item' => [
        '#theme' => 'item_list',
        '#attributes' => [
          'class' => ['navbar-nav'],
        ],
        '#items' => [
          $button,
        ],
      ],
    ];
  }

}

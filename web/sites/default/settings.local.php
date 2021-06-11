<?php
/** @var string $app_root */

ini_set('display_errors', 1);
error_reporting(error_reporting() & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_STRICT);
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');

$settings['config_sync_directory'] = $app_root . '/../sync/config';

global $content_directories;
$content_directories['sync'] = $app_root.'/../sync/content';

$settings['hash_salt'] = 'RZ4QfDJg2rnY8rD2PlrUYm86wzqZNm3pHFmt2e3EMhVt32aF1rkbPq_Odqr3j1mCgsd_Nt_Sgw';

$settings['class_loader_auto_detect'] = TRUE;

$settings['file_chmod_directory'] = 0775;
$settings['file_chmod_file'] = 0664;

$settings['file_private_path'] = $app_root . '/../private';

$settings['trusted_host_patterns'] = [
  '^(www\.)?gmwe(\.kani)?\.(hu|online)(\.lo)?$',
];

if (substr($_SERVER['HTTP_HOST'], -3) === '.lo') {
  $settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

  $settings['cache']['bins']['render'] = 'cache.backend.null';
  $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
  $settings['cache']['bins']['page'] = 'cache.backend.null';

  $settings['extension_discovery_scan_tests'] = FALSE;

  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;
}

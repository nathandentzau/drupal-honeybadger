<?php

/**
 * @file
 * Autoloader for Drupal PHPUnit testing.
 *
 * @see phpunit.xml.dist
 */

use Drupal\Component\Assertion\Handle;
use Drupal\TestTools\PhpUnitCompatibility\PhpUnit8\ClassWriter;

const TEST_DIR = __DIR__ . '/../vendor/drupal/core/tests';

// We define the COMPOSER_INSTALL constant, so that PHPUnit knows where to
// autoload from. This is needed for tests run in isolation mode, because
// phpunit.xml.dist is located in a non-default directory relative to the
// PHPUnit executable.
if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
  define('PHPUNIT_COMPOSER_INSTALL', TEST_DIR . '/../vendor/autoload.php');
}

/**
 * Populate class loader with additional namespaces for tests.
 *
 * We run this in a function to avoid setting the class loader to a global
 * that can change. This change can cause unpredictable false positives for
 * phpunit's global state change watcher. The class loader can be retrieved from
 * composer at any time by requiring autoload.php.
 */
function drupal_phpunit_populate_class_loader() {

  /** @var \Composer\Autoload\ClassLoader $loader */
  $loader = require __DIR__ . '/../vendor/autoload.php';

  // Start with classes in known locations.
  $loader->add('Drupal\\BuildTests', TEST_DIR);
  $loader->add('Drupal\\Tests', TEST_DIR);
  $loader->add('Drupal\\TestSite', TEST_DIR);
  $loader->add('Drupal\\KernelTests', TEST_DIR);
  $loader->add('Drupal\\FunctionalTests', TEST_DIR);
  $loader->add('Drupal\\FunctionalJavascriptTests', TEST_DIR);
  $loader->add('Drupal\\TestTools', TEST_DIR);

  return $loader;
}

// Do class loader population.
$loader = drupal_phpunit_populate_class_loader();

ClassWriter::mutateTestBase($loader);

// Set sane locale settings, to ensure consistent string, dates, times and
// numbers handling.
// @see \Drupal\Core\DrupalKernel::bootEnvironment()
setlocale(LC_ALL, 'C');

// Set appropriate configuration for multi-byte strings.
mb_internal_encoding('utf-8');
mb_language('uni');

// Set the default timezone. While this doesn't cause any tests to fail, PHP
// complains if 'date.timezone' is not set in php.ini. The Australia/Sydney
// timezone is chosen so all tests are run using an edge case scenario (UTC+10
// and DST). This choice is made to prevent timezone related regressions and
// reduce the fragility of the testing system in general.
date_default_timezone_set('Australia/Sydney');

// Runtime assertions. PHPUnit follows the php.ini assert.active setting for
// runtime assertions. By default this setting is on. Ensure exceptions are
// thrown if an assert fails, but this call does not turn runtime assertions on
// if they weren't on already.
Handle::register();

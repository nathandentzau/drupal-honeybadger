<?php

namespace Drupal\honeybadger\Logger;

use Drupal\Core\Logger\RfcLoggerTrait;
use Honeybadger\Contracts\Reporter;
use Psr\Log\LoggerInterface;

/**
 * Logs events in the watchdog database table.
 */
class HoneybadgerLog implements LoggerInterface {
  use RfcLoggerTrait;

  /**
   * The honeybadger object.
   *
   * @var \Honeybadger\Contracts\Reporter
   */
  protected $honeybadger;

  /**
   * Add the honeybadger object.
   *
   * @param \Honeybadger\Contracts\Reporter $honeybadger
   *   The honeybadger object.
   */
  public function __construct(Reporter $honeybadger) {
    $this->honeybadger = $honeybadger;
  }

  /**
   * {@inheritdoc}
   */
  public function log($level, $message, array $context = []) {}

}

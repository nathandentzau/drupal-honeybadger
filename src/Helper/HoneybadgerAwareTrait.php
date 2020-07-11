<?php

declare(strict_types = 1);

namespace Drupal\honeybadger\Helper;

use Honeybadger\Contracts\Reporter;
use Honeybadger\Honeybadger;

/**
 * Providies a helper to access the honeybadger service in a class.
 */
trait HoneybadgerAwareTrait {

  /**
   * The honeybadger service.
   *
   * @var \Honeybadger\Contracts\Reporter
   */
  protected $honeybadger;

  /**
   * Get the honeybadger service.
   *
   * @return \Honeybadger\Contracts\Reporter
   *   The honeybadger service.
   */
  public function getHoneybadger(): Reporter {
    if (!$this->honeybadger) {
      $this->honeybadger = \Drupal::service(Honeybadger::class);
    }

    return $this->honeybadger;
  }

}

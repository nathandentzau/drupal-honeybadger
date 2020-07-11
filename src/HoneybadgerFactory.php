<?php

declare(strict_types = 1);

namespace Drupal\honeybadger;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ImmutableConfig;
use Honeybadger\Contracts\Reporter;
use Honeybadger\Honeybadger;

/**
 * Provides a factory to instantiate the honeybadger service.
 */
final class HoneybadgerFactory {

  /**
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * Constructor for HoneybadgerFactory.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Create the honeybadger service.
   *
   * @param array $config
   *   The honeybader configuration overrides.
   *
   * @return \Honeybadger\Contracts\Reporter
   *   The honeybadger service.
   */
  public function create(array $config = []): Reporter {
    $config = array_merge($config, $this->getConfig()->getRawData());
    return Honeybadger::new($config);
  }

  /**
   * Get the honeybadger configuration.
   *
   * @return \Drupal\Core\Config\ImmutableConfig
   *   The honeybadger configuration.
   */
  private function getConfig(): ImmutableConfig {
    return $this->configFactory->get('honeybadger.settings');
  }

}

<?php

declare(strict_types = 1);

namespace Drupal\Tests\honeybadger\Unit;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\honeybadger\HoneybadgerFactory;
use Drupal\Tests\UnitTestCase;
use Honeybadger\Honeybadger;

/**
 * @group honeybadger
 */
class HoneybadgerFactoryTest extends UnitTestCase {

  protected $config;

  protected $factory;

  public function setUp(): void {
    parent::setUp();

    $this->config = $this->createMock(ImmutableConfig::class);

    $configFactory = $this->createMock(ConfigFactoryInterface::class);
    $configFactory
      ->expects($this->atLeastOnce())
      ->method('get')
      ->with('honeybadger.settings')
      ->willReturn($this->config);

    $this->factory = new HoneybadgerFactory($configFactory);
  }

  public function testCreate(): void {
    $this->config
      ->expects($this->once())
      ->method('getRawData')
      ->willReturn([]);

    $this->assertInstanceOf(
      Honeybadger::class,
      $this->factory->create(['foo' => 'bar'])
    );
  }

}

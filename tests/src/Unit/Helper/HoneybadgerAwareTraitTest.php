<?php

declare(strict_types = 1);

namespace Drupal\Tests\honeybadger\Unit\Helper;

use Drupal\honeybadger\Helper\HoneybadgerAwareTrait;
use Drupal\Tests\UnitTestCase;
use Honeybadger\Honeybadger;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @group honeybadger
 */
class HoneybadgerAwareTraitTest extends UnitTestCase {

  protected $honeybadger;

  protected function setUp(): void {
    parent::setUp();
    $this->honeybadger = $this->createMock(Honeybadger::class);
  }

  public function testItGetsHoneybadgerFromTheGlobalContainer(): void {
    $container = $this->createMock(ContainerInterface::class);
    $container
      ->expects($this->once())
      ->method('get')
      ->with('Honeybadger\Honeybadger')
      ->willReturn($this->honeybadger);

    \Drupal::setContainer($container);

    $this->assertInstanceOf(
      Honeybadger::class,
      $this->createStub()->getHoneybadger()
    );
  }

  protected function createStub() {
    return new class {
      use HoneybadgerAwareTrait;
    };
  }

}

# Honeybadger

This is a [Honeybadger][] integration module for Drupal.

## Requirements

* PHP `^7.3 || ^8.0`
* Drupal `^8.7 || ^9.0 || ^10`

## Installation

This module must be installed with [Composer][]:

```bash
$ composer require nathandentzau/drupal-honeybadger
```

## Configuration

At this time, the module is only configurable via the settings.php file. In your
settings file add the following:

```php
$config['honeybadger.settings'] = [
  'api_key' => 'YOUR API KEY',
  'environment' => [
    'filter' => [],
    'include' => [],
  ],
  'request' => [
    'filter' => [],
  ],
  'version' => NULL,
  'hostname' => $_SERVER['HOST'],
  'project_root' => DRUPAL_ROOT,
  'environment_name' => 'THE CURRENT ENVIRONMENT',
  'handlers' => [
    'exception' => true,
    'error' => true,
  ],
  'client' => [
    'timeout' => 0,
    'proxy' => [],
  ],
  'excluded_exceptions' => [],
  'report_data' => true,
];
```

See the [Honeybadger integration documentation][] for more information on the
settings above.

## Testing

This project contains unit tests and code linters.

* PHPUnit: `composer phpunit`
* PHPCS: `composer phpcs`

## Maintainers

* [Nathan Dentzau][]

[Honeybadger]: https://honeybadger.io
[Composer]: https://getcomposer.org
[Honeybadger integration documentation]: https://docs.honeybadger.io/lib/php/index.html
[Nathan Dentzau]: https://drupal.org/u/nathandentzau

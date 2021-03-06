## Settings Loader
Simple configuration file loader. Supports PHP, JSON, INI and XML files.

## Requirements
Settings Loader requires PHP 5.4+.

## Installation

The supported way of installing Config is via Composer.

```sh
$ composer require asmakaruk/settings-loader
```

## Usage

Settings Loader is very simple to use. You can load files and get settings values.

## Loading files

```php
// Loading single file
$data = \Configuration\Settings::load('config.ini');
//Load values from multiple files
$data = \Configuration\Settings::load(['config.json', 'config.xml']);
//Load values from directory
$data = \Configuration\Settings::load(__DIR__ . '/config');
```

### Getting values

Getting values can be done in two ways. One, by using the `get()` method:

```php
$app = \Configuration\Settings::get('app');
$timezone = \Configuration\Settings::get('app.timezone');
$host = \Configuration\Settings::get('app.host', 'localhost');
```


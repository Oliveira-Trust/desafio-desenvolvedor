# Changes in PHPUnit 10.2

All notable changes of the PHPUnit 10.2 release series are documented in this file using the [Keep a CHANGELOG](https://keepachangelog.com/) principles.

## [10.2.3] - 2023-06-30

### Changed

* [#5419](https://github.com/sebastianbergmann/phpunit/pull/5419): Allow empty `<extensions>` element in XML configuration

## [10.2.2] - 2023-06-11

### Fixed

* [#5405](https://github.com/sebastianbergmann/phpunit/issues/5405): XML configuration migration does not migrate `whitelist/file` elements

## [10.2.1] - 2023-06-05

### Changed

* `PHPUnit\Runner\ErrorHandler` no longer emits events for errors that occur in PHPUnit's own code (or code of its dependencies) and are suppressed using the `@` operator

## [10.2.0] - 2023-06-02

### Added

* [#5328](https://github.com/sebastianbergmann/phpunit/issues/5328): Optionally ignore suppression of deprecations, notices, and warnings
* `PHPUnit\Event\Test\DataProviderMethodCalled` and `PHPUnit\Event\Test\DataProviderMethodFinished` events

### Changed

* Improved the reporting of errors during the loading and bootstrapping of test runner extensions

### Deprecated

* `PHPUnit\TextUI\Configuration\Configuration::restrictDeprecations()` (use `source()->restrictDeprecations()` instead)
* `PHPUnit\TextUI\Configuration\Configuration::restrictNotices()` (use `source()->restrictNotices()` instead)
* `PHPUnit\TextUI\Configuration\Configuration::restrictWarnings()` (use `source()->restrictWarnings()` instead)

### Fixed

* [#5364](https://github.com/sebastianbergmann/phpunit/issues/5364): Confusing warning message `Class ... cannot be found` when class is found, but does not extend `PHPUnit\Framework\TestCase`
* [#5366](https://github.com/sebastianbergmann/phpunit/issues/5366): `PHPUnit\Event\TestSuite\Loaded` event has incomplete `PHPUnit\Event\TestSuite\TestSuite` value object
* Always use `X.Y.Z` version number (and not just `X.Y`) of PHPUnit's version when checking whether a PHAR-distributed extension is compatible

[10.2.3]: https://github.com/sebastianbergmann/phpunit/compare/10.2.2...10.2.3
[10.2.2]: https://github.com/sebastianbergmann/phpunit/compare/10.2.1...10.2.2
[10.2.1]: https://github.com/sebastianbergmann/phpunit/compare/10.2.0...10.2.1
[10.2.0]: https://github.com/sebastianbergmann/phpunit/compare/10.1.3...10.2.0

# CHANGELOG

## [3.0.0] - 2026-10-14

### Changed
* [BC] Requires PHP 8.5 and `compono-kit/money-interfaces` ^2.0
* [BC] `LocalizedMoneyFormatter` and `LocalizedDecimalMoneyFormatter` throw `FormattingFailedException` if the `NumberFormatter` fails instead of failing with a type error
* `CurrencyOutput::NONE` is handled explicitly
* The localized formatters use the pipe operator to replace non-breaking spaces

### Added
* `Exceptions\FormattingFailedException`

### Fixed
* Tests of `SimpleMoneyFormatter` and `LocalizedDecimalMoneyFormatter` were swapped and did not run with PHPUnit 12, because data providers were declared as annotations

---

## [2.0.0] - 2025-10-19

### Changed
* Uses now PHP 8.3 
* [BC] CurrencyOutput is now an enum

---

## [1.0.0] - 2025-10-19

### Added
* Initial release

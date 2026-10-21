# Money Formatters

A lightweight PHP package providing flexible and locale-aware money string formatters.  
It includes three formatter classes for different use cases — from simple decimal formatting to fully localized currency output.
Uses interfaces from compono-kit/money-interfaces.

## Requirements

* PHP >= 8.5
* compono-kit/money-interfaces

## 📦 Installation

```bash
composer require compono-kit/money-formatters
```

---

## 🚀 Overview

This package defines three money formatters that implement the same interface `FormatsMoneyString`.

| Class | Description | Locale-Aware | Controls Currency Symbol |
|--------|--------------|--------------|---------------------------|
| `SimpleMoneyFormatter` | Simple decimal formatting without localization (technical format). | ❌ | ✅ |
| `LocalizedDecimalMoneyFormatter` | Locale-based decimal formatting using PHP’s Intl component, with manual control over the currency symbol position. | ✅ | ✅ |
| `LocalizedMoneyFormatter` | Fully localized currency formatting using Intl’s built-in currency rules. | ✅ | ❌ (handled by locale) |

---

## Interfaces & Traits

Each formatter implements:

```php
interface FormatsMoneyString
{
    public function formatString(RepresentsMoney $money): string;
}
```

---

## Classes

### `SimpleMoneyFormatter`

Formats a `RepresentsMoney` instance as a plain decimal string without localization.  
Useful for APIs or technical output where consistency matters more than human readability.

```php
$formatter = new SimpleMoneyFormatter(CurrencyOutput::RIGHT_SYMBOL);

echo $formatter->formatString($money);
// Example: 1234.56 €
```

**Features**
- No locale dependency.
- No thousand separators.
- Optional control for currency presentation using enum `CurrencyOutput`:
    - `LEFT_SYMBOL` => Example: € 1234.56
    - `RIGHT_SYMBOL` => Example: 1234.56 €
    - `LEFT_ISO_CODE` => Example: EUR 1234.56
    - `RIGHT_ISO_CODE` => Example: 1234.56 EUR
    - `NONE` => Example: 1234.56

---

### `LocalizedDecimalMoneyFormatter`

Formats a money value using PHP’s `\NumberFormatter` with the `DECIMAL` style.  
This provides localized decimal separators, but keeps currency presentation customizable.

```php
$formatter = new LocalizedDecimalMoneyFormatter('de_DE', CurrencyOutput::LEFT_SYMBOL);

echo $formatter->formatString($money);
// Example (German locale, left symbol): € 1.234,56
```

**Features**
- Locale-dependent decimal separators.
- Ideal when you want localized numbers but still want control over currency display.
- Optional control for currency presentation using enum `CurrencyOutput`:
    - `LEFT_SYMBOL` => Example: € 1.234,56
    - `RIGHT_SYMBOL` => Example: 1.234,56 €
    - `LEFT_ISO_CODE` => Example: EUR 1.234,56
    - `RIGHT_ISO_CODE` => Example: 1.234,56 EUR
    - `NONE` => Example: 1.234,56

---

### `LocalizedMoneyFormatter`

Uses PHP’s `\NumberFormatter::CURRENCY` to produce **fully localized** money strings.  
This is the most “natural” presentation for end users.

```php
$formatter = new LocalizedMoneyFormatter('en_US');

echo $formatter->formatString($money);
// Example: $1,234.56
```

**Features**
- Fully localized formatting.
- Locale determines symbol, placement, and spacing automatically.
- Best suited for UI display and end-user presentation.

---

## ⚙️ CurrencyOutput Options

`CurrencyOutput` defines how the currency symbol is positioned:

```php
CurrencyOutput::LEFT_SYMBOL // e.g. € 1.234,56
CurrencyOutput::RIGHT_SYMBOL // e.g. 1.234,56 €
CurrencyOutput::LEFT_ISO_CODE  // e.g. EUR 1.234,56
CurrencyOutput::RIGHT_ISO_CODE   // e.g.  1.234,56 EUR
CurrencyOutput::NONE   // e.g. 1.234,56
```

## 🢙 Summary

This package is designed to be **small, predictable, and composable** —  
you decide how much localization you want, while keeping all formatters interchangeable via the same interface

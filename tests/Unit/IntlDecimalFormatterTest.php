<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\Constants\CurrencyOutput;
use ComponoKit\Money\Formatters\IntlDecimalFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use PHPUnit\Framework\TestCase;

class IntlDecimalFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			[ 0, 'de_DE', CurrencyOutput::NONE, '0' ],
			[ 100, 'de_DE', CurrencyOutput::NONE, '1' ],
			[ 10000000000, 'de_DE', CurrencyOutput::NONE, '100.000.000' ],
			[ 123456789, 'en_US', CurrencyOutput::NONE, '1,234,567.89' ],
			[ -123456789, 'en_US', CurrencyOutput::NONE, '-1,234,567.89' ],
			[ 5990, 'en_US', CurrencyOutput::NONE, '59.9' ],
			[ -5990, 'en_US', CurrencyOutput::NONE, '-59.9' ],
			[ 5990, 'de_DE', CurrencyOutput::NONE, '59,9' ],
			[ -5990, 'de_DE', CurrencyOutput::NONE, '-59,9' ],
			[ 590090, 'en_US', CurrencyOutput::NONE, '5,900.9' ],
			[ -590090, 'en_US', CurrencyOutput::NONE, '-5,900.9' ],
			[ 590090, 'de_DE', CurrencyOutput::NONE, '5.900,9' ],
			[ -590090, 'de_DE', CurrencyOutput::NONE, '-5.900,9' ],
			[ 0, 'de_DE', CurrencyOutput::LEFT_SYMBOL, '€ 0' ],
			[ 0, 'de_DE', CurrencyOutput::RIGHT_SYMBOL, '0 €' ],
			[ 0, 'de_DE', CurrencyOutput::LEFT_ISO_CODE, 'EUR 0' ],
			[ 0, 'de_DE', CurrencyOutput::RIGHT_ISO_CODE, '0 EUR' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testFormat( int $amount, string $locale, string $currencyOutput, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, IntlDecimalFormatter::format( $this->buildMoney( $amount ), $locale, $currencyOutput ) );
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testFormatString( int $amount, string $locale, string $currencyOutput, string $expectedOutput ): void
	{
		$formatter = new IntlDecimalFormatter( $locale, $currencyOutput );

		self::assertEquals( $expectedOutput, $formatter->formatString( $this->buildMoney( $amount ) ) );
	}
}

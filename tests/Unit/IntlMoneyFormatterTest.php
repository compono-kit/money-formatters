<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\IntlMoneyFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use PHPUnit\Framework\TestCase;

class IntlMoneyFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			[ 0, 'EUR', 100, 'de_DE', '0,00 €' ],
			[ 100, 'EUR', 100, 'de_DE', '1,00 €' ],
			[ 10000000000, 'EUR', 100, 'de_DE', '100.000.000,00 €' ],
			[ 123456789, 'EUR', 100, 'en_US', '€1,234,567.89' ],
			[ -123456789, 'EUR', 100, 'en_US', '-€1,234,567.89' ],
			[ 5990, 'USD', 100, 'en_US', '$59.90' ],
			[ -5990, 'USD', 100, 'en_US', '-$59.90' ],
			[ 5990, 'EUR', 100, 'de_DE', '59,90 €' ],
			[ -5990, 'EUR', 100, 'de_DE', '-59,90 €' ],
			[ 590090, 'EUR', 100, 'en_US', '€5,900.90' ],
			[ -590090, 'EUR', 100, 'en_US', '-€5,900.90' ],
			[ 590090, 'EUR', 100, 'de_DE', '5.900,90 €' ],
			[ -590090, 'EUR', 100, 'de_DE', '-5.900,90 €' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testIfFormattingReturnsExpectedOutput( int $amount, string $currencyCode, int $minorUnitFactor, string $locale, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, IntlMoneyFormatter::format( $this->buildMoney( $amount, $currencyCode, $minorUnitFactor ), $locale ) );
	}
}

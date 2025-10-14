<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\IntlDecimalFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use PHPUnit\Framework\TestCase;

class IntlDecimalFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			[ 0, 'EUR', 100, 'de_DE', '0' ],
			[ 100, 'EUR', 100, 'de_DE', '1' ],
			[ 10000000000, 'EUR', 100, 'de_DE', '100.000.000' ],
			[ 123456789, 'EUR', 100, 'en_US', '1,234,567.89' ],
			[ -123456789, 'EUR', 100, 'en_US', '-1,234,567.89' ],
			[ 5990, 'USD', 100, 'en_US', '59.9' ],
			[ -5990, 'USD', 100, 'en_US', '-59.9' ],
			[ 5990, 'EUR', 100, 'de_DE', '59,9' ],
			[ -5990, 'EUR', 100, 'de_DE', '-59,9' ],
			[ 590090, 'EUR', 100, 'en_US', '5,900.9' ],
			[ -590090, 'EUR', 100, 'en_US', '-5,900.9' ],
			[ 590090, 'EUR', 100, 'de_DE', '5.900,9' ],
			[ -590090, 'EUR', 100, 'de_DE', '-5.900,9' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testIfFormattingReturnsExpectedOutput( int $amount, string $currencyCode, int $minorUnitFactor, string $locale, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, IntlDecimalFormatter::format( $this->buildMoney( $amount, $currencyCode, $minorUnitFactor ), $locale ) );
	}
}

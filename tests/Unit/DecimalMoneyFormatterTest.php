<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\DecimalMoneyFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use PHPUnit\Framework\TestCase;

class DecimalMoneyFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			[ 0, 'EUR', 100, '0.00' ],
			[ 100, 'EUR', 100, '1.00' ],
			[ 123456789, 'EUR', 100, '1234567.89' ],
			[ -123456789, 'EUR', 100, '-1234567.89' ],
			[ 5990, 'EUR', 100, '59.90' ],
			[ -5990, 'EUR', 100, '-59.90' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testIfFormattingReturnsExpectedOutput( int $amount, string $currencyCode, int $minorUnitFactor, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, DecimalMoneyFormatter::format( $this->buildMoney( $amount, $currencyCode, $minorUnitFactor ) ) );
	}
}

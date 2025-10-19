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
			[ 0, 'de_DE', '0,00 €' ],
			[ 100, 'de_DE', '1,00 €' ],
			[ 10000000000, 'de_DE', '100.000.000,00 €' ],
			[ 123456789, 'en_US', '€1,234,567.89' ],
			[ -123456789, 'en_US', '-€1,234,567.89' ],
			[ 5990, 'en_US', '€59.90' ],
			[ -5990, 'en_US', '-€59.90' ],
			[ 5990, 'de_DE', '59,90 €' ],
			[ -5990, 'de_DE', '-59,90 €' ],
			[ 590090, 'en_US', '€5,900.90' ],
			[ -590090, 'en_US', '-€5,900.90' ],
			[ 590090, 'de_DE', '5.900,90 €' ],
			[ -590090, 'de_DE', '-5.900,90 €' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testIfFormattingReturnsExpectedOutput( int $amount, string $locale, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, IntlMoneyFormatter::format( $this->buildMoney( $amount ), $locale ) );
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testFormatString( int $amount, string $locale, string $expectedOutput ): void
	{
		$formatter = new IntlMoneyFormatter( $locale );

		self::assertEquals( $expectedOutput, $formatter->formatString( $this->buildMoney( $amount ) ) );
	}
}

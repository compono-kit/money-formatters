<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\Constants\CurrencyOutput;
use ComponoKit\Money\Formatters\DecimalMoneyFormatter;
use ComponoKit\Money\Formatters\IntlDecimalFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use PHPUnit\Framework\TestCase;

class DecimalMoneyFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			[ 0, CurrencyOutput::NONE, '0.00' ],
			[ 100, CurrencyOutput::NONE, '1.00' ],
			[ 123456789, CurrencyOutput::NONE, '1234567.89' ],
			[ -123456789, CurrencyOutput::NONE, '-1234567.89' ],
			[ 5990, CurrencyOutput::NONE, '59.90' ],
			[ -5990, CurrencyOutput::NONE, '-59.90' ],
			[ 0, CurrencyOutput::LEFT_SYMBOL, '€ 0.00' ],
			[ 0, CurrencyOutput::RIGHT_SYMBOL, '0.00 €' ],
			[ 0, CurrencyOutput::LEFT_ISO_CODE, 'EUR 0.00' ],
			[ 0, CurrencyOutput::RIGHT_ISO_CODE, '0.00 EUR' ],
		];
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testFormat( int $amount, string $currencyOutput, string $expectedOutput ): void
	{
		self::assertEquals( $expectedOutput, DecimalMoneyFormatter::format( $this->buildMoney( $amount ), $currencyOutput ) );
	}

	/**
	 * @dataProvider MoneyDataProvider
	 */
	public function testFormatString( int $amount, string $currencyOutput, string $expectedOutput ): void
	{
		$formatter = new DecimalMoneyFormatter( $currencyOutput );

		self::assertEquals( $expectedOutput, $formatter->formatString( $this->buildMoney( $amount ) ) );
	}
}

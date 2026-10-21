<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\SimpleMoneyFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SimpleMoneyFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			'zero'                         => [ 0, CurrencyOutput::NONE, '0.00' ],
			'one unit'                     => [ 100, CurrencyOutput::NONE, '1.00' ],
			'large amount'                 => [ 123456789, CurrencyOutput::NONE, '1234567.89' ],
			'large negative amount'        => [ -123456789, CurrencyOutput::NONE, '-1234567.89' ],
			'amount with trailing zero'    => [ 5990, CurrencyOutput::NONE, '59.90' ],
			'negative with trailing zero'  => [ -5990, CurrencyOutput::NONE, '-59.90' ],
			'symbol on the left'           => [ 0, CurrencyOutput::LEFT_SYMBOL, '€ 0.00' ],
			'symbol on the right'          => [ 0, CurrencyOutput::RIGHT_SYMBOL, '0.00 €' ],
			'iso code on the left'         => [ 0, CurrencyOutput::LEFT_ISO_CODE, 'EUR 0.00' ],
			'iso code on the right'        => [ 0, CurrencyOutput::RIGHT_ISO_CODE, '0.00 EUR' ],
		];
	}

	#[DataProvider( 'MoneyDataProvider' )]
	public function testFormat( int $amount, CurrencyOutput $currencyOutput, string $expectedOutput ): void
	{
		self::assertSame( $expectedOutput, SimpleMoneyFormatter::format( $this->buildMoney( $amount ), $currencyOutput ) );
	}

	#[DataProvider( 'MoneyDataProvider' )]
	public function testFormatString( int $amount, CurrencyOutput $currencyOutput, string $expectedOutput ): void
	{
		$formatter = new SimpleMoneyFormatter( $currencyOutput );

		self::assertSame( $expectedOutput, $formatter->formatString( $this->buildMoney( $amount ) ) );
	}

	public function testFormatCurrencyWithoutMinorUnits(): void
	{
		self::assertSame( '1234 ¥', SimpleMoneyFormatter::format( $this->buildMoney( 1234, 'JPY', '¥', 1 ) ) );
	}
}

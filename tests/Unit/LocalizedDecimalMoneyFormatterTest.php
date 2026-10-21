<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Unit;

use ComponoKit\Money\Formatters\LocalizedDecimalMoneyFormatter;
use ComponoKit\Money\Formatters\Tests\Traits\BuildingMoney;
use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LocalizedDecimalMoneyFormatterTest extends TestCase
{
	use BuildingMoney;

	public static function MoneyDataProvider(): array
	{
		return [
			'zero in german'                    => [ 0, 'de_DE', CurrencyOutput::NONE, '0' ],
			'one unit in german'                => [ 100, 'de_DE', CurrencyOutput::NONE, '1' ],
			'large amount in german'            => [ 10000000000, 'de_DE', CurrencyOutput::NONE, '100.000.000' ],
			'large amount in english'           => [ 123456789, 'en_US', CurrencyOutput::NONE, '1,234,567.89' ],
			'large negative amount in english'  => [ -123456789, 'en_US', CurrencyOutput::NONE, '-1,234,567.89' ],
			'fraction in english'               => [ 5990, 'en_US', CurrencyOutput::NONE, '59.9' ],
			'negative fraction in english'      => [ -5990, 'en_US', CurrencyOutput::NONE, '-59.9' ],
			'fraction in german'                => [ 5990, 'de_DE', CurrencyOutput::NONE, '59,9' ],
			'negative fraction in german'       => [ -5990, 'de_DE', CurrencyOutput::NONE, '-59,9' ],
			'thousands in english'              => [ 590090, 'en_US', CurrencyOutput::NONE, '5,900.9' ],
			'negative thousands in english'     => [ -590090, 'en_US', CurrencyOutput::NONE, '-5,900.9' ],
			'thousands in german'               => [ 590090, 'de_DE', CurrencyOutput::NONE, '5.900,9' ],
			'negative thousands in german'      => [ -590090, 'de_DE', CurrencyOutput::NONE, '-5.900,9' ],
			'symbol on the left'                => [ 0, 'de_DE', CurrencyOutput::LEFT_SYMBOL, '€ 0' ],
			'symbol on the right'               => [ 0, 'de_DE', CurrencyOutput::RIGHT_SYMBOL, '0 €' ],
			'iso code on the left'              => [ 0, 'de_DE', CurrencyOutput::LEFT_ISO_CODE, 'EUR 0' ],
			'iso code on the right'             => [ 0, 'de_DE', CurrencyOutput::RIGHT_ISO_CODE, '0 EUR' ],
		];
	}

	#[DataProvider( 'MoneyDataProvider' )]
	public function testFormat( int $amount, string $locale, CurrencyOutput $currencyOutput, string $expectedOutput ): void
	{
		self::assertSame( $expectedOutput, LocalizedDecimalMoneyFormatter::format( $this->buildMoney( $amount ), $locale, $currencyOutput ) );
	}

	#[DataProvider( 'MoneyDataProvider' )]
	public function testFormatString( int $amount, string $locale, CurrencyOutput $currencyOutput, string $expectedOutput ): void
	{
		$formatter = new LocalizedDecimalMoneyFormatter( $locale, $currencyOutput );

		self::assertSame( $expectedOutput, $formatter->formatString( $this->buildMoney( $amount ) ) );
	}
}

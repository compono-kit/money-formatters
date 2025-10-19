<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use ComponoKit\Money\Formatters\Traits\BuildingFormattedString;
use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

final class LocalizedDecimalMoneyFormatter implements FormatsMoneyString
{
	use BuildingFormattedString;

	public function __construct( private readonly string $locale, private readonly CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->locale, $this->currencyOutput );
	}

	public static function format( RepresentsMoney $money, string $locale, CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL ): string
	{
		$numberFormatter = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL );

		return self::build(
			str_replace( "\xc2\xa0", ' ', $numberFormatter->format( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor() ) ),
			$money->getCurrency(),
			$currencyOutput
		);
	}
}

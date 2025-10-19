<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Formatters\Constants\CurrencyOutput;
use ComponoKit\Money\Formatters\Traits\BuildingFormattedString;
use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

class IntlDecimalFormatter implements FormatsMoneyString
{
	use BuildingFormattedString;

	public function __construct( private string $locale, private string $currencyOutput = CurrencyOutput::RIGHT_SYMBOL )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->locale, $this->currencyOutput );
	}

	public static function format( RepresentsMoney $money, string $locale, string $currencyOutput = CurrencyOutput::RIGHT_SYMBOL ): string
	{
		$numberFormatter = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL );

		return self::build(
			str_replace( "\xc2\xa0", ' ', $numberFormatter->format( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor() ) ),
			$money->getCurrency(),
			$currencyOutput
		);
	}
}

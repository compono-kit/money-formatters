<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Traits;

use ComponoKit\Money\Formatters\Constants\CurrencyOutput;
use ComponoKit\Money\Interfaces\RepresentsCurrency;

trait BuildingFormattedString
{
	private static function build( string $amount, RepresentsCurrency $currency, string $currencyOutput ): string
	{
		switch ( $currencyOutput )
		{
			case CurrencyOutput::RIGHT_SYMBOL:
				return $amount . ' ' . $currency->getSymbol();

			case CurrencyOutput::RIGHT_ISO_CODE:
				return $amount . ' ' . $currency->getIsoCode();

			case CurrencyOutput::LEFT_SYMBOL:
				return $currency->getSymbol() . ' ' . $amount;

			case CurrencyOutput::LEFT_ISO_CODE:
				return $currency->getIsoCode() . ' ' . $amount;

			default:
				return $amount;
		}
	}
}

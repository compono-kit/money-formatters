<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Traits;

use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use ComponoKit\Money\Interfaces\RepresentsCurrency;

trait BuildingFormattedString
{
	private static function build( string $amount, RepresentsCurrency $currency, CurrencyOutput $currencyOutput ): string
	{
		return match ($currencyOutput)
		{
			CurrencyOutput::RIGHT_SYMBOL   => $amount . ' ' . $currency->getSymbol(),
			CurrencyOutput::RIGHT_ISO_CODE => $amount . ' ' . $currency->getIsoCode(),
			CurrencyOutput::LEFT_SYMBOL    => $currency->getSymbol() . ' ' . $amount,
			CurrencyOutput::LEFT_ISO_CODE  => $currency->getIsoCode() . ' ' . $amount,
			default                        => $amount
		};
	}
}

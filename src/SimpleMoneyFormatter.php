<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use ComponoKit\Money\Formatters\Traits\BuildingFormattedString;
use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

final class SimpleMoneyFormatter implements FormatsMoneyString
{
	use BuildingFormattedString;

	public function __construct( private readonly CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->currencyOutput );
	}

	public static function format( RepresentsMoney $money, CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL ): string
	{
		return self::build(
			number_format(
				$money->getAmount() / $money->getCurrency()->getMinorUnitFactor(),
				(int)log10( $money->getCurrency()->getMinorUnitFactor() ),
				'.',
				''
			),
			$money->getCurrency(),
			$currencyOutput
		);
	}
}

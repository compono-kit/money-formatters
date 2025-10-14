<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

class DecimalMoneyFormatter implements FormatsMoneyString
{
	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money );
	}

	public static function format( RepresentsMoney $money ): string
	{
		return number_format( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor(), (int)log10( $money->getCurrency()->getMinorUnitFactor() ), '.', '' );
	}
}

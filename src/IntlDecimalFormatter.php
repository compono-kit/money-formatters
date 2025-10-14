<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

class IntlDecimalFormatter implements FormatsMoneyString
{
	public function __construct( private string $locale )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->locale );
	}

	public static function format( RepresentsMoney $money, string $locale ): string
	{
		$numberFormatter = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL );

		return str_replace( "\xc2\xa0", ' ', $numberFormatter->format( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor() ) );
	}
}

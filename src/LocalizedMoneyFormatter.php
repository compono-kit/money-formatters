<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

class LocalizedMoneyFormatter implements FormatsMoneyString
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
		$numberFormatter = new \NumberFormatter( $locale, \NumberFormatter::CURRENCY );

		return str_replace(
			"\xc2\xa0",
			' ',
			$numberFormatter->formatCurrency( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor(), $money->getCurrency()->getIsoCode() )
		);
	}
}

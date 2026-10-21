<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Formatters\Exceptions\FormattingFailedException;
use ComponoKit\Money\Formatters\Traits\ReplacingNonBreakingSpaces;
use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

final class LocalizedMoneyFormatter implements FormatsMoneyString
{
	use ReplacingNonBreakingSpaces;

	public function __construct( private readonly string $locale )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->locale );
	}

	public static function format( RepresentsMoney $money, string $locale ): string
	{
		$formattedMoney = new \NumberFormatter( $locale, \NumberFormatter::CURRENCY )->formatCurrency(
			$money->getAmount() / $money->getCurrency()->getMinorUnitFactor(),
			$money->getCurrency()->getIsoCode()
		);

		if ( false === $formattedMoney )
		{
			throw new FormattingFailedException( 'Money could not be formatted for locale ' . $locale );
		}

		return $formattedMoney |> self::replaceNonBreakingSpaces( ... );
	}
}

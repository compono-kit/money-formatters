<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters;

use ComponoKit\Money\Formatters\Exceptions\FormattingFailedException;
use ComponoKit\Money\Formatters\Traits\BuildingFormattedString;
use ComponoKit\Money\Formatters\Traits\ReplacingNonBreakingSpaces;
use ComponoKit\Money\Formatters\Types\CurrencyOutput;
use ComponoKit\Money\Interfaces\FormatsMoneyString;
use ComponoKit\Money\Interfaces\RepresentsMoney;

final class LocalizedDecimalMoneyFormatter implements FormatsMoneyString
{
	use BuildingFormattedString;
	use ReplacingNonBreakingSpaces;

	public function __construct( private readonly string $locale, private readonly CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL )
	{
	}

	public function formatString( RepresentsMoney $money ): string
	{
		return self::format( $money, $this->locale, $this->currencyOutput );
	}

	public static function format( RepresentsMoney $money, string $locale, CurrencyOutput $currencyOutput = CurrencyOutput::RIGHT_SYMBOL ): string
	{
		$formattedAmount = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL )->format( $money->getAmount() / $money->getCurrency()->getMinorUnitFactor() );

		if ( false === $formattedAmount )
		{
			throw new FormattingFailedException( 'Money could not be formatted for locale ' . $locale );
		}

		return self::build( $formattedAmount |> self::replaceNonBreakingSpaces( ... ), $money->getCurrency(), $currencyOutput );
	}
}

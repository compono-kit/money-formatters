<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Traits;

trait ReplacingNonBreakingSpaces
{
	private const string NON_BREAKING_SPACE = "\u{00A0}";

	private static function replaceNonBreakingSpaces( string $value ): string
	{
		return str_replace( self::NON_BREAKING_SPACE, ' ', $value );
	}
}

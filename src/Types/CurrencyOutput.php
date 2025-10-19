<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Types;

enum CurrencyOutput
{
	case NONE;

	case LEFT_SYMBOL;

	case RIGHT_SYMBOL;

	case LEFT_ISO_CODE;

	case RIGHT_ISO_CODE;
}

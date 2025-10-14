<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Traits;

use ComponoKit\Money\Interfaces\RepresentsCurrency;
use ComponoKit\Money\Interfaces\RepresentsMoney;

trait BuildingMoney
{
	private function buildMoney( int $amount, string $currencyCode, int $minorUnitFactor ): RepresentsMoney
	{
		$currency = $this->createMock( RepresentsCurrency::class );
		$currency->method( 'getIsoCode' )->willReturn( $currencyCode );
		$currency->method( 'getMinorUnitFactor' )->willReturn( $minorUnitFactor );

		$money = $this->createMock( RepresentsMoney::class );
		$money->method( 'getAmount' )->willReturn( $amount );
		$money->method( 'getCurrency' )->willReturn( $currency );

		return $money;
	}
}

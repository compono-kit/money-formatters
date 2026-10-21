<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Traits;

use ComponoKit\Money\Interfaces\RepresentsCurrency;
use ComponoKit\Money\Interfaces\RepresentsMoney;

trait BuildingMoney
{
	private function buildMoney( int $amount, string $isoCode = 'EUR', string $symbol = '€', int $minorUnitFactor = 100 ): RepresentsMoney
	{
		$currency = $this->createStub( RepresentsCurrency::class );
		$currency->method( 'getIsoCode' )->willReturn( $isoCode );
		$currency->method( 'getSymbol' )->willReturn( $symbol );
		$currency->method( 'getMinorUnitFactor' )->willReturn( $minorUnitFactor );

		$money = $this->createStub( RepresentsMoney::class );
		$money->method( 'getAmount' )->willReturn( $amount );
		$money->method( 'getCurrency' )->willReturn( $currency );

		return $money;
	}
}

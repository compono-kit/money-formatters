<?php declare(strict_types=1);

namespace ComponoKit\Money\Formatters\Tests\Traits;

use ComponoKit\Money\Interfaces\RepresentsCurrency;
use ComponoKit\Money\Interfaces\RepresentsMoney;

trait BuildingMoney
{
	private function buildMoney( int $amount ): RepresentsMoney
	{
		$currency = $this->createMock( RepresentsCurrency::class );
		$currency->method( 'getIsoCode' )->willReturn( 'EUR' );
		$currency->method( 'getSymbol' )->willReturn( '€' );
		$currency->method( 'getMinorUnitFactor' )->willReturn( 100 );

		$money = $this->createMock( RepresentsMoney::class );
		$money->method( 'getAmount' )->willReturn( $amount );
		$money->method( 'getCurrency' )->willReturn( $currency );

		return $money;
	}
}

<?php

namespace Shiqc\AliSDK\Facades;

use Illuminate\Support\Facades\Facade;

class AlipayMiniProgram extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'alisdk.miniProgram';
	}
}
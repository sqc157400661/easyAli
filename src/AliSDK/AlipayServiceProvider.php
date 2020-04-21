<?php
namespace Shiqc\AliSDK;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class AlipayServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
		$this->setupConfig();
	}

	/**
	 * Setup the config.
	 *
	 * @return void
	 */
	protected function setupConfig()
	{
		$source_config = realpath(__DIR__ . '/../config/config.php');
		$source_mobile = realpath(__DIR__ . '/../config/mobile.php');
        $source_miniProgram = realpath(__DIR__ . '/../config/miniProgram.php');
		$source_web = realpath(__DIR__ . '/../config/web.php');
		if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
			$this->publishes([
				$source_config => config_path('shiqc-alisdk.php'),
                $source_miniProgram => config_path('shiqc-alisdk-miniProgram.php'),
				$source_mobile => config_path('shiqc-alisdk-mobile.php'),
				$source_web => config_path('shiqc-alisdk-web.php'),
			]);
		} elseif ($this->app instanceof LumenApplication) {
			$this->app->configure('shiqc-alisdk');
			$this->app->configure('shiqc-alisdk-mobile');
			$this->app->configure('shiqc-alisdk-web');
            $this->app->configure('shiqc-alisdk-miniProgram');
		}
		
		$this->mergeConfigFrom($source_config, 'shiqc-alisdk');
		$this->mergeConfigFrom($source_mobile, 'shiqc-alisdk-mobile');
        $this->mergeConfigFrom($source_miniProgram, 'shiqc-alisdk-miniProgram');
		$this->mergeConfigFrom($source_web, 'shiqc-alisdk-web');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
		$this->app->bind('alisdk.mobile', function ($app)
		{
			$alipay = new Mobile\SdkPayment();

			$alipay->setPartner($app->config->get('shiqc-alisdk.partner_id'))
				->setSellerId($app->config->get('shiqc-alisdk.seller_id'))
				->setSignType($app->config->get('shiqc-alisdk-mobile.sign_type'))
				->setPrivateKeyPath($app->config->get('shiqc-alisdk-mobile.private_key_path'))
				->setPublicKeyPath($app->config->get('shiqc-alisdk-mobile.public_key_path'))
				->setNotifyUrl($app->config->get('shiqc-alisdk-mobile.notify_url'));

			return $alipay;
		});

		$this->app->bind('alisdk.web', function ($app)
		{
			$alipay = new Web\SdkPayment();

			$alipay->setPartner($app->config->get('shiqc-alisdk.partner_id'))
				->setSellerId($app->config->get('shiqc-alisdk.seller_id'))
				->setKey($app->config->get('shiqc-alisdk-web.key'))
				->setSignType($app->config->get('shiqc-alisdk-web.sign_type'))
				->setNotifyUrl($app->config->get('shiqc-alisdk-web.notify_url'))
				->setReturnUrl($app->config->get('shiqc-alisdk-web.return_url'))
				->setExterInvokeIp($app->request->getClientIp());

			return $alipay;
		});

		$this->app->bind('alisdk.wap', function ($app)
		{
			$alipay = new Wap\SdkPayment();

			$alipay->setPartner($app->config->get('shiqc-alisdk.partner_id'))
			->setSellerId($app->config->get('shiqc-alisdk.seller_id'))
			->setKey($app->config->get('shiqc-alisdk-web.key'))
			->setSignType($app->config->get('shiqc-alisdk-web.sign_type'))
			->setNotifyUrl($app->config->get('shiqc-alisdk-web.notify_url'))
			->setReturnUrl($app->config->get('shiqc-alisdk-web.return_url'))
			->setExterInvokeIp($app->request->getClientIp());

			return $alipay;
		});
        $this->app->bind('alisdk.miniProgram', function ($app)
        {
            $alipay = new MiniProgram\Pay\SdkPayment();

            $alipay->setPartner($app->config->get('shiqc-alisdk-miniProgram.partner_id'))
                ->setAppId($app->config->get('shiqc-alisdk-miniProgram.app_id'))
                ->setSellerId($app->config->get('shiqc-alisdk-miniProgram.seller_id'))
                ->setKey($app->config->get('shiqc-alisdk-miniProgram.key'))
                ->setPrivateKey($app->config->get('shiqc-alisdk-miniProgram.private_key'))
                ->setPublicKey($app->config->get('shiqc-alisdk-miniProgram.public_key'))
                ->setNotifyUrl($app->config->get('shiqc-alisdk-miniProgram.notify_url'))
                ->setReturnUrl($app->config->get('shiqc-alisdk-miniProgram.return_url'))
                ->setExterInvokeIp($app->request->getClientIp());

            return $alipay;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'alisdk.mobile',
			'alisdk.web',
			'alisdk.wap',
            'alisdk.miniProgram',
		];
	}
}

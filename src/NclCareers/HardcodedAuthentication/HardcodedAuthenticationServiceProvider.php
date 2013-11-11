<?php namespace NclCareers\HardcodedAuthentication;

use Illuminate\Support\ServiceProvider,
    Auth;

class HardcodedAuthenticationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {}

	public function boot()
	{
		Auth::extend('hardcoded', function($app) {
			$provider =  new HardcodedUserProvider();

			return new \Illuminate\Auth\Guard($provider, $app['session.store']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
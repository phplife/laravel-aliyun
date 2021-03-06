<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 2018/5/8
 * Time: 19:58
 */
namespace Aliyun\Provider;

use Aliyun\Services\Sms;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class AliyunServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->registerConfig();
        $this->registerClassAliases();
        $this->registerSms();
    }

    /**
     * Register the configuration.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../Config/aliyun.php'), 'aliyun');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                dirname(__DIR__).'/config/aliyun.php' => config_path('aliyun.php'), ],
                'aliyun'
            );
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('aliyun');
        }
    }

    /**
     * Register the class aliases.
     *
     * @return void
     */
    protected function registerClassAliases()
    {
        $aliases = [
            'aliyun.sms' => \Aliyun\Services\Sms::class
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }

    /**
     * Register the Sms.
     *
     * @return void
     */
    public function registerSms()
    {
        $this->app->singleton('aliyun.sms', function ($app) {
            return new Sms($this->config('sms'));
        });
    }

    /**
     * return config data
     *
     * @param $item
     * @return mixed
     */
    protected function config($item)
    {
        return $this->app['config']->get('aliyun.'.$item);
    }

}
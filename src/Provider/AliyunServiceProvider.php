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
        $this->app->configure('aliyun');
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
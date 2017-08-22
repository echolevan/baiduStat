<?php
namespace Levan\Baidu\Stat;
use Illuminate\Support\ServiceProvider;

class BaiduStatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/BaiduStat.php' => config_path('BaiduStat.php'),
        ], 'levan-baidu-stat');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BaiduStat', function () {
            return $this->app->make('Levan\Baidu\Stat\BaiduStat');
        });
    }
}
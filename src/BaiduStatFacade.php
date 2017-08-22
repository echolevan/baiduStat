<?php namespace Levan\Baidu\Stat;
use Illuminate\Support\Facades\Facade;

class BaiduStatFacade extends Facade
{
    /**
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BaiduStat';
    }
}
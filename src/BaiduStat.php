<?php
/**
 * Created by PhpStorm.
 * User: Levan
 * Date: 2017/8/22
 * Time: 15:12
 */

namespace Levan\Baidu\Stat;
use Illuminate\Support\Facades\Config;

class BaiduStat
{
    protected $login_url = '';
    protected $api_url = '';
    protected $username = '';
    protected $password = '';
    protected $token = '';
    protected $uuid = '';
    protected $ucid = '';
    protected $st = '';
    protected $account_type = 1;


    public function __construct()
    {
        $this->login_url = config('BaiduStat.LOGIN_URL');
        $this->api_url = config('BaiduStat.API_URL');
        $this->username = config('BaiduStat.USERNAME');
        $this->password = config('BaiduStat.PASSWORD');
        $this->token = config('BaiduStat.TOKEN');
        $this->uuid = config('BaiduStat.UUID');
        $this->login();
    }

    public function login()
    {
        $loginService = new LoginService($this->login_url, $this->uuid);

        if (!$loginService->preLogin($this->username, $this->token)) {
            return ['sta'=>0 ,'msg'=>'参数错误'];
        }
        $ret = $loginService->doLogin($this->username, $this->password, $this->token);
        if ($ret) {
            $this->ucid = $ret['ucid'];
            $this->st = $ret['st'];
        }
        else {
            return ['sta'=>0 ,'msg'=>'参数错误'];
        }
    }

    /**
     * @param $start Ymd
     * @param $end  Ymd
     * @param string $method
     * @param string $metrics
     * @param int $max_results
     * @param string $gran
     * @return array
     */
    public function getData($start, $end, $method = 'trend/time/a', $metrics='pv_count,visitor_count' , $max_results = 0 , $gran = 'day')
    {
        $reportService = new ReportService($this->api_url, $this->username, $this->token, $this->ucid, $this->st);
        $ret = $reportService->getSiteList();
        $siteList = $ret['body']['data'][0]['list'];
        if (count($siteList) > 0) {
            $siteId = $siteList[0]['site_id'];
            $ret = $reportService->getData(array(
                'site_id' => $siteId,                   //站点ID
                'method' => $method,             //趋势分析报告
                'start_date' => $start,             //所查询数据的起始日期
                'end_date' => $end,               //所查询数据的结束日期
                'metrics' => $metrics,  //所查询指标为PV和UV
                'max_results' => $max_results,                     //返回所有条数
                'gran' => $gran,                        //按天粒度
            ));
            return ['sta'=>1,'info'=>json_decode($ret['raw'],true)];
        }
    }

    public function logout()
    {
        $loginService = new LoginService($this->login_url, $this->uuid);
        return $loginService->doLogout($this->username, $this->token, $this->ucid, $this->st);
    }
}
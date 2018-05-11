<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 2018/5/8
 * Time: 20:36
 */
namespace Aliyun\Services;

use Aliyun\Core\Config;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;

class Sms
{
    /**
     * 产品名称:云通信流量服务API产品,开发者无需替换
     * @var string
     */
    protected $product = 'Dysmsapi';

    /**
     * 产品域名,开发者无需替换
     * @var string
     */
    protected $domain = 'dysmsapi.aliyuncs.com';

    /**
     * access Key Id
     * @var string
     */
    protected $accessKeyId;

    /**
     * $access Key Secret
     * @var mixed
     */
    protected $accessKeySecret;

    /**
     * 地区代码
     * @var mixed
     */
    protected $region;

    /**
     * 服务结点
     * @var mixed
     */
    protected $endPointName;

    /**
     * @var DefaultAcsClient
     */
    protected $acsClient;

    public function __construct(array $config = [])
    {
        Config::load();
        $this->accessKeyId     = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        $this->region          = $config['region'];
        $this->endPointName    = $config['endPointName'];

        //初始化acsClient,暂不支持region化
        $profile = DefaultProfile::getProfile($this->region, $this->accessKeyId, $this->accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint($this->endPointName, $this->region, $this->product, $this->domain);

        // 初始化AcsClient用于发起请求
        $this->acsClient = new DefaultAcsClient($profile);
    }


    /**
     * 发送短信
     * @param string $mobile 必填，设置短信接收号码
     * @param string $sign  必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
     * @param string $temp_code 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
     * @param array $params 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
     * @param null|string $out_id 可选，设置流水号
     * @param null|string $extend_code 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
     * @return mixed|\SimpleXMLElement
     */
    public function sendSms($mobile, $sign, $temp_code, array $params = [], $out_id = null, $extend_code = null)
    {
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        $request->setPhoneNumbers($mobile);
        $request->setSignName($sign);
        $request->setTemplateCode($temp_code);

        if($params)
        {
            $request->setTemplateParam(json_encode($params, JSON_UNESCAPED_UNICODE));
        }

        if($out_id)
        {
            $request->setOutId($out_id);
        }

        if($extend_code)
        {
            $request->setSmsUpExtendCode($extend_code);
        }

        //发起请求
        return $this->acsClient->getAcsResponse($request);
    }

}
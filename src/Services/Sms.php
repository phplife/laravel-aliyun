<?php
    /**
     * Created by PhpStorm.
     * User: Lucas
     * Date: 2018/5/8
     * Time: 20:36
     */
namespace Aliyun\Services;

class Sms
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }


    public function send()
    {
        var_dump($this->config);
    }

}
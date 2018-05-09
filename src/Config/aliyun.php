<?php
    /**
     * Created by PhpStorm.
     * User: Lucas
     * Date: 2018/5/8
     * Time: 20:32
     */
return [
    'sms' => [
        'accessKeyId' => env('ALIYUN_ACCESS_KEY_ID', ''),
        'accessKeySecret' => env('ALIYUN_ACCESS_KEY_SECRET', ''),
        'region'          => env('ALIYUN_REGION', ''),
        'endPointName'    => env('END_POINT_NAME', '')
    ],
];
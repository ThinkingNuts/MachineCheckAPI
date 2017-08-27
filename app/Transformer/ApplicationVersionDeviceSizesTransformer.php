<?php

namespace App\Transformer;

/**
 * ApplicationVersionDeviceSizesTransformer
 * @author 王荣 <wangrong@inesadt.com>
 * @version 2017.4.25
 */
class ApplicationVersionDeviceSizesTransformer extends Transformer
{

    public function transform($data)
    {
        $platform_type = config('platform_type');
        
        //转化应用名称,系统平台,版本号格式
        $data['data'] = array_map(function($v) use ($platform_type){

            $v['application_name'] = $v['versions']['application']['name'];
            $v['platform_type'] = $platform_type[$v['versions']['platform_type_id']];
            $v['version'] = $v['versions']['version'];
            
            unset($v['versions']);
            
            return $v;
        }, $data['data']);
        
        return $data;
    }
    
    public function transformForShow($data)
    {

        //转化应用名称,系统平台,版本号格式
        $data['application_id'] = (string)$data['versions']['application']['id'];
        $data['platform_type_id'] = (string)$data['versions']['platform_type_id'];
        $data['application_version_id'] = (string)$data['application_version_id'];
        
        unset($data['versions']);
        
        return $data;
    }
    
}
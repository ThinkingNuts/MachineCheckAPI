<?php

namespace App\Transformer;

/**
 * TemplatePositionContentAreaTransformer
 * @author 王荣 <wangrong@inesadt.com>
 * @version 2017.6.26
 */
class TemplatePositionContentAreaTransformer extends Transformer
{

    public function transform($data)
    {
        $data = array_map(function($v){
            return [
                'id' => $v['id'],
                'name' => $v['positions']['name'].'-'.$v['name']
            ];
        }, $data);
        return $data;
    }
    
}
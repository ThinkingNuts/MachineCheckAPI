<?php

namespace App\Transformer;
use App\Models\Activity;
use App\Repositories\FileRepository;

/**
 * TemplatesTransformer
 * @author 王荣 <wangrong@inesadt.com>
 * @version 2017.4.21
 */
class TemplatesTransformer extends Transformer
{

    public function transform($data)
    {

        $status = config('template_status');
        
        //增加状态text
        $data['data'] = array_map(function($v) use ($status){
            $v['status_text'] = $status[$v['status']];
            return $v;
        }, $data['data']);
        
        return $data;
    }
    
    public function forShow($data)
    {
        $file_repository = new FileRepository;
        
        array_walk($data['components'], function(&$v){
            $v['package_id'] = $v['activities']['package_id'];
            $v['src'] = asset('storage/'.$v['files']['path']);
            
            $v['activity'] = Activity::where('package_id', $v['package_id'])->get();

            unset($v['activities']);
            unset($v['files']);
        });
        
        array_walk($data['navbars'], function(&$v) use($file_repository){
            
            $v['normal_image_src'] = $file_repository->getFileById($v['normal_file_id'], true);
            $v['pressed_image_src'] = $file_repository->getFileById($v['pressed_file_id'], true);
            $v['focused_image_src'] = $file_repository->getFileById($v['focused_file_id'], true);
            $v['selected_image_src'] = $file_repository->getFileById($v['selected_file_id'], true);
     
        });

//        $data['components'] = array_map(function($v){
//            $v['package_id'] = $v['activities']['package_id'];
//            
//            unset($v['activities']);
//            return $v;
//        }, $data['components']);
        
        return $data;
    }
    
}
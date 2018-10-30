<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    /**
     * ajax上传文件
     */
    public function uploadImages(Request $request,ImageUploadHandler $uploadHandler)
    {

        if ($request->ajax()) {

            $file = $request->file('image');
            // 第一个参数代表目录, 第二个参数代表我上方自己定义的一个存储媒介
            $result = $uploadHandler->save($file, 'project', 'project_');
            return response()->json(array('msg' => $result['path']));
        }
        // 注意看下方模版代码
        return view('test.test');
    }
}

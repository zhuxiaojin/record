<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;


class FileController extends Controller
{
    //
    public function upload(Request $request, ImageUploadHandler $uploadHandler) {
        if ($request->ajax()) {
            $file = $request->file('image');
            // 第一个参数代表目录, 第二个参数代表我上方自己定义的一个存储媒介
            $result = $uploadHandler->save($file, 'project', 'project_');
            return response()->json(array('msg' => $result['path']));
        }
    }

}

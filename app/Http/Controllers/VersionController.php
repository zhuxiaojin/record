<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersionRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //展示我加入的version
        $type = $request->get('type', 'all');
        switch ($type) {
            # 全部
            case 'all':
                $list = Version::with(['user', 'project'])->whereHas('records', function ($query) {
                    $query->where('user_id', \Auth::user()->id);
                })->latest()->notclose()->paginate(10);
                break;
            # 正在进行中
            case 'current':
                $list = Version::with(['user', 'project'])->whereHas('records', function ($query) {
                    $query->where('user_id', \Auth::user()->id);
                })->latest()->active()->paginate(10);
                break;
            # 已结束
            case 'end':
                $list = Version::with(['user', 'project'])->whereHas('records', function ($query) {
                    $query->where('user_id', \Auth::user()->id);
                })->latest()->end()->paginate(10);
                break;
            default:

        }
        return view('versions.index', compact('list', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->authorize('create', Version::class);
        return view('versions.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VersionRequest $request) {
        //
        $this->authorize('create', Version::class);
        Version::create($request->all());
        session()->flash('success', '版本创建成功');
        return redirect(route('project.show', ['id' => $request->project_id,'param'=>'versions']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $version = Version::with(['records'])->findOrFail($id);
        $users = User::with(['duty', 'records' => function ($query) use ($id) {
            $query->where('version_id', $id);
        }])->whereHas('records', function ($query) use ($id) {
            $query->where('version_id', $id);
        })->latest()->get();
        return view('versions.show', compact('version', 'users'));
    }

    /**
     * @name:edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id) {
        //
        $version = Version::findOrFail($id);
        $this->authorize('update', $version);
        return view('versions.edit', compact('version'));
    }

    /**
     * @name:update
     * @param VersionRequest $request
     * @param Version $version
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(VersionRequest $request, Version $version) {
        //
        $this->authorize('update', $version);
        $data = $request->all();
        $version->update($data);
        session()->flash('success', '修改成功');
        return redirect(route('version.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version) {
        //
        $this->authorize('delete', $version);
        $version->update(['is_end' => 1]);
        session()->flash('success', '删除成功');
        return redirect(route('version.index'));
    }
}

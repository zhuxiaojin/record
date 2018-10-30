<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ProjectRequest;
use App\Models\Duty;
use App\Models\Project;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $type = $request->type ?: 'all';
        if ($type == 'all') {
            $list = Project::orderBy('id', 'desc')->paginate(10);
        }
        if ($type == 'mine') {
//            $list = Project::->orderBy('id', 'desc')->paginate(10);
            $list = \Auth::user()->projects()->paginate(10);
        }

        return view('projects.index', compact('list', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->authorize('create', Project::class);
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, ImageUploadHandler $uploader) {
        $this->authorize('create', Project::class);
        $data = $request->all();
        if ($request->img) {
            $result = $uploader->save($request->img, 'project', 'project_');
            if ($result) {
                $data['img'] = $result['path'];
            }
        }
        Project::create($data);
        return redirect()->route('project.index')->with('success', '创建成功！');
    }

    /**
     * @name:getVersions
     * @param Request $request
     * @return mixed
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function getVersions(Request $request) {
        $id = $request->id;
        $project = Project::findOrFail($id);
        return $project->versions()->get()->toArray();
    }

    /**
     * Display the specified resource.
     *∏
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        //
        $project = Project::with(['versions' => function ($query) {
            $query->with(['user'])->orderBy('id', 'desc');
        }])->find($id);
        $check = $request->get('param') ?: 'introduce';
        $users = Record::with(['user', 'project'])->where('project_id', $id)->get();
        $duty_result = getDutyMapByProjectId($id);
        $step_result = getStepMapById($id, 'project');
        return view('projects.show', compact('project', 'users', 'duty_result', 'step_result','check'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project) {
        $this->authorize('update', $project);
//        dd($project->toArray());
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project, ImageUploadHandler $uploader) {
        //
        $this->authorize('update', $project);
        $data = $request->all();
        if ($request->img) {
            $result = $uploader->save($request->img, 'project', 'project_');
            if ($result) {
                $data['img'] = $result['path'];
            }
        }
        $project->update($data);
        return redirect()->route('project.index')->with('success', '修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project) {
        //
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('project.index')->with('success', '删除成功！');
    }
}

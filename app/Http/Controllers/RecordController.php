<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Models\Project;
use App\Models\Record;
use App\Models\Step;
use App\Models\User;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //
        $type = $request->type ?: 'all';
        switch ($type) {
            case 'month':
                $list = Auth::user()->records()->orderBy('current_time', 'desc')->whereBetween('current_time', [Carbon::now()->startOfMonth()->startOfDay()->toDateTimeString(), Carbon::now()->endOfMonth()->endOfDay()->toDateTimeString()])->paginate(10);
                break;
            case  'all':
                $list = Auth::user()->records()->orderBy('current_time', 'desc')->paginate(10);
                break;
        }
        return view('records.index', compact('list', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        //
        $data = $request->data;
        $steps = Step::all();
        //计算时间
        $current_time = isset($data['current_time']) ? $data['current_time'] : date('Y-m-d');
        //计算项目
        if (isset($data['project_id'])) {
            $project = Project::findOrFail($data['project_id']);
        }
        $holiday = getHoliday($current_time);
        return view('records.create', compact('steps', 'current_time', 'project', 'holiday'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordRequest $request) {
        //
        $data = $request->all();
        \Auth::user()->records()->create($data);
        session()->flash('success', '记录创建成功，再来一条~');
        return redirect(route('record.create'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //

        $record = Record::with(['project', 'version', 'step'])->findOrFail($id);
        $this->authorize('update', $record);
        return view('records.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecordRequest $request, Record $record) {
        //
        $this->authorize('update', $record);
        $data = $request->all();
        $record->update($data);
        session()->flash('success', '记录更新成功！');
        return redirect(route('record.index', ['id' => $record->id]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record) {
        //
        $this->authorize('update', $record);
        $record->delete();
        return redirect(route('record.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $users = User::with(['duty'])->orderBy('duty_id', 'asc')->activeStatus()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.\
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $this->authorize('create', User::class);
        $is_show = 1;
        return view('users.create', compact('is_show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        //
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['duty_id'] = $request->duty_id;
        $data['password'] = bcrypt($request->password);
        $data['remember_token'] = str_random(10);
        $res = User::create($data);
        return redirect(route('user.index'))->with('success', '用户创建成功');
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
     * @name:setManager 设置身份
     * @param User $user
     * @param $type
     * @return $this|\Illuminate\Http\RedirectResponse
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function setManager(User $user, $type) {
        if (empty($type)) {
            return view('user.index')->with(['danger', '设置失败']);
        }
        $this->authorize('create', $user);
        $user->update(['type' => $type]);
        return redirect(route('user.index'))->with('info', '设置成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //
        $is_show = 1;
        return view('users.edit', compact('user', 'is_show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user) {
        //
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['duty_id'] = $request->duty_id;
        if (!empty($request->password)) {
            $data['password'] =  $data['password'] = bcrypt($request->password); ;
        }
        $user->update($data);
        Auth::logout();
        return redirect(route('login'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        //
        $this->authorize('delete', Auth::user());
        $user->update(['status' => 0]);
        return redirect(route('user.index'))->with('info', '删除成功');
    }
}

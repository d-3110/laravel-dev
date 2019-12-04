<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 利用するときはEloquentモデルやクエリビルダーから、scope接頭語を外して呼び出す
        $users = User::deptFilter(request('dept_id'))  // 部署で絞り込み
                     ->jobFilter(request('job_id'))    // 職種で絞り込み
                     ->searchFilter(request('keyword'))   // 検索ワードで絞り込み
                     ->paginate(10);
        return view('admin.users.index', ['users' => $users, 'keyword' => request('keyword')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        list($depts, $jobs) = User::getArraySelectBox();
        return view('admin.users.create', ['depts' => $depts, 'jobs' => $jobs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::findOrFail($id)
        // return view('user.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        list($depts, $jobs) = User::getArraySelectBox();
        return view('admin.users.edit', ['user' => $user, 'depts' => $depts, 'jobs' => $jobs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->dept_id = $request->dept_id;
        $user->job_id = $request->job_id;
        $user->is_admin = $request->is_admin;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!empty($user->profile)) {
            // prifile登録済みの場合
            $user->profile->delete();
        }
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dept;

class DeptController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $depts = Dept::paginate(10);
        return view('admin.depts.index', ['depts' => $depts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.depts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dept = new Dept;
        $dept->fill($request->all());
        $dept->save();
        return redirect()->route('admin.depts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dept = Dept::find($id);
        return view('admin.depts.edit', ['dept' => $dept]);
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
        $dept = Dept::find($id);
        $dept->fill($request->all())->save();
        return redirect()->route('admin.depts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = dept::find($id);

        if (!empty($dept->profile)) {
            // prifile登録済みの場合
            $dept->profile->delete();
        }
        $dept->delete();
        return redirect()->route('admin.depts.index');
    }
}

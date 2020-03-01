<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use Storage;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();
        return $profiles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile;
        $profile->title = $request->title;
        $profile->body = $request->body;
        $profile->save();
        return redirect('api/profiles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return $profile;
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
        $validatedData = $request->validate([
            'name'          => 'required|string',
            'birthday'      => 'required|date',
            'gender'        => 'required|boolean',
            'favorite_food' => 'required|string',
            'hated_food'    => 'required|string',
            'personality_1' => 'required|integer|between:1,5',
            'personality_2' => 'required|integer|between:1,5',
            'personality_3' => 'required|integer|between:1,5',
            'personality_4' => 'required|integer|between:1,5',
            'personality_5' => 'required|integer|between:1,5',
            'personality_6' => 'required|integer|between:1,5',
        ]);
        $profile = Profile::find($id);
        // 全カラムを対象
        $profile->fill($request->all());
        $profile->save();
    }

    /**
     * Upload the profile img
     *
     */
    public function fileUpload(Request $request, $id)
    {
        $profile = Profile::find($id);
        $user_id = $profile->user_id;
        $directory = "/profiles/$user_id";
        
        /* dropboxを使用する場合 */
        // 現在の画像をディレクトリごと削除
        Storage::disk('dropbox')->deleteDirectory($directory);
        $file = request()->file('file');
        $file_name = $file->getClientOriginalName();
        $path = Storage::disk('dropbox')->putFileAs($directory, $file, $file_name);
        

        $link = Profile::createSharedLink('/'.$path);

        /* Laravelのファイルシステムを使用する場合
         *

        // 現在の画像をディレクトリごと削除
        Storage::deleteDirectory($directory);
        // ストレージに画像を格納
        $file_name = request()->file->getClientOriginalName();
        request()->file->storeAs($directory, $file_name);

        *
        */

        // テーブルにファイル名保存
        $profile->update(['img_file' => $link]);

        $res = ['link' => $link];
        return json_encode($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->delete();
        return redirect('api/profiles');
    }
}

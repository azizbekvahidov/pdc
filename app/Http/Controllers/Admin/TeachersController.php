<?php

namespace App\Http\Controllers\Admin;

use App\{TeachersInfo,User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = User::where("role_id","2")->get();
        return view('admin.teachers.index',[
            'teachers' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::find($id);

        return view("admin.teachers.edit",[
            "model" => $model
        ]);

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
        if($request->file("photo")){
            Storage::delete('public/images/'.$request->oldPhotoName);
            $photo = $request->file("photo");
            $name = time().$photo->getClientOriginalName();
            $photo->storeAs("public/images", $name);
        }
    else{
            $name = $request->oldPhotoName;
        }

        $user = User::find($id);
        $user->name     = $request->name;
        $user->surname  = $request->surname;
        $user->save();


        TeachersInfo::updateOrCreate(
            ["user_id"   => $id],
            ["info"      => $request->info, "photo" => $name]);
        return redirect()->route("admin.teachers.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {

    }
}



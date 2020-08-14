<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Rules\urlCheck;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\{Subjects,Themes};

class ThemesController extends Controller
{
    public function index(Request $request) {

        $subjects = Subjects::get();

        if($request->all() == null) {
            return view('admin.themes.index1', ['subjects' => $subjects]);
        }

        $themes = Themes::where('subject_id', $request->subject)->get();

        return view('admin.themes.index1', [
            'subjects'  => $subjects,
            'themes'    => $themes]);
    }

    public function choose(Request $request) {

        $themes = \DB::table('themes')->where('subject_id', $request->subject)->pluck('name', 'id');
        session(['subject' => $request->subject]);
        return response()->json(['themes' => $themes]);

    }

    public function create() {

        $subjects = Subjects::all();

        return view('admin.themes.create', ['subjects' => $subjects]);
    }

    public function store(Request $request) {

        $file_names = null;
        $url = null;
        $request->validate([
            'name'          => 'required',
            'url'           => ['required', new urlCheck, 'max:800'],
            'subject'       => 'required',
            'description'   => 'required|max:100',
            'files'         => 'required',
        ]);
        $parsed_url = (parse_url($request->url));
        if(strripos($parsed_url["host"], 'youtube') !== false){
            $url = str_replace("watch?v=", "embed/", $request->url);
        }
        elseif (strripos($parsed_url["host"], 'mover') !== false){
            $url = str_replace('watch','video/embed', $request->url);
        }
        $files = $request->file('files');
        $i = 0;
        foreach ($files as $file) {
            $temp_name = substr($file->getClientOriginalName(), 0,-(strlen($files[0]->extension())+1));
            $temp_ext = $file->getClientOriginalExtension();
            $file_name = $temp_name."_".date("Ymd_Hms", time()).".".$temp_ext;
            $file_name = str_replace(' ', '_', $file_name);
            if($i == 0){
                $file_names .= $file_name;
            }
            else{
                $file_names .= "|".$file_name;
            }
            $i++;
            $file->storeAs('public/files', $file_name);
        }

        Themes::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'subject_id'    => $request->subject,
            'url'           => $url,
            'files'         => $file_names,
            'status'        => "1",
        ]);

        return redirect()->route('admin.themes.index')->with(['message' => 'Удачно создано!']);
    }

    public function view($id) {
        $theme = Themes::find($id);
        return view("admin.themes.view", ['theme' => $theme]);
    }

    public function edit($id) {
        $theme = Themes::find($id);
        $parsed_url = (parse_url($theme->url));
        if(strripos($parsed_url["host"], 'youtube') !== false){
            $theme->url = str_replace("embed/", "watch?v=", $theme->url);
        }
        elseif (strripos($parsed_url["host"], 'mover') !== false){

            $theme->url = str_replace('video/embed','watch', $theme->url);
        }
        return view('admin.themes.edit', ['theme' => $theme]);
    }

    public function update(Request $request, $id) {
        $file_names = null;
        $url = null;
        $request->validate([
            'name'          => 'required',
            'description'   => 'required|max:100',
            'url'           => ['required', new urlCheck],
        ]);
        $parsed_url = (parse_url($request->url));
        if(strripos($parsed_url["host"], 'youtube') !== false){
            $url = str_replace("watch?v=", "embed/", $request->url);
        }
        elseif (strripos($parsed_url["host"], 'mover') !== false){

            $url = str_replace('watch','video/embed', $request->url);
        }

        $files = $request->file('files');
        if($files){
            $i = 0;
            foreach ($files as $file) {
                $temp_name = substr($file->getClientOriginalName(), 0,-(strlen($files[0]->extension())+1));
                $temp_ext = $file->getClientOriginalExtension();
                $file_name = $temp_name."_".date("Ymd_Hms", time()).".".$temp_ext;
                $file_name = str_replace(' ', '_', $file_name);
                if($i == 0){
                    $file_names .= $file_name;
                }
                else{
                    $file_names .= "|".$file_name;
                }
                $i++;
                $file->storeAs('public/files', $file_name);
            }
            $old_files = explode("|",$request->old_files);
            foreach ($old_files as $old_file) {
                Storage::delete("public/files/".$old_file);
            }
        }

        $theme                      = Themes::find($id);
        $theme->name                = $request->name;
        $theme->description         = $request->description;
        $theme->url                 = $url;
        $theme->status              = "1";
        if($files)   $theme->files  = $file_names;
        else         $theme->files  = $request->old_files;
        $theme->save();

        return redirect()->route('admin.themes.index')->with(['message' => 'Удачно изменено!']);

    }

    public function destroy($id) {

        $theme = Themes::find($id);
        $theme->status = "0";
        $theme->save();

        return redirect()->route('admin.themes.index')->with(['message' => 'Удачно удалено!']);
    }

    public function delete($id) {

        $theme = Themes::find($id);
        $files = explode("|",$theme->files);
        foreach ($files as $file) {
            Storage::delete("public/files/".$file);
        }
        $theme->delete();

        return redirect()->route('admin.themes.index')->with(['message' => 'Полностью удалено!']);
    }

}

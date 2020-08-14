<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = News::where("status", 0)->get();
        return view( "admin.news.index",[
            "news" => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title'     => 'required|min:20|max:100',
            'article'   => 'required',
            'summary'   => 'required|max:100',
            'photo'     => 'required',

        ]);
        
        $slug = Str::slug($request->title)."-".date('H-i-s-j-m-Y', time());
        if($request->file('photo')){

            $photo = $request->file('photo');
            $path = '/public/images';
            $exp = $photo->getClientOriginalExtension();
            $name = Str::slug($request->title)."-".time().".".$exp;
            $photo->storeAs($path, $name);
        }
    
        $news = new News();
        $news->title    = $request->title;
        $news->article  = $request->article;
        $news->summary  = $request->summary;
        $news->slug     = $slug;
        $news->status   = "0";
        if($request->file('photo')){
            $news->photo    = 'storage/images/'.$name;
        }
        $news->save();


        return redirect()->route('admin.news.index')->with(['message' => "Новость создана"]);
    }
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
        $model = News::find($id);
        $article = News::find('article');
        $summary = News::find('summary');
        return view("admin.news.edit",[
            'model' => $model,
            'summary' => $summary,
            'article'  => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     News::destroy($id);
        return redirect()->route('admin.news.index')->with('message', 'Article deleted!');
    }
}

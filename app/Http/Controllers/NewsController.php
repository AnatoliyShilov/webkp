<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Type;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.index', 
            [
                'types' => Type::all(),
                'news' => News::orderBy('created_at', 'desc')->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create', 
            [
                'types' => Type::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'text' => 'required'
            ]
        );
        $newNews = new News();
        $newNews->title = $request->input('title');
        $newNews->text = $request->input('text');
        $newNews->save();
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('news.edit', 
            [
                'news' => $news, 
                'types' => Type::all()
            ]
        );
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
        $this->validate($request,
            [
                'title' => 'required',
                'text' => 'required'
            ]
        );
        $news = News::find($id);
        $news->title = $request->input('title');
        if ($request->input('text') != null &&
            $request->input('text') != $news->text)
            $news->text = $request->input('text');
        $news->save();
        return redirect('/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect('/news');
    }
}

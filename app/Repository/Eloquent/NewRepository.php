<?php

namespace App\Repository\Eloquent;

use App\Models\News;
use App\Repository\NewRepositoryInterface;

class NewRepository implements NewRepositoryInterface
{
    public function index()
    {
        $news   = News::select('id','title', 'created_at','description','image')->get();

        foreach ($news as $key => $value) {
            $news[$key]->description = strip_tags($value->description);
        }


        return view('dashboard.site.news.index', compact('news'));
    }

    public function create()
    {
        return view('dashboard.site.news.create');
    }

    public function store($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/news');
        }
        News::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('news.index');
    }

    public function edit($id)
    {
        $news = News::find($id);
        return view('dashboard.site.news.edit', compact('news'));

    }

}

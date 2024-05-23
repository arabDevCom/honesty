<?php

namespace App\Http\Controllers\Dashboard\news;

use App\Http\Controllers\Controller;
use App\Repository\NewRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    protected $news;

    public function __construct( NewRepositoryInterface $news )
    {
        $this->news = $news;
    }

    public function index()
    {
        return $this->news->index();
    }

    public function create()
    {
        return $this->news->create();

    }

    public function store(Request $request)
    {
        return $this->news->store($request);

    }

    public function edit($id)
    {
        return $this->news->edit($id);

    }

}

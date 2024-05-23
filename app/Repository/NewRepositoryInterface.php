<?php

namespace App\Repository;

interface NewRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);

    public function edit($id);

}

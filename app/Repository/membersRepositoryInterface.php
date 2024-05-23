<?php

namespace App\Repository;




interface membersRepositoryInterface
{

    public function store(Request $request);

    public function getHome();

    public function getAllNews(Request $request);

    public function getAllCountry();

    public function getAllGovernorates();

    public function getSettings();
}
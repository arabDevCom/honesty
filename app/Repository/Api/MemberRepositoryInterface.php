<?php

namespace App\Repository\Api;

interface MemberRepositoryInterface
{

    public function store($request);

    public function getHome();

    public function getAllNews($request);
    public function getAllCountry();
    public function getAllGovernorates();
    public function getSettings();

}

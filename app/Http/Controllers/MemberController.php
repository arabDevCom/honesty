<?php

namespace App\Http\Controllers;

use App\Repository\Api\MemberRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memebers;

    public function __construct(MemberRepositoryInterface $memebers)
    {
        $this->memebers = $memebers;
    }


    public function store(Request $request)
    {
      return $this->memebers->store($request);
    }


    public function getHome( )
    {
      return $this->memebers->getHome();
    }


    public function getAllNews( Request $request)
    {
      return $this->memebers->getAllNews($request);
    }


    public function getAllCountry()
    {
      return $this->memebers->getAllCountry();
    }

    public function getAllGovernorates()
    {
      return $this->memebers->getAllGovernorates();
    }

    public function getSettings()
    {
      return $this->memebers->getSettings();
    }

    public function StoreToken(Request $request)
    {
      return $this->memebers->StoreToken($request);
    }



}

<?php

namespace App\Http\Controllers\Dashboard\Manager;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Setting\SettingService;
use App\Models\Setting;
use Illuminate\Http\Request;
class SettingController extends Controller
{



//    public function __construct(private readonly SettingService $setting)
//    {
//
//
//    }



    public function index()
    {


        $settings = Setting::first();

        $settingData  = $settings->only(['id','logo','sponsor']);
        return view('dashboard.site.settings.create', compact('settingData'));
    }


    public function store(Request $request)
    {

        return $this->setting->update($request);
    }

    public function update(Request $request)
    {


        return  $this->setting->update($request);
    }



}

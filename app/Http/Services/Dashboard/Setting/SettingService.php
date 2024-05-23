<?php

namespace App\Http\Services\Dashboard\Setting;

use App\Models\Setting;
use App\Models\User;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\settingRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SettingService
{
        public function __construct(private readonly Us $settingRepository)

    {


    }

    public function index()
    {


        $settings = Setting::first();

        $settingData  = $settings->only(['id','logo','sponsor']);
        return view('dashboard.site.settings.create', compact('settingData'));
    }



    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $logo = $request->file('logo');

            if ($logo) {
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move('logos', $logoName);
                $data['logo'] = $logoName;
            }

            $setting=Setting::find($request->id);
            $setting->sponsor = $data['sponsor'];
            $setting->logo = $data['logo'];
            $setting->save();






            DB::commit();
            return redirect()->route('settings.index', $setting->id)->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update($request)
    {
        // Validate the request to ensure 'logo' is a file
        $request->validate([
            'id' => 'required|exists:settings,id',
            'sponsor' => 'required|string', // Add other necessary validation rules
        ]);

        $id = $request->id;
        $setting = Setting::findOrFail($id);
        $setting->sponsor = $request->sponsor;

        $setting->save();

        return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
    }


}

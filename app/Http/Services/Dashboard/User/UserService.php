<?php

namespace App\Http\Services\Dashboard\User;

use App\Models\Country;
use App\Models\Governorate;
use App\Models\Member;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function index()
    {
        $users = $this->userRepository->paginate(25);
        return view('dashboard.site.users.index', compact('users'));
    }

    public function create()
    {
        $countries = Country::select('name', 'id')->get();
        $governorates = Governorate::select('name', 'id')->get();
        return view('dashboard.site.users.create', compact('countries', 'governorates'));
    }

    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:1,0',
                'postion' => 'required|in:1,0',
                'image_front' => 'required|image',
                'image_back' => 'required|image',
                'image' => 'required|image',
                'cv' => 'nullable|file|mimes:pdf',
                'name' => 'required|string',
                'national_ID' => 'required|digits:14|numeric|unique:members,national_ID',
                'card_Date' => 'required',
                'governorate_id' => 'required',
                'address' => 'required|string',
                'work_place' => 'required|string',
                'partisan' => 'required|string',
                'job' => 'required|string',
                'qualification' => 'required|string',
                'phone' => 'required|digits:11|numeric|unique:members,phone',
                'country_id' => 'required_if:postion,out',
                'Place_abroad' => 'required_if:postion,out',
                'Passport_number' => [
                    'required_if:postion,out',
                    'nullable',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->input('postion') === 'out' && $value !== null) {
                            $exists = DB::table('members')
                                ->where('Passport_number', $value)
                                ->where('postion', 'out')
                                ->exists();

                            if ($exists) {
                                $fail('The passport number has already been taken.');
                            }
                        }
                    },
                ],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'msg' => $validator->errors()->first(), 'status' => 0]);
            }

            // Store images and return the paths
            $imagePath1 = $request->hasFile('image') ? $request->file('image')->store('uploads/personalImage', 'public') : null;
            $imagePath2 = $request->hasFile('image_back') ? $request->file('image_back')->store('uploads/backImage', 'public') : null;
            $imagePath3 = $request->hasFile('image_front') ? $request->file('image_front')->store('uploads/frontImage', 'public') : null;
            $imagePath4 = $request->hasFile('cv') ? $request->file('cv')->store('uploads/cv', 'public') : null;

            $member = new Member();
            $member->type = $request->type;
            $member->postion = $request->postion;
            $member->image_front = $imagePath3;
            $member->image = $imagePath1;
            $member->cv = $imagePath4;
            $member->image_back = $imagePath2;
            $member->name = $request->name;
            $member->national_ID = $request->national_ID;
            $member->card_Date = $request->card_Date;
            $member->governorate_id = $request->governorate_id;
            $member->address = $request->address;
            $member->work_place = $request->work_place;
            $member->partisan = $request->partisan;
            $member->country_id = $request->country_id ?: null;
            $member->Place_abroad = $request->Place_abroad ?: null;
            $member->Passport_number = $request->Passport_number ?: null;
            $member->job = $request->job;
            $member->qualification = $request->qualification;
            $member->phone = $request->phone;
            $member->save();
            return response()->json(['data' => $member, 'msg' => __('messages.created_successfully'), 'status' => 1]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['data' => null, 'msg' => __('messages.Something went wrong'), 'status' => 0]);
        }
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('dashboard.site.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('dashboard.site.users.edit', compact('user'));
    }

    public function update($request, $id)
    {
        try {
            $user = $this->userRepository->getById($id);
            $data = $request->validated();
            if ($data['password'] == null) {
                unset($data['password']);
            }
            $this->userRepository->update($id, $data);
            return redirect()->route('users.update', $user->id)->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function showActiveUsers()
    {
        $users = $this->userRepository->getActiveUsers();
        // Do something with $users
    }
}

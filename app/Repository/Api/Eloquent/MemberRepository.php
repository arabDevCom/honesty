<?php

namespace App\Repository\Api\Eloquent;

use App\Models\Country;
use App\Models\Notification;
use App\Models\Token;
use App\Models\Governorate;
use App\Models\Member;
use App\Models\News;
use App\Models\Setting;
use App\Repository\Api\MemberRepositoryInterface;
use App\Repository\Api\ResponseApi;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;



class MemberRepository extends ResponseApi implements MemberRepositoryInterface


{
    use PhotoTrait, FirebaseNotification;

    public function store($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:male,female',
                'postion' => 'required|in:in,out',
                'image_front' => 'required|image',
                'image_back' => 'required|image',
                'image' => 'required|image',
                'cv' => 'nullable|mimes:pdf',
                'type' => 'required|in:male,female',
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
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }

            // Store images and return the paths
            $imagePath11 = $request->hasFile('image') ? $request->file('image')->store('uploads/personalImage', 'public') : null;
            $imagePath22 = $request->hasFile('image_back') ? $request->file('image_back')->store('uploads/backImage', 'public') : null;
            $imagePath33 = $request->hasFile('image_front') ? $request->file('image_front')->store('uploads/frontImage', 'public') : null;
            $imagePath44 = $request->hasFile('cv') ? $request->file('cv')->store('uploads/cv', 'public') : null;


            $imagePath1 = asset('storage/' . $imagePath11);
            $imagePath2 = asset('storage/' . $imagePath22);
            $imagePath3 = asset('storage/' . $imagePath33);
            $imagePath4 = asset('storage/' . $imagePath44);


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

            return self::returnDataSuccess($member, 'Member stored successfully.');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }


    public function getHome(): JsonResponse


    {
        try {

            $silder = Silder::select('url', 'image')->get();
            $newsCount = News::count();

            if ($newsCount > 4) {

                $newsCount = News::orderBy('created_at', 'desc')->take(4)->get();
            } else {
                $newsCount = News::all();
            }

            return self::returnDataSuccess(['silder' => $silder, 'news' => $newsCount], 'news fetched successfully.');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);


        }

    }

    public function getAllNews($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'per_page' => 'required|numeric',
                'current_page' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }

            // Fetch the news items with select columns
            $query = News::select('id', 'title', 'description', 'image', 'created_at');

            // Paginate the query based on the parameters
            $newsPaginator = $query->paginate($request->per_page, ['*'], 'page', $request->current_page);

            // Get next page URL
            $nextPageUrl = $newsPaginator->nextPageUrl();

            // Custom pagination data
            $paginationData = [
                'total' => $newsPaginator->total(),
                'per_page' => $request->per_page,
                'current_page' => $newsPaginator->currentPage(),
                'last_page' => $newsPaginator->lastPage(),
                'next_page_url' => $nextPageUrl,
            ];

            // Create custom response data
            $responseData = [
                'data' => $newsPaginator->items(),
                'pagination' => $paginationData,
                'message' => 'تم الحصول على البيانات بنجاح',
                'code' => 200,
            ];

            return self::returnDataSuccess($responseData, 'News fetched successfully.');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }


    public function getAllCountry(): JsonResponse


    {
        try {
            $countries = Country::select('id', 'name')->get();

            return self::returnDataSuccess($countries, 'countries fetched successfully.');


        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);


        }

    }

    public function getAllGovernorates(): JsonResponse


    {
        try {
            $countries = Governorate::select('id', 'name')->get();

            return self::returnDataSuccess($countries, 'countries fetched successfully.');


        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);


        }

    }

    public function getSettings(): JsonResponse


    {
        try {
            $settings = Setting::select('sponsor')->first();

            return self::returnDataSuccess($settings, 'settings fetched successfully.');


        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);


        }

    }


    public function StoreToken($request): JsonResponse


    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return self::returnDataFail(null, $validator->errors()->first(), 422);
        }

        try {

            $tokens = new Token();
            $tokens->token = $request->token;
            $tokens->save();


            return self::returnDataSuccess($tokens, 'tokens stored successfully.');


        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);


        }

    }

    public function getNotifications(): JsonResponse
    {
        try {
            $notifications = Notification::select('title', 'body', 'image', 'type')->get();

            // Initialize the arrays
            $newsClean = [];
            $news = [];

            foreach ($notifications as $notification) {
                if ($notification->type === 'new') {
                    $newsItems = News::select('id', 'title', 'description', 'image', 'created_at')->get();

                    foreach ($newsItems as $newsItem) {
                        // Create a copy of newsItem with cleaned description
                        $newsItem->descriptionClean =strip_tags($newsItem->description);
                        $news[] = $newsItem;
                    }
                }
            }

            return self::returnDataSuccess(['notifications' => $notifications, 'news' => $news], 'notifications fetched successfully.');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }


}

<?php

namespace App\Repository\Eloquent;

use App\Repository\Api\MemberRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class MemberRepository  implements MemberRepositoryInterface

{
   public function store($request) : JsonResponse
   {
       {
       try {
           $validator = Validator::make($request->all(), [
               'auction_id' => 'required|exists:auctions,id',
               'comment' => 'required|string',
               'type' => 'required|in:comment,reply',
               'comment_id' => 'required_if:type,reply|exists:auction_comments,id',
           ]);

           if ($validator->fails()) {
               return self::returnDataFail(null, $validator->errors()->first(), 422);
           }

           $comment = new AuctionComment();
           $comment->user_id = Auth::guard('user-api')->user()->id;
           $comment->auction_id = $request->auction_id;
           $comment->type = $request->type;
           $comment->comment = $request->comment;
           $comment->comment_id = $request->comment_id ?? null;
           $comment->save();


           return self::returnDataSuccess($comment, ' comment store success');


       } catch (Exception $exception) {
           return self::returnDataFail(null, $exception->getMessage(), 500);
       }
   } // end storeComment

   }


}

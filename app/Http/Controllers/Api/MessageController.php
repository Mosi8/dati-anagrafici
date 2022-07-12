<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'sender_name' => 'required|string|max:50',
            'sender_surname' => 'required|string|max:50',
            'sender_email' => 'required|string|max:50|',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors(),
                "data" => $data
            ],400);
        }
        $newMessage = new Message();
        
        $newMessage->sender_name = $data["sender_name"];
        $newMessage->sender_surname = $data["sender_surname"];
        $newMessage->sender_email = $data["sender_email"];
        $newMessage->save();

        return response()->json([
            "success" => true
        ]);
    }

}

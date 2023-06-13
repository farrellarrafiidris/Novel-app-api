<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_id'            =>      'required|exists:comments,id',
            'reply_content'         =>      'required',

        ]);
    
    $request['user_id'] = Auth::user()->id;

    $reply = Reply::create($request->all());
    
    return new ReplyResource($reply);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}

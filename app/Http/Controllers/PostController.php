<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(){
        $this -> middleware(['auth:sanctum'])->only('store','update','delete');
        $this -> middleware(['Pemilik-Novel'])->only('update','delete');
    }

    public function index()
    {
        $posts = Posts::all();
        return PostResource::collection($posts);
    }

    public function show($id) {
        
        $post = Posts::with('penulis')->findOrFail($id);
        return new PostDetailResource($post);
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'content'   => 'required',
        ]);

        if ($request->file) {
            $validated = $request->validate([
                'file' => 'mimes:png,jpg,jpeg,gif|max:100000'
            ]);

            $fileName = $this->generateRandomString();
            $extention = $request->file->extension();

            Storage::putFileAs('image', $request->file, $fileName.'.'.$extention);

            $request['image'] = $fileName.'.'.$extention;
            $request['writer'] = Auth::user()->id;
            $post = Posts::create($request->all());
        }

        $request['writer'] = Auth::user()->id;  
        $post = Posts::create($request->all());

        return new PostResource($post);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Posts::findOrFail($id);
        $post->update($request->all());

        return new PostResource($post);
    }

        public function delete($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}

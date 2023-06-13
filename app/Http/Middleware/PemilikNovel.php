<?php

namespace App\Http\Middleware;

use App\Models\Posts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikNovel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_writer = Posts::findOrFail($request->id);
        $user = Auth::user();

        if($id_writer->writer != $user->id) {
            return response()->json('kamu bukan pemilik postingan');
        }

        
        return $next($request);
    }
}

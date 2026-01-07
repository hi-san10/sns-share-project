<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Kreait\Firebase\Factory;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->withCount('nices')->get();

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/serviceAccountKey.json'));
            $auth = $factory->createAuth();
            $idToken = $request->bearerToken();

            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            $user = User::where('firebase_uid', $uid)->first();
            if (!$user) {
                throw new \Exception('ユーザー情報がありません');
            }

            $createPost = Post::create([
                'user_id' => $user->id,
                'content' => $request->input('content'),
            ]);
            $newPost = Post::with('user')->where('id', $createPost->id)->first();

            return response()->json($newPost);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user', 'comments.user')->withCount('nices')->where('id', $id)->first();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $post = Post::where('id', $id)->first();

        if ($user->id !== $post->user_id) {
            return;
        };

        $post->delete();
    }
}

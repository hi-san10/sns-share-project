<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Kreait\Firebase\Factory;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = [
        //     ['name' => 'hiro', 'content' => '最初の投稿'],
        //     ['name' => 'taro', 'content' => '2番目の投稿'],
        // ];
        $posts = Post::with('user')->get();

        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $post = Post::with('user', 'comments')->where('id', $id)->first();

        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

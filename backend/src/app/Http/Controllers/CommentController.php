<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Exception;
use Kreait\Firebase\Factory;
use Throwable;

class CommentController extends Controller
{
    public function comment(Request $request)
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

            Comment::create([
                'user_id' => $user->id,
                'post_id' => $request->input('postId'),
                'content' => $request->input('content'),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

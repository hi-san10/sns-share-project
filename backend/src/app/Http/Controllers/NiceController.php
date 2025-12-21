<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nice;

class NiceController extends Controller
{
    public function nice(Request $request)
    {
        $nice = Nice::where([
            ['user_id', $request->input('userId')],
            ['post_id', $request->input('postId')],
        ])->first();

        if (!$nice) {
            Nice::create([
                'user_id' => $request->input('userId'),
                'post_id' => $request->input('postId'),
            ]);
        } else {
            $nice->delete();
        }
    }
}

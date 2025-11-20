<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;



class LoginController extends Controller
{
    public function register(Request $request)
    {
        $idToken = $request->bearerToken();
        if (!$idToken){
            return response()->json(['error' => 'IDトークンがありません']);
        }

        try {
            $firebase = (new Factory)->withServiceAccount(storage_path('app/firebase/serviceAccountKey.json'));
            $uid = $request->json('firebase_uid');

            $user = User::create([
                'name' => $request->json('name'),
                'email' => $request->json('email'),
                'password' => Hash::make($request->json('password')),
                'firebase_uid' => $uid,
            ]);

            return response()->json(['user' => $user]);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $credentials = ([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Auth::attempt($credentials);
            $request->session()->regenerate();

            $user = auth()->user();
            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'logout' => true,
        ]);
    }

}

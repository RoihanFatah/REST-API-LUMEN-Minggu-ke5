<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request -> input('password'),
            'level' => 'pelanggan',
            'api_token' => '123456789',
            'status' => '1',
            'relasi' => $request -> input('email')
        ];

        $user = User::create($data);

        return response()->json($user);
    }

    public function login(request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email) -> first();

        if ($user->password === $password) {
            $token = Str::random(40);

            $user->update([
                'api_token' => $token
            ]);

            return response()->json([
                'pesan' => 'Login Berhasil',
                'token' => $token,
                'data' => $user
            ]);

        } else {
            return response()->json([
                'pesan' => 'Login Gagal',
                'data' => 'Data kosong'
            ]);
        }
    }
}

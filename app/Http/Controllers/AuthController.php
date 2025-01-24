<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view("register");
    }

    public function createuser(RegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'address' => $validated['address'],
                'major' => $validated['major'],
                'status' => 0,
                'password' => bcrypt($validated['password']),
                'rolename' => 'User',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Register Success.',
                'success' => true,
                'redirect' => '/'
            ], 200);
        } catch (\Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Registration Failed : ' . $e->getMessage(),
                'error' => true,
            ], 500);
        }
    }

    public function auth(AuthRequest $request)
    {
        $validate = $request->validated();
    
        if (auth()->attempt($validate)) {
            $user = auth()->user();
    
            if ($user->status == 0) {
                auth()->logout();
                return response()->json([
                    'message' => 'Akun anda tidak aktif. Silahkan hubungi admin untuk mengaktifkan akun anda',
                    'inactive' => true
                ], 403);
            }
    
            $request->session()->regenerate();
            $welcomeMessage = 'Welcome ' . $user->username;
            $redirectUrl = $user->rolename === 'Admin' ? '/admin/index' : '/user/home';
    
            return response()->json([
                'message' => 'Success',
                'redirect' => $redirectUrl,
                'welcomeMessage' => $welcomeMessage
            ], 200);
        }
    
        return response()->json(['message' => 'Username atau Password salah', 'error' => true], 401);
    }
    
    


    public function logout()
    {
        Auth::logout();
        toast('Logout Berhasil', 'success');
        return redirect('/');
    }
}

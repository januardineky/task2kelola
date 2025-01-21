<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view("register");
    }

    public function createuser(Request $request)
    {
    try {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'major' => $request->major,
            'status' => 0,
            'password' => bcrypt($request->password),
            'rolename' => 'User',
        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'Register Berhasil',
        ], 200);

    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage(),
        ], 500);
    } finally {
        toast('Register Berhasil', 'success');
        return redirect('/');
    }
    }


    public function auth(Request $request)
    {
    $validate = $request->validate([
        'email' => ['required','email'],
        'password' => ['required']
    ]);

    if (auth()->attempt($validate)) {
        $user = auth()->user();

        if ($user->status == 0) {
            auth()->logout();
            Alert::error('Error', 'Akun Anda tidak aktif. Silakan hubungi admin untuk mengaktifkan akun Anda.');
            return redirect('/');
        }

        $request->session()->regenerate();

        $welcomeMessage = 'Welcome ' . $user->username;

        if ($user->rolename === 'Admin') {

            toast($welcomeMessage, 'success');
            return redirect('/index');
            
        } else if ($user->rolename === 'User') {

            toast($welcomeMessage, 'success');
            return redirect('/home');

        } 
    }

    Alert::error('Error', 'Username atau Password salah');
    return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        toast('Logout Berhasil', 'success');
        return redirect('/');
    }
}

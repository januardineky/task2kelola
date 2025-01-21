<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function index()
    {
        $total = User::where('rolename','user')->count();
        $user = Auth::user();
        return view("index",compact('user','total'));
    }

    public function getUsers(Request $request)
    {
        $user = Auth::user();

        // Initialize the query for fetching users with the role "user"
        $query = User::where('rolename', 'user');
    
        // Apply search filter if exists
        if ($request->has('search') && $request->search != '') {
            $query->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%')
                  ->orWhere('major', 'like', '%' . $request->search . '%');
        }
    
        // Apply sorting by major if selected
        if ($request->has('sort_major') && $request->sort_major != '') {
            $query->where('major', $request->sort_major);
        }
    
        // Get the paginated result
        $tabel = $query->paginate(10);
    
        return view('users', compact('user', 'tabel'));  // Kirim data pengguna dan pengguna yang dipaginasikan
    }
    

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user); 
    }
    
    public function update(Request $request)
    {
        try {
            $user = User::find($request->user_id);
    
            if ($user) {
                $user->username = $request->username;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->address = $request->address;
                $user->major = $request->major;
                $user->status = $request->status;
                $user->save();
    
                toast('Update Berhasil', 'success');
                return redirect()->back();
            } else {
                throw new \Exception('User not found');
            }
        } catch (\Exception $e) {
            toast('Update Gagal: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
    
}
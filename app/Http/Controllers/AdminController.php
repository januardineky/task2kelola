<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $total = $users->where('rolename','User')->count();;
        $totaladmin = $users->where('rolename','Admin')->count();
        return view("index",compact('user','total','totaladmin'));
    }

    public function getUsers(Request $request)
    {
        $user = Auth::user();

        $query = User::where('rolename', 'user');
    
        // Apply search filter if exists
        if ($request->has('search') && $request->search != '') {
            $query->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%')
                  ->orWhere('major', 'like', '%' . $request->search . '%');
        }
    
        if ($request->has('sort_major') && $request->sort_major != '') {
            $query->where('major', $request->sort_major);
        }
    
        $tabel = $query->paginate(10);
    
        return view('users', compact('user', 'tabel')); 
    }
    

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user); 
    }
    
    public function update(UpdateRequest $request, $id)
    {
        // Validasi
        $validate = $request->validated();
    
        try {
            // Temukan user
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found');
            }
    
            // Update data user
            $user->username = $validate['username'];
            $user->email = $validate['email'];
            $user->phone_number = $validate['phone_number'];
            $user->address = $validate['address'];
            $user->major = $validate['major'];
            $user->status = $validate['status'];
            $user->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Update Success',
                'success' => true,
                'redirect' => '/admin/users'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error jika user tidak ditemukan atau update gagal
            return response()->json([
                'status' => 'error',
                'message' => 'Update Gagal: ' . $e->getMessage(),
                'success' => false,
            ], 400);
        }
    }
    
    
}